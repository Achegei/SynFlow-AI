<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    public function index()
    {
        $videos = Video::orderBy('order')->get();
        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.videos.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_url' => 'required|url',
            'thumbnail_url' => 'nullable|url',
            'order' => 'required|integer',
            'is_published' => 'boolean',
            'pdf' => 'nullable|file|mimes:pdf|max:5120', // ✅ New PDF validation
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // ✅ Handle file upload if present
        $pdfPath = null;
        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store('pdfs', 'public');
        }

        // ✅ Create new video with pdf path
        $video = new Video($request->except('pdf'));
        $video->pdf_path = $pdfPath;
        $video->save();

        return redirect()->route('admin.videos.index')->with('success', 'Video added successfully!');
    }

    public function edit(string $id)
    {
        $video = Video::findOrFail($id);
        return view('admin.videos.edit', compact('video'));
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_url' => 'required|url',
            'thumbnail_url' => 'nullable|url',
            'order' => 'required|integer',
            'is_published' => 'boolean',
            'pdf' => 'nullable|file|mimes:pdf|max:5120', // ✅ Add same validation here
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $video = Video::findOrFail($id);

        // ✅ If new PDF uploaded, replace old one
        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store('pdfs', 'public');
            $video->pdf_path = $pdfPath;
        }

        $video->update($request->except('pdf'));

        return redirect()->route('admin.videos.index')->with('success', 'Video updated successfully!');
    }

    public function destroy(string $id)
    {
        $video = Video::findOrFail($id);
        $video->delete();

        return redirect()->route('admin.videos.index')->with('success', 'Video deleted successfully!');
    }

    public function indexPublic()
    {
        $videos = Video::orderBy('order')->get();
        return view('admin.videos.index', compact('videos'));
    }
}
