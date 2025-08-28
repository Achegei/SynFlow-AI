@extends('layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto p-8 rounded-2xl">
        <h1 class="text-3xl font-bold mb-6 text-gray-900 dark:text-gray-100">Create New Course</h1>

        <!-- Course Creation Form -->
        <form action="{{ route('admin.courses.store') }}" method="POST">
            @csrf

            <!-- Course Details Section -->
            <div class="space-y-4 mb-8">
                <h2 class="text-2xl font-semibold border-b pb-2 text-gray-800 dark:text-gray-200">Course Information</h2>
                <div>
                    <label for="title" class="block text-sm font-medium">Course Title</label>
                    <input type="text" name="title" id="title" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2">
                </div>
                <div>
                    <label for="description" class="block text-sm font-medium">Course Description</label>
                    <textarea name="description" id="description" rows="4" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2"></textarea>
                </div>
                <div>
                    <label for="image_url" class="block text-sm font-medium">Course Image URL</label>
                    <input type="url" name="image_url" id="image_url" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2">
                </div>
            </div>

            <!-- Videos (Episodes) Section -->
            <div id="episodes-container" class="space-y-6">
                <h2 class="text-2xl font-semibold border-b pb-2 text-gray-800 dark:text-gray-200">Videos</h2>
                <!-- Initial video input fields -->
                <div class="episode-group bg-gray-50 dark:bg-gray-700 p-6 rounded-xl border border-gray-200 dark:border-gray-600">
                    <h3 class="font-medium mb-2 text-gray-800 dark:text-gray-200">Video 1</h3>
                    <div class="space-y-4">
                        <div>
                            <label for="episodes[0][title]" class="block text-sm font-medium">Video Title</label>
                            <input type="text" name="episodes[0][title]" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2">
                        </div>
                        <div>
                            <label for="episodes[0][description]" class="block text-sm font-medium">Video Description</label>
                            <textarea name="episodes[0][description]" rows="2" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2"></textarea>
                        </div>
                        <div>
                            <label for="episodes[0][video_url]" class="block text-sm font-medium">Video URL</label>
                            <input type="url" name="episodes[0][video_url]" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Dynamic button to add more videos -->
            <div class="mt-6 flex justify-end">
                <button type="button" id="add-episode-btn" class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded-full transition duration-150 ease-in-out">
                    <i class="fas fa-plus mr-2"></i>Add Another Video
                </button>
            </div>

            <div class="mt-8">
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-xl shadow-lg transition duration-150 ease-in-out">
                    Create Course
                </button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const addEpisodeBtn = document.getElementById('add-episode-btn');
        const episodesContainer = document.getElementById('episodes-container');
        let episodeIndex = 1;

        addEpisodeBtn.addEventListener('click', function () {
            const newEpisodeHtml = `
                <div class="episode-group bg-gray-50 dark:bg-gray-700 p-6 rounded-xl border border-gray-200 dark:border-gray-600 mt-4">
                    <h3 class="font-medium mb-2 text-gray-800 dark:text-gray-200">Video ${episodeIndex + 1}</h3>
                    <div class="space-y-4">
                        <div>
                            <label for="episodes[${episodeIndex}][title]" class="block text-sm font-medium">Video Title</label>
                            <input type="text" name="episodes[${episodeIndex}][title]" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2">
                        </div>
                        <div>
                            <label for="episodes[${episodeIndex}][description]" class="block text-sm font-medium">Video Description</label>
                            <textarea name="episodes[${episodeIndex}][description]" rows="2" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2"></textarea>
                        </div>
                        <div>
                            <label for="episodes[${episodeIndex}][video_url]" class="block text-sm font-medium">Video URL</label>
                            <input type="url" name="episodes[${episodeIndex}][video_url]" required class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 p-2">
                        </div>
                    </div>
                </div>
            `;
            episodesContainer.insertAdjacentHTML('beforeend', newEpisodeHtml);
            episodeIndex++;
        });
    });
</script>
@endsection
