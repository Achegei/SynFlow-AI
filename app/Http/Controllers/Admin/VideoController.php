<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = Video::orderBy('order')->get();
        return view('admin.videos.index', compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.videos.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_url' => 'required|url',
            'thumbnail_url' => 'nullable|url',
            'order' => 'required|integer',
            'is_published' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        Video::create($request->all());

        return redirect()->route('admin.videos.index')->with('success', 'Video added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $video = Video::findOrFail($id);
        return view('admin.videos.edit', compact('video'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'video_url' => 'required|url',
            'thumbnail_url' => 'nullable|url',
            'order' => 'required|integer',
            'is_published' => 'boolean',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $video = Video::findOrFail($id);
        $video->update($request->all());

        return redirect()->route('admin.videos.index')->with('success', 'Video updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
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
