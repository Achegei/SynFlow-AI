@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Edit Video</h1>

    @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.videos.update', $video->id) }}" method="POST" class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $video->title) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-100" required>
        </div>
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Description</label>
            <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-100">{{ old('description', $video->description) }}</textarea>
        </div>
        <div class="mb-4">
            <label for="video_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Video URL</label>
            <input type="url" name="video_url" id="video_url" value="{{ old('video_url', $video->video_url) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-100" required>
        </div>
        <div class="mb-4">
            <label for="thumbnail_url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Thumbnail URL</label>
            <input type="url" name="thumbnail_url" id="thumbnail_url" value="{{ old('thumbnail_url', $video->thumbnail_url) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-100">
        </div>
        <div class="mb-4">
            <label for="order" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Order</label>
            <input type="number" name="order" id="order" value="{{ old('order', $video->order) }}" class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-gray-100" required>
        </div>
        <div class="mb-6 flex items-center">
            <input type="hidden" name="is_published" value="0">
            <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', $video->is_published) ? 'checked' : '' }} class="rounded text-indigo-600 focus:ring-indigo-500">
            <label for="is_published" class="ml-2 block text-sm text-gray-900 dark:text-gray-100">Publish video</label>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">Update Video</button>
        </div>
    </form>
@endsection
