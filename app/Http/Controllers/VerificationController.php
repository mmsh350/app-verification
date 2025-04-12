<?php

namespace App\Http\Controllers;

use App\Http\Repositories\NIN_PDF_Repository;
use App\Http\Repositories\VirtualAccountRepository;
use App\Http\Repositories\WalletRepository;
use App\Models\Service;
use App\Models\Verification;
use App\Models\Wallet;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class VerificationController extends Controller
{

    protected $transactionService;
    protected $loginId;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
        $this->loginId = auth()->user()->id;
    }


    public function index()
    {
        // return view('verification.nin-verify');
    }

    public function ninVerify()
    {

        $serviceCodes = ['104', '105', '106', '107'];
        $services = Service::whereIn('service_code', $serviceCodes)
            ->get()
            ->keyBy('service_code');

        // Extract specific service fees
        $ServiceFee = $services->get('104') ?? 0.00;
        $standard_nin_fee = $services->get('106') ?? 0.00;
        $premium_nin_fee = $services->get('107') ?? 0.00;

        return view('verification.nin-verify', compact('ServiceFee', 'standard_nin_fee', 'premium_nin_fee'));
    }

    public function bvnVerify()
    {
        // Fetch all required service fees in one query
        $serviceCodes = ['101', '102', '103'];
        $services = Service::whereIn('service_code', $serviceCodes)->get()->keyBy('service_code');

        $BVNFee = $services->get('101') ?? 0.00;;
        $bvn_standard_fee = $services->get('102') ?? 0.00;
        $bvn_premium_fee = $services->get('103') ?? 0.00;


        return view('verification.bvn-verify', compact('BVNFee', 'bvn_standard_fee', 'bvn_premium_fee'));
    }

    private function createAccounts($userId)
    {

        $repObj = new WalletRepository;
        $repObj->createWalletAccount($userId);

        $repObj2 = new VirtualAccountRepository;
        $repObj2->createVirtualAccount($userId);
    }
    public function verifyUser(Request $request)
    {
        $request->validate([
            'bvn' => 'required|numeric|digits:11',
        ]);

        $bvn = $request->input('bvn');

        return $this->verifyUserBVN($bvn);
    }
    private function verifyUserBVN($bvn)
    {
        try {

            $data = ['bvn' => $bvn];

            $url = env('BASE_URL_VERIFY_USER') . 'api/v1/verify-bvn';
            $token = env('VERIFY_USER_TOKEN');
            $headers = [
                'Accept: application/json, text/plain, */*',
                'Content-Type: application/json',
                "Authorization: Bearer $token",
            ];

            // Initialize cURL
            $ch = curl_init();

            // Set cURL options
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

            // Execute request
            $response = curl_exec($ch);

            // Check for cURL errors
            if (curl_errno($ch)) {
                throw new \Exception('cURL Error: ' . curl_error($ch));
            }

            // Close cURL session
            curl_close($ch);


            $response = json_decode($response, true);

            if (isset($response['respCode']) && $response['respCode'] == '000') {

                $data = $response['data'];

                $updateData = [
                    'name'   => ucwords(strtolower($data['firstName']) . ' ' . strtolower($data['middleName']) . ' ' . strtolower($data['lastName'])),
                    'dob'          => $data['birthday'],
                    'gender'       => $data['gender'],
                    'kyc_status'   => 'Verified',
                    'idNumber' => $bvn,
                ];

                if (!empty($data['phoneNumber'])) {
                    $updateData['phone_number'] = $data['phoneNumber'];
                }

                if (!empty($data['photo'])) {
                    $updateData['profile_pic'] = $data['photo'];
                }

                auth()->user()->update($updateData);

                $this->createAccounts(auth()->user()->id);

                return redirect()->back()->with('success', 'Your identity verification is complete, and youre all set to explore our services. Thank you for verifying your account!');
            } else {
                Log::error('Error Verifiying User ' . auth()->user()->id . ': ' .  $response);
                return redirect()->back()->with('error', 'An error occurred while making the BVN Verification (System Err)');
            }
        } catch (\Exception $e) {
            Log::error('Error Verifiying User ' . auth()->user()->id . ': ' . $e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while making the BVN Verification');
        }
    }


    public function ninRetrieve(Request $request)
    {

        $request->validate(
            ['nin' => 'required|numeric|digits:11'],
            [
                'nin.required' => 'The NIN number is required.',
                'nin.numeric' => 'The NIN number must be a numeric value.',
                'nin.digits' => 'The NIN must be exactly 11 digits.',
            ]
        );

        //NIN Services Fee
        $ServiceFee = 0;

        $ServiceFee = Service::where('service_code', '104')
            ->where('status', 'enabled')
            ->first();

        if (!$ServiceFee)
            return response()->json([
                'message' => 'Error',
                'errors' => ['Service Error' => 'Sorry Action not Allowed !'],
            ], 422);

        $ServiceFee = $ServiceFee->amount;

        $loginUserId = auth()->user()->id;

        //Check if wallet is funded
        $wallet = Wallet::where('user_id', $loginUserId)->first();
        $wallet_balance = $wallet->balance;
        $balance = 0;

        if ($wallet_balance < $ServiceFee) {
            return response()->json([
                'message' => 'Error',
                'errors' => ['Wallet Error' => 'Sorry Wallet Not Sufficient for Transaction !'],
            ], 422);
        } else {

            try {

                $data = ['nin' => $request->input('nin')];

                $url = env('BASE_URL_VERIFY_USER') . 'api/v1/verify-nin';
                $token = env('VERIFY_USER_TOKEN');

                $headers = [
                    'Accept: application/json, text/plain, */*',
                    'Content-Type: application/json',
                    "Authorization: Bearer $token",
                ];

                // Initialize cURL
                $ch = curl_init();

                // Set cURL options
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

                // Execute request
                $response = curl_exec($ch);

                // Check for cURL errors
                if (curl_errno($ch)) {
                    throw new \Exception('cURL Error: ' . curl_error($ch));
                }

                // Close cURL session
                curl_close($ch);

                $response = json_decode($response, true);

                if (isset($response['respCode']) && $response['respCode'] == '000') {

                    $data = $response['data'];

                    $this->processResponseDataForNIN($data);

                    $balance = $wallet->balance - $ServiceFee;

                    Wallet::where('user_id', $loginUserId)
                        ->update(['balance' => $balance]);

                    $serviceDesc = 'Wallet debitted with a service fee of ₦' . number_format($ServiceFee, 2);

                    $this->transactionService->createTransaction($loginUserId, $ServiceFee, 'NIN Verification', $serviceDesc,  'Wallet', 'Approved');

                    return json_encode(['status' => 'success', 'data' => $data]);
                } else if ($response['respCode'] == '99120010') {


                    $balance = $wallet->balance - $ServiceFee;

                    Wallet::where('user_id', $this->loginId)
                        ->update(['balance' => $balance]);

                    $serviceDesc = 'Wallet debitted with a service fee of ₦' . number_format($ServiceFee, 2);

                    $this->transactionService->createTransaction($loginUserId, $ServiceFee, 'NIN Verification', $serviceDesc,  'Wallet', 'Approved');

                    return response()->json([
                        'status' => 'Not Found',
                        'errors' => ['Succesfully Verified with ( NIN do not exist)'],
                    ], 422);
                } else {
                    return response()->json([
                        'status' => 'Verification Failed',
                        'errors' => ['Verification Failed: No need to worry, your wallet remains secure and intact. Please try again or contact support for assistance.'],
                    ], 422);
                }
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'Request failed',
                    'errors' => ['An error occurred while making the API request'],
                ], 422);
            }
        }
    }

    public function bvnRetrieve(Request $request)
    {

        $request->validate(['bvn' => 'required|numeric|digits:11']);

        //BVN Services Fee
        $ServiceFee = 0;
        $ServiceFee = Service::where('service_code', '101')->where('status', 'enabled')->first();
        $ServiceFee = $ServiceFee->amount;

        if (!$ServiceFee)
            return response()->json([
                'message' => 'Error',
                'errors' => ['Service Error' => 'Sorry Action not Allowed !'],
            ], 422);



        $loginUserId = auth()->user()->id;

        //Check if wallet is funded
        $wallet = Wallet::where('user_id', $loginUserId)->first();
        $wallet_balance = $wallet->balance;
        $balance = 0;

        if ($wallet_balance < $ServiceFee) {
            return response()->json([
                'message' => 'Error',
                'errors' => ['Wallet Error' => 'Sorry Wallet Not Sufficient for Transaction !'],
            ], 422);
        } else {

            try {

                $data = ['bvn' => $request->input('bvn')];

                $url = env('BASE_URL_VERIFY_USER') . 'api/v1/verify-bvn';
                $token = env('VERIFY_USER_TOKEN');

                $headers = [
                    'Accept: application/json, text/plain, */*',
                    'Content-Type: application/json',
                    "Authorization: Bearer $token",
                ];

                // Initialize cURL
                $ch = curl_init();

                // Set cURL options
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

                // Execute request
                $response = curl_exec($ch);

                // Check for cURL errors
                if (curl_errno($ch)) {
                    throw new \Exception('cURL Error: ' . curl_error($ch));
                }

                // Close cURL session
                curl_close($ch);

                $response = json_decode($response, true);

                if (isset($response['respCode']) && $response['respCode'] == '000') {

                    $data = $response['data'];

                    $this->processResponseDataForBVN($data);

                    $balance = $wallet->balance - $ServiceFee;

                    Wallet::where('user_id', $loginUserId)
                        ->update(['balance' => $balance]);

                    $serviceDesc = 'Wallet debitted with a service fee of ₦' . number_format($ServiceFee, 2);

                    $this->transactionService->createTransaction($loginUserId, $ServiceFee, 'BVN Verification', $serviceDesc,  'Wallet', 'Approved');

                    return json_encode(['status' => 'success', 'data' => $data]);
                } else if ($response['respCode'] == '99120010') {


                    $balance = $wallet->balance - $ServiceFee;

                    Wallet::where('user_id', $this->loginId)
                        ->update(['balance' => $balance]);

                    $serviceDesc = 'Wallet debitted with a service fee of ₦' . number_format($ServiceFee, 2);

                    $this->transactionService->createTransaction($loginUserId, $ServiceFee, 'NIN Verification', $serviceDesc,  'Wallet', 'Approved');

                    return response()->json([
                        'status' => 'Not Found',
                        'errors' => ['Succesfully Verified with ( NIN do not exist)'],
                    ], 422);
                } else {
                    return response()->json([
                        'status' => 'Verification Failed',
                        'errors' => ['Verification Failed: No need to worry, your wallet remains secure and intact. Please try again or contact support for assistance.'],
                    ], 422);
                }
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 'Request failed',
                    'errors' => ['An error occurred while making the API request'],
                ], 422);
            }
        }
    }

    public function processResponseDataForNIN($data)
    {

        Verification::create([
            'idno' => $data['nin'],
            'type' => 'NIN',
            'nin' => $data['nin'],
            'first_name' => $data['firstName'],
            'middle_name' => $data['middleName'],
            'last_name' => $data['surname'],
            'dob' =>  $data['birthDate'],
            'gender' => $data['gender'],
            'phoneno' => $data['telephoneNo'],
            'photo' => $data['photo'],
        ]);
    }


    public function processResponseDataForBVN($data)
    {
        $user = Verification::create(
            [
                'idno' => $data['bvn'],
                'type' => 'BVN',
                'nin' => '',
                'first_name' => $data['firstName'],
                'middle_name' => $data['middleName'],
                'last_name' => $data['lastName'],
                'phoneno' => $data['phoneNumber'],
                'dob' => $data['birthday'],
                'gender' => $data['gender'],
                'photo' => $data['photo'],
            ]
        );
    }

    public function standardSlip($nin_no)
    {

        //NIN Services Fee
        $ServiceFee = 0;
        $ServiceFee = Service::where('service_code', '106')->first();
        $ServiceFee = $ServiceFee->amount;

        //Check if wallet is funded
        $wallet = Wallet::where('user_id', $this->loginId)->first();
        $wallet_balance = $wallet->balance;
        $balance = 0;

        if ($wallet_balance  < $ServiceFee) {
            return response()->json([
                "message" => "Error",
                "errors" => array("Wallet Error" => "Sorry Wallet Not Sufficient for Transaction !")
            ], 422);
        } else {
            $balance = $wallet->balance - $ServiceFee;

            $affected = Wallet::where('user_id', $this->loginId)
                ->update(['balance' => $balance]);

            $serviceDesc = 'Wallet debitted with a service fee of ₦' . number_format($ServiceFee, 2);

            $this->transactionService->createTransaction($this->loginId, $ServiceFee, 'Standard NIN Slip', $serviceDesc,  'Wallet', 'Approved');

            //Generate PDF
            $repObj = new NIN_PDF_Repository();
            $response = $repObj->standardPDF($nin_no);
            return  $response;
        }
    }

    public function premiumSlip($nin_no)
    {
        //NIN Services Fee
        $ServiceFee = 0;
        $ServiceFee = Service::where('service_code', '107')->first();
        $ServiceFee = $ServiceFee->amount;

        //Check if wallet is funded
        $wallet = Wallet::where('user_id', $this->loginId)->first();
        $wallet_balance = $wallet->balance;
        $balance = 0;

        if ($wallet_balance  < $ServiceFee) {
            return response()->json([
                "message" => "Error",
                "errors" => array("Wallet Error" => "Sorry Wallet Not Sufficient for Transaction !")
            ], 422);
        } else {
            $balance = $wallet->balance - $ServiceFee;

            $affected = Wallet::where('user_id', $this->loginId)
                ->update(['balance' => $balance]);

            $serviceDesc = 'Wallet debitted with a service fee of ₦' . number_format($ServiceFee, 2);

            $this->transactionService->createTransaction($this->loginId, $ServiceFee, 'Premium NIN Slip', $serviceDesc,  'Wallet', 'Approved');

            //Generate PDF
            $repObj = new NIN_PDF_Repository();
            $response = $repObj->premiumPDF($nin_no);
            return  $response;
        }
    }

    public function premiumBVN($bvnno)
    {

        //BVN Services Fee
        $ServiceFee = 0;
        $ServiceFee = Service::where('service_code', '103')->first();
        $ServiceFee = $ServiceFee->amount;

        //Check if wallet is funded
        $wallet = Wallet::where('user_id', $this->loginId)->first();
        $wallet_balance = $wallet->balance;
        $balance = 0;

        if ($wallet_balance  < $ServiceFee) {
            return response()->json([
                "message" => "Error",
                "errors" => array("Wallet Error" => "Sorry Wallet Not Sufficient for Transaction !")
            ], 422);
        } else {
            $balance = $wallet->balance - $ServiceFee;



            $affected = Wallet::where('user_id', $this->loginId)
                ->update(['balance' => $balance]);


            $serviceDesc = 'Wallet debitted with a service fee of ₦' . number_format($ServiceFee, 2);

            $this->transactionService->createTransaction($this->loginId, $ServiceFee, 'Premium BVN Slip', $serviceDesc,  'Wallet', 'Approved');

            if (Verification::where('idno', $bvnno)->exists()) {

                $veridiedRecord = Verification::where('idno', $bvnno)
                    ->latest()
                    ->first();

                $data = $veridiedRecord;
                $view = view('verification.PremiumBVN', compact('veridiedRecord'))->render();

                return response()->json(['view' => $view]);
            } else {

                return response()->json([
                    "message" => "Error",
                    "errors" => array("Not Found" => "Verification record not found !")
                ], 422);
            }
        }
    }

    public function standardBVN($bvnno)
    {

        $ServiceFee = 0;
        $ServiceFee = Service::where('service_code', '102')->first();
        $ServiceFee = $ServiceFee->amount;

        $wallet = Wallet::where('user_id', $this->loginId)->first();
        $wallet_balance = $wallet->balance;
        $balance = 0;

        if ($wallet_balance  < $ServiceFee) {
            return response()->json([
                "message" => "Error",
                "errors" => array("Wallet Error" => "Sorry Wallet Not Sufficient for Transaction !")
            ], 422);
        } else {
            $balance = $wallet->balance - $ServiceFee;

            $affected = Wallet::where('user_id', $this->loginId)
                ->update(['balance' => $balance]);

            $serviceDesc = 'Wallet debitted with a service fee of ₦' . number_format($ServiceFee, 2);

            $this->transactionService->createTransaction($this->loginId, $ServiceFee, 'Standard BVN Slip', $serviceDesc,  'Wallet', 'Approved');

            if (Verification::where('idno', $bvnno)->exists()) {

                $veridiedRecord = Verification::where('idno', $bvnno)
                    ->latest()
                    ->first();

                $data = $veridiedRecord;
                $view = view('verification.freeBVN', compact('veridiedRecord'))->render();

                return response()->json(['view' => $view]);
            } else {

                return response()->json([
                    "message" => "Error",
                    "errors" => array("Not Found" => "Verification record not found !")
                ], 422);
            }
        }
    }
}
