@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Add New Video</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.videos.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-lg shadow-lg p-8">
        @csrf

        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" name="title" id="title" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                   required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="description" id="description" rows="4" 
                      class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500"></textarea>
        </div>

        <div class="mb-4">
            <label for="video_url" class="block text-sm font-medium text-gray-700">Video URL</label>
            <input type="url" name="video_url" id="video_url" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                   required>
        </div>

        <div class="mb-4">
            <label for="thumbnail_url" class="block text-sm font-medium text-gray-700">Thumbnail URL</label>
            <input type="url" name="thumbnail_url" id="thumbnail_url" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
        </div>

        <div class="mb-4">
            <label for="pdf_path" class="block text-sm font-medium text-gray-700">Attach PDF (optional)</label>
            <input type="file" name="pdf_path" id="pdf_path" accept=".pdf" 
                   class="mt-1 block w-full text-sm text-gray-700 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            <p class="text-xs text-gray-500 mt-1">Upload a related PDF file (like a study guide or notes).</p>
        </div>

        <div class="mb-4">
            <label for="order" class="block text-sm font-medium text-gray-700">Order</label>
            <input type="number" name="order" id="order" 
                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                   required>
        </div>

        <div class="mb-6 flex items-center">
            <input type="hidden" name="is_published" value="0">
            <input type="checkbox" name="is_published" id="is_published" value="1" 
                   class="rounded text-indigo-600 focus:ring-indigo-500">
            <label for="is_published" class="ml-2 block text-sm text-gray-900">Publish video</label>
        </div>

        <div class="flex justify-end">
            <button type="submit" 
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
                Save Video
            </button>
        </div>
    </form>
@endsection
