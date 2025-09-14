{{-- resources/views/community/dashboard.blade.php --}}
@extends('layouts.app')

@section('content')
<style>
    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }

    @keyframes fadeIn { from { opacity:0; transform:translateY(10px); } to { opacity:1; transform:translateY(0); } }
    .post-card { animation: fadeIn 0.5s ease-out forwards; }

    .leaderboard-list li:hover { background-color: rgba(255, 255, 255, 0.05); }

    .custom-scrollbar::-webkit-scrollbar { width: 8px; }
    .custom-scrollbar::-webkit-scrollbar-track { background: #1f2937; }
    .custom-scrollbar::-webkit-scrollbar-thumb { background-color: #4b5563; border-radius: 4px; border: 2px solid #1f2937; }
    .custom-scrollbar { scrollbar-width: thin; scrollbar-color: #4b5563 #1f2937; }

    .card-container { display: grid; grid-template-columns: repeat(1, minmax(0, 1fr)); gap: 2rem; }
    @media (min-width:768px) { .card-container { grid-template-columns: repeat(3, minmax(0, 1fr)); } }
</style>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="flex flex-col md:flex-row gap-8">

            {{-- Main Feed --}}
            <div class="w-full md:w-2/3 bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                {{-- Welcome Banner --}}
                <div class="mb-8 bg-indigo-50 text-indigo-700 p-6 rounded-lg shadow-inner flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0 md:space-x-4">
                    <div class="flex-1">
                        <div class="font-bold text-lg">Welcome! Start here</div>
                        <p class="text-sm mt-1">
                            Find a post you like and leave a comment, or start your own discussion.
                        </p>
                    </div>
                    <div class="flex flex-wrap items-center justify-center md:justify-end gap-3">
                        <a href="{{ route('auth-about') }}" class="inline-flex items-center px-4 py-2 bg-indigo-200 hover:bg-indigo-300 text-sm font-medium rounded-full transition-colors">
                            Watch 60 sec intro video
                        </a>
                    </div>
                </div>

                {{-- Q&A Banner --}}
                <div class="mb-8 bg-indigo-600 text-white p-4 rounded-lg shadow-md flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6">
                            <circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/>
                        </svg>
                        <span id="qna-banner-text" class="font-semibold">{{ $qnaEventText ?? 'Q&A is happening soon' }}</span>
                    </div>
                    <a href="{{ route('calendar') }}" class="bg-white text-indigo-600 px-4 py-2 rounded-full font-semibold text-sm hover:bg-gray-100 transition-colors">
                        Join Now
                    </a>
                </div>

                {{-- New Post Button --}}
                <div class="mb-8 flex justify-between items-center">
                    <button id="open-dialog-btn" type="button" class="flex items-center space-x-2 px-4 py-2 rounded-full bg-indigo-600 text-white font-semibold shadow-md hover:bg-indigo-700 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 20h9"/><path d="M17 2.121a3 3 0 0 1 5.364 1.415L17.5 12.5 12 13l.4-5.365 4.5-8.484z"/>
                        </svg>
                        <span>New Post</span>
                    </button>
                </div>

                {{-- Category Filter --}}
                <div class="flex overflow-x-auto hide-scrollbar pb-2 mb-8 space-x-2">
                    <button class="category-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 font-medium whitespace-nowrap" data-category-id="all">All</button>
                    @foreach($allCategories as $category)
                        <button class="category-btn px-4 py-2 rounded-full bg-gray-200 text-gray-700 font-medium whitespace-nowrap" data-category-id="{{ $category->id }}">
                            {{ $category->name }}
                        </button>
                    @endforeach
                </div>

                {{-- Posts --}}
                    <div id="posts-container" class="space-y-6">
                        @foreach($posts as $post)
                            <div class="post-card bg-white rounded-xl shadow p-6 space-y-4" data-category-id="{{ $post->category->id }}">
                                <div class="flex items-start space-x-4">
                                    <img src="{{ $post->author->profile_photo_url }}" alt="{{ $post->author->name }} avatar" class="w-12 h-12 rounded-full object-cover border-2 border-indigo-500" />
                                    <div class="flex-1">
                                        <div class="flex items-center justify-between">
                                            <div>
                                                <h3 class="font-bold text-gray-900">{{ $post->author->name }}</h3>
                                                <p class="text-xs text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                                            </div>
                                            <div class="bg-indigo-100 text-indigo-700 text-xs font-semibold px-2 py-1 rounded-full">
                                                {{ $post->category->name }}
                                            </div>
                                        </div>
                                        <h4 class="mt-2 font-semibold text-gray-900">{{ $post->title }}</h4>
                                        <p class="mt-1 text-gray-700 leading-relaxed">{{ $post->content }}</p>

                                        {{-- Like & Comment Buttons --}}
                                        <div class="flex items-center space-x-4 mt-4 text-gray-500">
                                            <div class="flex items-center space-x-1 cursor-pointer like-btn"
                                                data-post-id="{{ $post->id }}"
                                                data-like-url="{{ route('posts.like', $post->id) }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4">
                                                    <path d="M7 10v12c0 .6.4 1 1 1h3v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3V3a6 6 0 0 0-6-6v3"/>
                                                </svg>
                                                <span class="like-count">{{ $post->likes->count() }}</span>
                                            </div>
                                            <div class="flex items-center space-x-1 cursor-pointer comment-btn" data-post-id="{{ $post->id }}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" class="w-4 h-4">
                                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                                                </svg>
                                                <span class="comment-count">{{ $post->comments->count() }}</span>
                                            </div>
                                        </div>
                                        
                                        {{-- Inline Comment Form (hidden by default) --}}
                                        <form class="comment-form mt-2 space-x-2 hidden" data-post-id="{{ $post->id }}">
                                            <input type="text" name="content" placeholder="Write a comment..." class="border rounded px-2 py-1 w-3/4">
                                            <button type="submit" class="bg-indigo-600 text-white px-3 py-1 rounded">Post</button>
                                        </form>

                                        {{-- Comments List --}}
                                        <div class="comments-list mt-2 space-y-2" data-post-id="{{ $post->id }}">
                                            @foreach($post->comments as $comment)
                                                <div class="flex items-center space-x-2 text-sm">
                                                    <img src="{{ $comment->user->profile_photo_url }}" alt="{{ $comment->user->name }}" class="w-6 h-6 rounded-full">
                                                    <div>
                                                        <p class="font-semibold">{{ $comment->user->name }}</p>
                                                        <p>{{ $comment->content }}</p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                <div class="text-center mt-8">
                    {{ $posts->links() }}
                </div>
            </div>

            {{-- Sidebar --}}
            <div class="w-full md:w-1/3 space-y-8">

                {{-- Recent Posts --}}
                <div class="bg-white overflow-hidden shadow-sm rounded-lg p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 border-b border-gray-200 pb-2">Recent Posts</h3>
                    <div id="recent-posts-container" class="space-y-4">
                        @foreach($recentPosts as $recentPost)
                            <div class="flex items-start space-x-3">
                                <img src="{{ $recentPost->author->profile_photo_url }}" alt="{{ $recentPost->author->name }}" class="w-8 h-8 rounded-full">
                                <div class="flex-1">
                                    <p class="text-xs font-semibold text-gray-900">{{ $recentPost->author->name }}</p>
                                    <p class="text-sm text-gray-700 line-clamp-2">{{ $recentPost->content }}</p>
                                    <span class="text-xs text-gray-500">{{ $recentPost->created_at->diffForHumans() }} in <span class="text-indigo-600">{{ $recentPost->category->name }}</span></span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Community Stats & Leaderboard omitted for brevity (keep your original code here) --}}
                {{-- Community Stats --}} <div class="bg-white rounded-xl shadow-sm p-6 space-y-4"> <h4 class="text-md font-bold flex items-center space-x-2 text-gray-900"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-indigo-600"> <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/> </svg> <span>Community Stats</span> </h4> <div class="grid grid-cols-2 gap-4 text-sm font-medium text-gray-900"> <div class="bg-gray-100 p-3 rounded-lg text-center"> <p class="text-2xl font-bold">{{ $membersCount }}</p> <p class="text-gray-500">Members</p> </div> <div class="bg-gray-100 p-3 rounded-lg text-center"> <p class="text-2xl font-bold">{{ $postsCount }}</p> <p class="text-gray-500">Posts</p> </div> <div class="bg-gray-100 p-3 rounded-lg text-center flex items-center justify-center space-x-2"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-green-500"> <circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/> </svg> <p class="text-lg font-bold">{{ count($onlineMembers) }}</p> <p class="text-gray-500">Online</p> </div> <div class="bg-gray-100 p-3 rounded-lg text-center flex items-center justify-center space-x-2"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-yellow-500"> <path d="m14 19-3 3v-2.18l-5.69-5.69a1 1 0 0 1 0-1.42l5.69-5.69a1 1 0 0 1 1.42 0L19 12l3 3h-2.18l-5.69 5.69a1 1 0 0 1-1.42 0L14 19Z"/> <circle cx="12" cy="12" r="2"/> </svg> <p class="text-lg font-bold">{{ $adminsCount }}</p> <p class="text-gray-500">Admins</p> </div> </div> {{-- Online Members --}} <div class="border-t border-gray-200 pt-4"> <h5 class="text-sm font-semibold mb-2 text-gray-900">Online Now</h5> <ul class="space-y-1 text-sm text-gray-700"> @foreach ($onlineMembers as $member) <li class="flex items-center space-x-2"> <span class="w-2 h-2 bg-green-500 rounded-full block"></span> <span>{{ $member }}</span> </li> @endforeach </ul> </div> </div> {{-- Leaderboard --}} <div class="bg-white rounded-xl shadow-sm p-6 space-y-4"> <h4 class="text-md font-bold flex items-center space-x-2 text-gray-900"> <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-yellow-500"> <path d="M12 8V4l-6 8h4L8 20l6-8H10z"/><path d="M18 10h4l-3-6H15zM21 16h-4l3 6h4z"/> </svg> <span>Leaderboard</span> </h4> <ul class="space-y-3"> @foreach ($leaderboard as $key => $user) <li class="flex items-center justify-between"> <div class="flex items-center space-x-3"> <span class="font-bold text-lg text-gray-500 w-6 text-center">{{ $key + 1 }}</span> <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }} avatar" class="w-8 h-8 rounded-full object-cover" /> <span class="text-sm font-medium text-gray-900">{{ $user->name }}</span> </div> <span class="text-sm text-gray-600 font-semibold">{{ $user->score }} pts</span> </li> @endforeach </ul> </div> </div> </div> </div> </div>

            </div>
        </div>
    </div>
</div>

{{-- Post Modal --}}
<div id="post-dialog" class="fixed inset-0 z-50 hidden items-center justify-center bg-gray-900 bg-opacity-75 p-4">
    <div class="bg-white rounded-xl shadow-2xl w-full max-w-2xl transform scale-95 md:scale-100 transition-transform duration-300">
        <div class="p-6 border-b border-gray-200 flex items-center justify-between">
            <h2 class="text-xl font-semibold text-gray-900">Create a New Post</h2>
            <button id="close-dialog-btn" class="p-1 rounded-full hover:bg-gray-100 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" stroke-width="2" class="w-5 h-5 text-gray-500">
                    <path d="M18 6 6 18"/><path d="m6 6 12 12"/>
                </svg>
            </button>
        </div>
        <form id="post-form" class="p-6 space-y-4">
            <div class="flex items-center space-x-4">
                <div class="flex-shrink-0">
                    <img src="{{ auth()->user()->profile_photo_url }}" alt="{{ auth()->user()->name }}" class="w-12 h-12 rounded-full object-cover border-2 border-indigo-500" />
                </div>
                <div>
                    <p class="text-gray-700 font-semibold">{{ auth()->user()->name }}</p>
                </div>
            </div>

            <input type="text" name="title" placeholder="Post Title" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-600" />
            <textarea name="content" placeholder="What's on your mind?" required class="w-full border border-gray-300 rounded-lg px-4 py-2 h-32 resize-none focus:outline-none focus:ring-2 focus:ring-indigo-600"></textarea>

            <select name="category_id" required class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-600">
                <option value="" disabled selected>Select a category</option>
                @foreach($allCategories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <div class="flex justify-end space-x-3">
                <button type="button" id="cancel-dialog-btn" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 transition-colors">Cancel</button>
                <button type="submit" class="px-4 py-2 rounded-lg bg-indigo-600 text-white hover:bg-indigo-700 transition-colors">Post</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {

    // Post Modal
    const openBtn = document.getElementById('open-dialog-btn');
    const closeBtn = document.getElementById('close-dialog-btn');
    const cancelBtn = document.getElementById('cancel-dialog-btn');
    const dialog = document.getElementById('post-dialog');
    const form = document.getElementById('post-form');

    openBtn.addEventListener('click', () => dialog.classList.remove('hidden'));
    closeBtn.addEventListener('click', () => dialog.classList.add('hidden'));
    cancelBtn.addEventListener('click', () => dialog.classList.add('hidden'));

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const data = new FormData(form);
        fetch("{{ route('posts.store') }}", {
            method: "POST",
            headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            body: data
        })
        .then(res => res.json())
        .then(res => {
            if(res.success){
                alert('Post created successfully!');
                form.reset();
                dialog.classList.add('hidden');
                location.reload();
            }
        }).catch(err => console.error(err));
    });

    // Category Filter
    const categoryButtons = document.querySelectorAll('.category-btn');
    const posts = document.querySelectorAll('#posts-container > .post-card');

    categoryButtons.forEach(btn => btn.addEventListener('click', () => {
        const categoryId = btn.getAttribute('data-category-id');
        categoryButtons.forEach(b => b.classList.remove('bg-indigo-600','text-white'));
        btn.classList.add('bg-indigo-600','text-white');

        posts.forEach(post => {
            const postCategoryId = post.getAttribute('data-category-id');
            post.style.display = (categoryId === 'all' || postCategoryId === categoryId) ? 'block' : 'none';
        });
    }));

    // Likes
    document.querySelectorAll('.like-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const url = btn.dataset.likeUrl;
            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({})
            })
            .then(res => res.json())
            .then(data => {
                if(data.success){
                    btn.querySelector('.like-count').textContent = data.likes_count;
                    btn.classList.toggle('text-indigo-600');
                } else if(data.error) {
                    alert(data.error);
                }
            })
            .catch(err => console.error('Error liking post:', err));
        });
    });

    // Comments toggle and submission
    document.querySelectorAll('.comment-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const postId = btn.getAttribute('data-post-id');
            const postCard = btn.closest('.post-card');
            const commentForm = postCard.querySelector(`.comment-form[data-post-id="${postId}"]`);
            const commentsList = postCard.querySelector(`.comments-list[data-post-id="${postId}"]`);

            commentForm.classList.toggle('hidden');

            if (!commentForm.dataset.listenerAttached) {
                commentForm.dataset.listenerAttached = true;

                commentForm.addEventListener('submit', e => {
                    e.preventDefault();
                    const contentInput = commentForm.querySelector('input[name="content"]');
                    const content = contentInput.value.trim();
                    if(!content) return;

                    fetch(`/posts/${postId}/comment`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'Accept': 'application/json',
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ content })
                    })
                    .then(res => res.json())
                    .then(data => {
                        if(data.success){
                            contentInput.value = '';
                            btn.querySelector('.comment-count').textContent = data.comments_count;

                            const newComment = document.createElement('div');
                            newComment.classList.add('flex', 'items-center', 'space-x-2', 'text-sm');
                            newComment.innerHTML = `
                                <img src="${data.comment.user_avatar}" class="w-6 h-6 rounded-full">
                                <div>
                                    <p class="font-semibold">${data.comment.user_name}</p>
                                    <p>${data.comment.content}</p>
                                </div>
                            `;
                            commentsList.appendChild(newComment);
                        } else if(data.error) {
                            alert(data.error);
                        }
                    })
                    .catch(err => console.error('Error posting comment:', err));
                });
            }
        });
    });

});
</script>

@endsection
