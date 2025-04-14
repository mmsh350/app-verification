<?php

namespace App\Http\Repositories;

use App\Models\Verification;
use TCPDF;

class BVN_PDF_Repository
{


    public function plasticPDF($nin_no)
    {
        // Check if record exists and retrieve the latest record
        if (Verification::where('idno', $nin_no)->exists()) {
            $verifiedRecord = Verification::where('idno', $nin_no)
                ->latest()
                ->first();

             // Prepare data for the PDF
            $ninData = [
                "nin" => $verifiedRecord->idno,
                "fName" => $verifiedRecord->first_name,
                "sName" => $verifiedRecord->last_name,
                "mName" => $verifiedRecord->middle_name,
                "tId" => $verifiedRecord->trackingId,
                "address" => $verifiedRecord->address,
                "lga" => $verifiedRecord->lga,
                "state" => $verifiedRecord->state,
                "gender" => ($verifiedRecord->gender === 'Male') ? "M" : "F",
                "dob" => $verifiedRecord->dob,
                "photo" => str_replace('data:image/jpg;base64,', '', $verifiedRecord->photo)
            ];



            $names = html_entity_decode($verifiedRecord->first_name) . ' ' . html_entity_decode($verifiedRecord->last_name);

            // Initialize TCPDF
            $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8');
            $pdf->setPrintHeader(false);
            $pdf->SetCreator('Abu');
            $pdf->SetAuthor('Zulaiha');
            $pdf->SetTitle($names);
            $pdf->SetSubject('Premium');
            $pdf->SetKeywords('premium, TCPDF, PHP');
            $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
            $pdf->AddPage();
            $pdf->SetFont('dejavuserifcondensedbi', '', 12);

            // Add text
            $txt = "Please find below your new High Resolution NIN Slip...";
            $pdf->MultiCell(150, 20, $txt, 0, 'C', false, 1, 35, 20, true, 0, false, true, 0, 'T', false);

            // Use JPG images instead of PNG
            $pdf->Image('assets/card_and_Slip/bvn.jpg', 69.5, 48, 78, 50, 'JPG', '', '', false, 300, '', false, false, 0);
            $pdf->Image('assets/card_and_Slip/back.jpg', 70, 101, 80, 50, 'JPG', '', '', false, 300, '', false, false, 0);

            // Add barcode
            $style = [
                'border' => false,
                'padding' => 0,
                'fgcolor' => [0, 0, 0],
                'bgcolor' => [255, 255, 255]
            ];
            $datas = '{NIN: ' . $ninData['nin'] . ', NAME: ' . html_entity_decode($ninData['fName']) . ' ' . html_entity_decode($ninData['mName']) . ' ' . html_entity_decode($ninData['sName']) . ', DOB: ' . $ninData['dob'] . ', Status:Verified}';
            // $pdf->write2DBarcode($datas, 'QRCODE,H', 128, 53, 20, 20, $style, 'H');

            // Add image from base64
            $photo = $ninData['photo'];
            $imgdata = base64_decode($photo);
            $pdf->Image('@' . $imgdata, 71.5, 62, 20, 25, 'JPG', '', '', false, 300, '', false, false, 0);

            // Add text
            $sur = html_entity_decode($ninData['sName']);
            $pdf->SetFont('helvetica', '', 9);
            $pdf->Text(93.3, 66.5, $sur);

            $othername = html_entity_decode($ninData['fName']) . ', ' . html_entity_decode($ninData['mName']);
            $pdf->SetFont('helvetica', '', 9);
            $pdf->Text(93.3, 73.5, $othername);

            $dob = $ninData['dob'];
            $newD = strtotime($dob);
            $cdate = date("d M Y", $newD);
            $pdf->SetFont('helvetica', '', 8);
            $pdf->Text(93.3, 80.5, $cdate);

            $gender = $ninData['gender'];
            $pdf->SetFont('helvetica', '', 9);
            $pdf->Text(114, 80.5, $gender);

            $issueD = date("d M Y");
            $pdf->SetFont('helvetica', '', 8);
            $pdf->Text(128, 81.8, $issueD);

            // Format NIN
            $nin = $ninData['nin'];
            $pdf->setTextColor(0, 0, 0);
            $newNin = substr($nin, 0, 4) . " " . substr($nin, 4, 3) . " " . substr($nin, 7);
            $pdf->SetFont('helvetica', '', 21);
            $pdf->Text(81, 91, $newNin);

            // Watermark
            // $pdf->StartTransform();
            // $pdf->Rotate(50, 88, 95);
            // $pdf->setTextColor(165, 162, 156);
            // $pdf->SetFont('helvetica', '', 7);
            // $pdf->Text(80, 80, $nin);
            // $pdf->StopTransform();

            // $pdf->StartTransform();
            // $pdf->Rotate(50, 90, 95);
            // $pdf->setTextColor(165, 162, 156);
            // $pdf->SetFont('helvetica', '', 7);
            // $pdf->Text(77, 86, $nin);
            // $pdf->StopTransform();

            // $pdf->StartTransform();
            // $pdf->Rotate(127, 118, 74);
            // $pdf->setTextColor(165, 162, 156);
            // $pdf->SetFont('helvetica', '', 7);
            // $pdf->Text(80, 80, $nin);
            // $pdf->StopTransform();

            // $pdf->setTextColor(165, 162, 156);
            // $pdf->SetFont('helvetica', '', 7);
            // $pdf->Text(129, 73, $nin);

            // Save and download PDF

            $filename =  'Premium NIN Slip - ' . $nin_no . '.pdf';
            $pdfContent = $pdf->Output($filename, 'S');

            return response($pdfContent, 200)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="' . $filename . '"')
                ->header('Content-Length', strlen($pdfContent));
        } else {
            return response()->json([
                "message" => "Error",
                "errors" => ["Not Found" => "Verification record not found!"]
            ], 422);
        }
    }
}
