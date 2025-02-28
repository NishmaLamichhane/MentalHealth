@extends('layouts.master')

@section('content')

<div class="bg-white p-8 rounded-lg shadow-lg mb-6">
    <h2 class="text-3xl font-extrabold text-blue-800 mb-4 text-center">Explore Our Most Recommended Videos</h2>
    <p class="text-lg text-gray-600 mb-6 text-center">
        If you are feeling mentally or physically drained, these videos are specially curated for your needs. 
        <span class="font-semibold">Let us know if you'd like more content!</span> 
        Leave a comment below, and we'll do our best to accommodate your requests.
    </p>
   

</div>


<div class="container mx-auto my-10">
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach($activities as $activity)
            <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                {{-- Video Container with Aspect Ratio --}}
                <div class="relative" style="padding-top: 56.25%;"> <!-- 16:9 Aspect Ratio -->
                    <iframe class="absolute top-0 left-0 w-full h-full" src="{{ $activity->video_url }}" frameborder="0" allowfullscreen></iframe>
                </div>
                <div class="p-4">
                    <h3 class="font-bold text-lg text-blue-900">{{ $activity->title }}</h3>
                    <p class="text-gray-700 mt-2">{{ Str::limit($activity->description, 100) }}</p>
                </div>
                {{-- Button to Watch More --}}
                <div class="text-center pb-4">
                    <a href="{{ $activity->video_url }}" target="_blank"
                        class="inline-block bg-blue-900 text-white font-semibold py-2 px-4 rounded-md hover:bg-blue-700 transition-colors duration-300">
                        Watch More
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
