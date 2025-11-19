<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use Intervention\Image\ImageManagerStatic as Image;

class CertificateController extends Controller
{
    public function generate($courseId)
    {
        $course = Course::findOrFail($courseId);
        $user = auth()->user();

        // Storage paths
        $templatePath = storage_path('app/public/certificates/template.png');
        $fontPath = storage_path('app/public/fonts/PlayfairDisplay-Bold.ttf');

        // Load certificate template
        $img = Image::make($templatePath);

        // Write student name
        $img->text($user->name, 960, 720, function ($font) use ($fontPath) {
            $font->file($fontPath);
            $font->size(80);
            $font->color('#000000');
            $font->align('center');
            $font->valign('middle');
        });

        // Write course title
        $img->text($course->title, 960, 880, function ($font) use ($fontPath) {
            $font->file($fontPath);
            $font->size(50);
            $font->color('#444444');
            $font->align('center');
            $font->valign('middle');
        });

        // Save generated certificate
        $fileName = 'certificate-' . $course->id . '-' . $user->id . '.png';
        $savePath = storage_path('app/public/certificates/generated/' . $fileName);

        // Ensure directory exists
        if (!file_exists(dirname($savePath))) {
            mkdir(dirname($savePath), 0777, true);
        }

        $img->save($savePath);

        // Download file
        return response()->download($savePath)->deleteFileAfterSend(true);
    }
}
