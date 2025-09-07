{{-- 
     resources/views/community/leaderboard.blade.php 
 
     This file contains the front-end layout for the community leaderboard, 
     built with HTML and Tailwind CSS, using Laravel Blade syntax for dynamic content. 
 
     This view assumes the following data is passed from a Laravel controller: 
     - $currentUser (optional): An authenticated user object. 
     - $leaderboard7Day: An array of user objects with a 'score' property for a 7-day leaderboard. 
     - $leaderboard30Day: An array of user objects with a 'score' property for a 30-day leaderboard. 
     - $leaderboardAllTime: An array of user objects with a 'score' property for an all-time leaderboard. 
     - $levels: An array of level objects or associative arrays. 
     - $lastUpdated: A string or Carbon instance for the last updated time. 
     - $nonAdminMembers: The total count of members who are NOT admins. 
 --}} 
 @extends('layouts.app') 

 @section('content') 
     <!-- Custom Styles for this page only --> 
     <style> 
         /* A slight hover effect on list items */ 
         .leaderboard-list li:hover { 
             background-color: rgba(255, 255, 255, 0.05); 
         } 
         /* Custom scrollbar styling for better aesthetics */ 
         .custom-scrollbar::-webkit-scrollbar { 
             width: 8px; 
         } 
         .custom-scrollbar::-webkit-scrollbar-track { 
             background: #1f2937; /* */ 
         } 
         .custom-scrollbar::-webkit-scrollbar-thumb { 
             background-color: #4b5563; /* */ 
             border-radius: 4px; 
             border: 2px solid #1f2937; 
         } 
         .custom-scrollbar { 
             scrollbar-width: thin; 
             scrollbar-color: #4b5563 #1f2937; 
         } 
         .card-container { 
             display: grid; 
             grid-template-columns: repeat(1, minmax(0, 1fr)); 
             gap: 2rem; 
         } 
         @media (min-width: 768px) { 
             .card-container { 
                 grid-template-columns: repeat(3, minmax(0, 1fr)); 
             } 
         } 
     </style> 
 
     <div class="max-w-6xl mx-auto space-y-8"> 
         <!-- Header --> 
         <header class="text-center"> 
             <h1 class="text-3xl font-bold mb-2">Community Leaderboard</h1> 
             <p class="text-gray-500 text-sm"> 
                 Last updated: <span id="last-updated">{{ $lastUpdated ?? 'Not available' }}</span> | Total Members: <span id="member-count">{{ $nonAdminMembers ?? '...' }}</span> 
             </p>
         </header> 
 
         <!-- User's Benchmark Section (Conditionally Rendered) --> 
         @if(isset($currentUser)) 
             <div class="bg-white rounded-2xl shadow-lg p-6 md:p-8 flex flex-col md:flex-row items-center md:items-start space-y-4 md:space-y-0 md:space-x-8"> 
                 <!-- User Avatar and Points Section --> 
                 <div class="flex-shrink-0 flex flex-col items-center space-y-4"> 
                     <img src="{{ $currentUser->profile_photo_url ?? 'https://placehold.co/100x100/A5B4FC/4338CA?text=LE' }}" alt="{{ $currentUser->name ?? 'User' }}" class="w-24 h-24 rounded-full border-2 border-indigo-500 shadow-md"> 
                     <div class="flex items-center space-x-4"> 
                         <div class="bg-indigo-50 p-3 rounded-xl text-center"> 
                             <p class="text-xl font-bold text-indigo-600">{{ $currentUser->points_to_level_up ?? '5' }}</p> 
                             <p class="text-xs text-gray-500 mt-1">points to level up</p> 
                         </div> 
                         <div class="bg-indigo-50 p-3 rounded-xl text-center"> 
                             <p class="text-xl font-bold text-indigo-600">{{ $currentUser->member_percentage ?? '87' }}%</p> 
                             <p class="text-xs text-gray-500 mt-1">of members</p> 
                         </div> 
                     </div> 
                 </div> 
                 
                 <!-- Levels Section --> 
                 <div class="flex-grow w-full md:w-auto"> 
                     <h3 class="text-lg font-semibold mb-4 text-center md:text-left">{{ $currentUser->name ?? 'N/A' }}</h3> 
                     <div class="grid grid-cols-1 md:grid-cols-2 gap-8"> 
                         <!-- Levels 1-5 Column --> 
                         <div> 
                             <h4 class="font-semibold mb-2">Levels 1 - 5</h4> 
                             <ul class="space-y-2"> 
                                 @foreach(collect($levels ?? [])->slice(0, 5) as $level) 
                                     <li class="flex items-center space-x-2 text-sm"> 
                                         <span class="font-bold text-gray-400">Level {{ $level['level'] }}</span> 
                                         <span class="flex-1 border-b border-gray-200 border-dotted"></span> 
                                         <span class="text-gray-500">{{ $level['percentage'] }}% of members</span> 
                                     </li> 
                                 @endforeach 
                             </ul> 
                         </div> 
                         <!-- Levels 6-9 Column --> 
                         <div> 
                             <h4 class="font-semibold mb-2">Levels 6 - 9</h4> 
                             <ul class="space-y-2"> 
                                 @foreach(collect($levels ?? [])->slice(5, 9) as $level) 
                                     <li class="flex items-center space-x-2 text-sm"> 
                                         <span class="font-bold text-gray-400">Level {{ $level['level'] }}</span> 
                                         <span class="flex-1 border-b border-gray-200 border-dotted"></span> 
                                         <span class="text-gray-500">{{ $level['percentage'] }}% of members</span> 
                                     </li> 
                                 @endforeach 
                             </ul> 
                         </div> 
                     </div> 
                 </div> 
             </div> 
         @else 
             <div class="text-center text-gray-500 p-8"> 
                 <p>Please log in to see your personal benchmark.</p> 
             </div> 
         @endif 
 
         <!-- Leaderboard Sections in 3 Cards --> 
         <div class="card-container"> 
             <!-- 7-Day Leaderboard Card --> 
             <div class="bg-white rounded-2xl shadow-lg p-4 custom-scrollbar overflow-y-auto max-h-[400px]"> 
                 <h2 class="text-xl font-bold mb-4 text-center">Leaderboard (7-day)</h2> 
                 <ul class="space-y-2 leaderboard-list"> 
                     @forelse($leaderboard7Day ?? [] as $key => $user) 
                         <li class="flex items-center justify-between p-2 rounded-xl transition-colors"> 
                             <div class="flex items-center space-x-4"> 
                                 <span class="font-bold text-lg w-6 text-center">{{ $key + 1 }}</span> 
                                 <img src="{{ $user['profile_photo_url'] ?? 'https://placehold.co/100x100/A5B4FC/4338CA?text=NA' }}" alt="{{ $user['name'] ?? 'User' }}" class="w-10 h-10 rounded-full object-cover shadow-sm"> 
                                 <span class="text-sm font-medium">{{ $user['name'] ?? 'N/A' }}</span> 
                                 @if($user['is_hot_streak'] ?? false) 
                                     <span class="text-yellow-400 text-lg ml-1">🔥</span> 
                                 @endif 
                             </div> 
                             <span class="font-semibold text-gray-600">+{{ number_format($user['score'] ?? 0) }}</span> 
                         </li> 
                     @empty 
                         <li class="text-center text-gray-400">No data available.</li> 
                     @endforelse 
                 </ul> 
             </div> 
 
             <!-- 30-Day Leaderboard Card --> 
             <div class="bg-white rounded-2xl shadow-lg p-4 custom-scrollbar overflow-y-auto max-h-[400px]"> 
                 <h2 class="text-xl font-bold mb-4 text-center">Leaderboard (30-day)</h2> 
                 <ul class="space-y-2 leaderboard-list"> 
                     @forelse($leaderboard30Day ?? [] as $key => $user) 
                         <li class="flex items-center justify-between p-2 rounded-xl transition-colors"> 
                             <div class="flex items-center space-x-4"> 
                                 <span class="font-bold text-lg w-6 text-center">{{ $key + 1 }}</span> 
                                 <img src="{{ $user['profile_photo_url'] ?? 'https://placehold.co/100x100/A5B4FC/4338CA?text=NA' }}" alt="{{ $user['name'] ?? 'User' }}" class="w-10 h-10 rounded-full object-cover shadow-sm"> 
                                 <span class="text-sm font-medium">{{ $user['name'] ?? 'N/A' }}</span> 
                                 @if($user['is_hot_streak'] ?? false) 
                                     <span class="text-yellow-400 text-lg ml-1">🔥</span> 
                                 @endif 
                             </div> 
                             <span class="font-semibold text-gray-600">+{{ number_format($user['score'] ?? 0) }}</span> 
                         </li> 
                     @empty 
                         <li class="text-center text-gray-400">No data available.</li> 
                     @endforelse 
                 </ul> 
             </div> 
 
             <!-- All-Time Leaderboard Card --> 
             <div class="bg-white rounded-2xl shadow-lg p-4 custom-scrollbar overflow-y-auto max-h-[400px]"> 
                 <h2 class="text-xl font-bold mb-4 text-center">Leaderboard (all-time)</h2> 
                 <ul class="space-y-2 leaderboard-list"> 
                     @forelse($leaderboardAllTime ?? [] as $key => $user) 
                         <li class="flex items-center justify-between p-2 rounded-xl transition-colors"> 
                             <div class="flex items-center space-x-4"> 
                                 <span class="font-bold text-lg w-6 text-center">{{ $key + 1 }}</span> 
                                 <img src="{{ $user['profile_photo_url'] ?? 'https://placehold.co/100x100/A5B4FC/4338CA?text=NA' }}" alt="{{ $user['name'] ?? 'User' }}" class="w-10 h-10 rounded-full object-cover shadow-sm"> 
                                 <span class="text-sm font-medium">{{ $user['name'] ?? 'N/A' }}</span> 
                                 @if($user['is_hot_streak'] ?? false) 
                                     <span class="text-yellow-400 text-lg ml-1">🔥</span> 
                                 @endif 
                             </div> 
                             <span class="font-semibold text-gray-600">{{ number_format($user['score'] ?? 0) }}</span> 
                         </li> 
                     @empty 
                         <li class="text-center text-gray-400">No data available.</li> 
                     @endforelse 
                 </ul> 
             </div> 
         </div> 
     </div> 
 @endsection 
