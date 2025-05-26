<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;
use App\Models\NinService;
use App\Models\Service;
use App\Models\Wallet;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class ServicesController extends Controller
{

    protected $transactionService;
    protected $loginId;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
        $this->loginId = auth()->user()->id;
    }

    public function ninServices()
    {

        $services = Service::where('type', 'nin_services')->get();

        $ninServices = NinService::where('user_id',  $this->loginId)
            ->orderBy('id', 'desc')
            ->paginate(5);


        return view('nin-services', compact('services',  'ninServices'));
    }

    public function index(Request $request)
    {
        $search = $request->input('search');
        $perPage = $request->input('per_page', 10);

        $query = Service::query();

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%");
            });
        }

        $services = $query->paginate($perPage)->withQueryString();

        return view('services.index', compact('services'));
    }

    public function edit($id)
    {

        $service = Service::findOrFail($id);
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'description' => 'nullable',
            'status' => 'required|in:enabled,disabled',
        ]);

        $service = Service::findOrFail($id);
        $service->update($request->all());
        return redirect()->route('admin.services.index')->with('success', 'Service Updated Successfully!');
    }


    public function requestNinService(Request $request)
    {
        $rules = [
            'service' => ['required', 'exists:services,service_code'],
        ];

        switch ($request->input('service')) {
            case '113':
                // NIN + Email
                $rules += [
                    'nin'   => ['required', 'digits:11'],
                    'email' => ['required', 'email'],
                ];
                break;

            case '114':
                // NIN only
                $rules += [
                    'nin' => ['required', 'digits:11'],
                ];
                break;

            case '115':
                // Full details
                $rules += [
                    'nin'         => ['required', 'digits:11'],
                    'tracking_id' => ['required', 'regex:/^(?=.*[a-zA-Z])(?=.*\d)[a-zA-Z0-9]{15}$/'],
                    'surname'     => ['required', 'string', 'max:100'],
                    'firstname'   => ['required', 'string', 'max:100'],
                    // 'middlename'  => ['string', 'max:100'],
                    'dob'         => ['required', 'date', 'before_or_equal:today'],
                ];
                break;
        }

        $validated = $request->validate($rules);

        //NIN Services Fee
        $ServiceFee = 0;

        $Service = Service::where('service_code', $request->input('service'))
            ->where('status', 'enabled')
            ->first();

        if (!$Service)
            return redirect()->back()->with('error', 'Sorry Action not Allowed !');

        $ServiceFee = $Service->amount;
        $serviceType = $Service->name;
        //Check if wallet is funded
        $wallet = Wallet::where('user_id',  $this->loginId)->first();
        $wallet_balance = $wallet->balance;
        $balance = 0;

        if ($wallet_balance < $ServiceFee) {
            return redirect()->back()->with('error', 'Sorry Wallet Not Sufficient for Transaction !');
        } else {

            $balance = $wallet->balance - $ServiceFee;

            Wallet::where('user_id', $this->loginId)
                ->update(['balance' => $balance]);

            $serviceDesc = 'Wallet debitted with a service fee of ₦' . number_format($ServiceFee, 2);

            $transaction = $this->transactionService->createTransaction($this->loginId, $ServiceFee, 'NIN Service Request', $serviceDesc,  'Wallet', 'Approved');

            $trx_id = $transaction->id;

            NinService::create([
                'user_id' => $this->loginId,
                'tnx_id' => $trx_id,
                'refno' => $transaction->referenceId,
                'trackingId' => $request->tracking_id,
                'service_type' => $serviceType,
                'nin' => $request->nin,
                'email' => $request->email,
                'surname' => $request->surname,
                'middle_name' => $request->middlename,
                'first_name' => $request->firstname,
                'dob' => $request->dob,
            ]);

            return redirect()->back()->with('success', 'NIN Service Request was successfully');
        }
    }
}
