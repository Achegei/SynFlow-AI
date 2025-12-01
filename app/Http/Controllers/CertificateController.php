<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Illuminate\Support\Facades\Storage;

class CertificateController extends Controller
{
    public function download(Request $request, $courseId)
    {
        // Validate full name input
        $request->validate([
            'full_name' => 'required|string|max:255',
        ]);

        $course = Course::findOrFail($courseId);
        $userName = $request->full_name;

        // Generate unique certificate ID and current date
        $uniqueId = strtoupper(uniqid());
        $date = date('F d, Y');

        /**
         * -------------------------------------------------------
         * SELECT TEMPLATE BASED ON COURSE ID
         * -------------------------------------------------------
         */
        $templateFile = match ((int)$courseId) {
            1 => 'template1.png',
            2 => 'template2.png',
            default => 'template1.png',
        };

        $templatePath = public_path("certificates/{$templateFile}");
        $outputPath   = storage_path("app/certificates/{$userName}_certificate.png");

        // Use your existing font
        $fontPath = public_path('certificates/fonts/PlayfairDisplay-Italic-VariableFont_wght.ttf');

        // Font sizes
        $nameFontSize  = 42;
        $otherFontSize = 24;

        $image = imagecreatefrompng($templatePath);
        imagealphablending($image, true);
        imagesavealpha($image, true);
        $black = imagecolorallocate($image, 0, 0, 0);

        /**
         * -------------------------------------------------------
         * CERTIFICATE ID (bold using multiple draws)
         * -------------------------------------------------------
         */
        $idX = 440;
        $idY = 495;
        for ($i = 0; $i < 2; $i++) { // draw twice with 1px offset
            imagettftext($image, $otherFontSize, 0, $idX + $i, $idY, $black, $fontPath, $uniqueId);
        }

        /**
         * -------------------------------------------------------
         * NAME OF AWARDEE (keep perfect)
         * -------------------------------------------------------
         */
        $maxWidth = 1000; 
        $box = imagettfbbox($nameFontSize, 0, $fontPath, $userName);
        $nameWidth = $box[2] - $box[0];

        // Reduce font size if name is too long
        $scaledFontSize = $nameFontSize;
        while ($nameWidth > $maxWidth && $scaledFontSize > 10) {
            $scaledFontSize--;
            $box = imagettfbbox($scaledFontSize, 0, $fontPath, $userName);
            $nameWidth = $box[2] - $box[0];
        }

        $nameX = (imagesx($image) - $nameWidth) / 2;
        $nameY = 1050;

        // Draw name with subtle shadow (still using same font)
        imagettftext($image, $scaledFontSize, 0, $nameX, $nameY, $black, $fontPath, $userName);
        imagettftext($image, $scaledFontSize, 0, $nameX + 1, $nameY, $black, $fontPath, $userName);

        /**
         * -------------------------------------------------------
         * DATE (bold using multiple draws)
         * -------------------------------------------------------
         */
        $dateX = 900;
        $dateY = 1550;
        for ($i = 0; $i < 2; $i++) {
            imagettftext($image, $otherFontSize, 0, $dateX + $i, $dateY, $black, $fontPath, $date);
        }

        /**
         * -------------------------------------------------------
         * SAVE FINAL CERTIFICATE
         * -------------------------------------------------------
         */
        if (!file_exists(storage_path('app/certificates'))) {
            mkdir(storage_path('app/certificates'), 0777, true);
        }

        imagepng($image, $outputPath);
        imagedestroy($image);

        return response()->download($outputPath, "{$course->title}_certificate.png");
    }
}
