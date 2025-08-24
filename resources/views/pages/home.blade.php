@extends('layouts.public')

@section('title', 'Home - SynFlow AI')

@section('content')
    <div class="container mx-auto px-4 py-16 text-center">
        <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl md:text-6xl">
            <span class="block">AI Development & Learning</span>
            <span class="block text-indigo-600">for Kenya and Beyond</span>
        </h1>
        <p class="mt-4 max-w-md mx-auto text-base text-gray-500 sm:text-lg md:mt-5 md:text-xl md:max-w-3xl">
            We build custom AI solutions and foster a community of learners to drive innovation across Africa.
        </p>
        <div class="mt-8 flex justify-center space-x-4">
            <a href="{{ route('services') }}" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                Explore Services
            </a>
            <a href="#" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-indigo-100 hover:bg-indigo-200">
                Join Community
            </a>
        </div>
    </div>

    <!-- New Section: Impact & Results -->
    <div class="bg-gray-50 py-16">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                We don't sell AI. We sell Results.
            </h2>
            <p class="mt-4 text-gray-500">
                <a href="https://www.youtube.com/@SynFlowAI" class="text-indigo-600 hover:text-indigo-700 font-medium">Watch our content here &rarr;</a>
            </p>

            <div class="mt-12 grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
                <!-- Metric 1 -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <!-- The data-target attribute holds the final number to count to. -->
                    <p class="text-5xl font-extrabold text-indigo-600 data-counter" data-target="17000000">0</p>
                    <p class="mt-2 text-lg font-medium text-gray-500">
                        Professionals upskilled in AI via our platforms
                    </p>
                </div>

                <!-- Metric 2 -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <p class="text-5xl font-extrabold text-indigo-600 data-counter" data-target="435">0</p>
                    <p class="mt-2 text-lg font-medium text-gray-500">
                        AI Opportunities identified for businesses
                    </p>
                </div>

                <!-- Metric 3 -->
                <div class="bg-white rounded-lg shadow-lg p-6">
                    <p class="text-5xl font-extrabold text-indigo-600 data-counter" data-target="55">0</p>
                    <p class="mt-2 text-lg font-medium text-gray-500">
                        Bespoke AI solutions developed
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Select all elements with the 'data-counter' class.
            const counters = document.querySelectorAll('.data-counter');

            // Set up a new IntersectionObserver to watch for elements entering the viewport.
            const observer = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    // Check if the element is currently visible.
                    if (entry.isIntersecting) {
                        const counterElement = entry.target;
                        // Get the target number from the 'data-target' attribute.
                        const target = parseInt(counterElement.dataset.target, 10);
                        const duration = 2000; // Animation duration in milliseconds.
                        const startTimestamp = performance.now();
                        
                        // Define the update function for the animation frame.
                        const updateCount = (timestamp) => {
                            const elapsed = timestamp - startTimestamp;
                            const progress = Math.min(elapsed / duration, 1);
                            const currentValue = Math.floor(progress * target);
                            
                            // Format the number based on its size and add the appropriate suffix.
                            let formattedValue;
                            if (target >= 1000000) {
                                formattedValue = (currentValue / 1000000).toFixed(1) + 'M+';
                            } else {
                                formattedValue = currentValue + '+';
                            }
                            
                            counterElement.textContent = formattedValue;
                            
                            // Continue the animation until progress is 1.
                            if (progress < 1) {
                                requestAnimationFrame(updateCount);
                            }
                        };
                        
                        // Start the animation.
                        requestAnimationFrame(updateCount);

                        // Stop observing the element after the animation has started.
                        observer.unobserve(counterElement);
                    }
                });
            }, {
                // The threshold determines how much of the element needs to be visible to trigger the observer.
                threshold: 0.5
            });

            // Tell the observer to watch each counter element.
            counters.forEach(counter => {
                observer.observe(counter);
            });
        });
    </script>
@endsection
