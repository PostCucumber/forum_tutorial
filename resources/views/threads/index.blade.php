@extends('layouts.app')

@section('content')
    <div class="flex items-center">
        <div class="md:w-1/2 md:mx-auto">

            @if (session('status'))
                <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="flex flex-col break-words bg-white border border-2 rounded shadow-md">
                <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
                    Forum Threads
                </div>
                <div class="w-full p-6">
                    <p class="text-gray-700">
                        @foreach($threads as $thread)
                            <article class="mb-4">
                                <div class="flex items-center">
                                    <h3 class="flex-1 mb-2">
                                        <a href="{{ $thread->path() }}">
                                            {{ $thread->title }}
                                        </a>    
                                    </h3>
                                    <a href="{{ $thread->path() }}" class="font-bold">{{ $thread->replies_count }} {{ Str::plural('reply', $thread->replies_count) }}</a>
                                </div>
                                <div class="pb-4">{{ $thread->body }}</div>
                            </article>
                        @endforeach
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
