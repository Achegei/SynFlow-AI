<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Certificate;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class CertificateController extends Controller
{
    public function download(Request $request, $courseId)
    {
        if ((int) $courseId === 1) {
            abort(403, 'Certificates are not available for this course.');
        }

        $request->validate([
            'full_name' => 'required|string|max:255',
        ]);

        $course = Course::findOrFail($courseId);
        $userName = $request->full_name;

        $uniqueId = strtoupper(uniqid());
        $date = date('F d, Y');

        /*
        -------------------------------------------------------
        CREATE CERTIFICATE STORAGE FOLDER
        -------------------------------------------------------
        */
        if (!file_exists(storage_path('app/certificates'))) {
            mkdir(storage_path('app/certificates'), 0777, true);
        }

        /*
        -------------------------------------------------------
        GENERATE QR CODE
        -------------------------------------------------------
        */
        $qrPath = storage_path("app/certificates/{$uniqueId}_qrcode.png");

        QrCode::format('png')
            ->size(200)
            ->generate(
                route('certificate.verify') . '?certificate=' . $uniqueId,
                $qrPath
            );

        /*
        -------------------------------------------------------
        SAVE CERTIFICATE RECORD
        -------------------------------------------------------
        */
        Certificate::create([
            'certificate_number' => $uniqueId,
            'course_id' => $courseId,
            'full_name' => $userName,
            'issued_at' => now(),
        ]);

        /*
        -------------------------------------------------------
        SELECT TEMPLATE
        -------------------------------------------------------
        */
        $templateFile = match ((int)$courseId) {
            2 => 'template2.png',
            default => 'template1.png',
        };

        $templatePath = public_path("certificates/{$templateFile}");
        $outputPath   = storage_path("app/certificates/{$userName}_certificate.png");

        $fontPath = public_path('certificates/fonts/PlayfairDisplay-Italic-VariableFont_wght.ttf');

        $nameFontSize  = 42;
        $otherFontSize = 24;

        $image = imagecreatefrompng($templatePath);

        imagealphablending($image, true);
        imagesavealpha($image, true);

        $black = imagecolorallocate($image, 0, 0, 0);

        /*
        -------------------------------------------------------
        CERTIFICATE ID
        -------------------------------------------------------
        */
        $idX = 440;
        $idY = 495;

        for ($i = 0; $i < 2; $i++) {
            imagettftext($image, $otherFontSize, 0, $idX + $i, $idY, $black, $fontPath, $uniqueId);
        }

        /*
        -------------------------------------------------------
        AWARDEE NAME
        -------------------------------------------------------
        */
        $maxWidth = 1000;

        $box = imagettfbbox($nameFontSize, 0, $fontPath, $userName);
        $nameWidth = $box[2] - $box[0];

        $scaledFontSize = $nameFontSize;

        while ($nameWidth > $maxWidth && $scaledFontSize > 10) {
            $scaledFontSize--;
            $box = imagettfbbox($scaledFontSize, 0, $fontPath, $userName);
            $nameWidth = $box[2] - $box[0];
        }

        $nameX = (imagesx($image) - $nameWidth) / 2;
        $nameY = 1050;

        imagettftext($image, $scaledFontSize, 0, $nameX, $nameY, $black, $fontPath, $userName);
        imagettftext($image, $scaledFontSize, 0, $nameX + 1, $nameY, $black, $fontPath, $userName);

        /*
        -------------------------------------------------------
        DATE
        -------------------------------------------------------
        */
        $dateX = 900;
        $dateY = 1550;

        for ($i = 0; $i < 2; $i++) {
            imagettftext($image, $otherFontSize, 0, $dateX + $i, $dateY, $black, $fontPath, $date);
        }

        /*
        -------------------------------------------------------
        ADD QR CODE BELOW DATE
        -------------------------------------------------------
        */
        $qr = imagecreatefrompng($qrPath);

        $qrWidth = imagesx($qr);
        $qrHeight = imagesy($qr);

        $qrX = (imagesx($image) - $qrWidth) / 2 + 250;
        $qrY = $dateY + 150;

        imagecopy(
            $image,
            $qr,
            $qrX,
            $qrY,
            0,
            0,
            $qrWidth,
            $qrHeight
        );

        imagedestroy($qr);

        /*
        -------------------------------------------------------
        SAVE CERTIFICATE IMAGE
        -------------------------------------------------------
        */
        imagepng($image, $outputPath);

        imagedestroy($image);

        return response()->download($outputPath, "{$course->title}_certificate.png");
    }

    public function showVerifyForm(Request $request)
    {
        $certificate = null;

        if ($request->certificate) {
            $certificate = Certificate::where('certificate_number', $request->certificate)->first();
        }

        return view('verify_certificate', compact('certificate'));
    }

    public function verify(Request $request)
    {
        $request->validate([
            'certificate_number' => 'required|string',
        ]);

        $certificate = Certificate::where('certificate_number', $request->certificate_number)->first();

        if ($certificate) {
            return back()->with('message', 'Valid certificate! Awardee: ' . $certificate->full_name);
        }

        return back()->with('message', 'Invalid certificate number.');
    }

    public function verifyQr($certificateNumber)
    {
        $certificate = Certificate::where('certificate_number', $certificateNumber)->first();

        if (!$certificate) {
            return view('verify_certificate_result', [
                'valid' => false,
                'certificate' => null,
            ]);
        }

        return view('verify_certificate_result', [
            'valid' => true,
            'certificate' => $certificate,
        ]);
    }
}