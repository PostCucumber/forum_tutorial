@extends('layouts.app')

@section('content')
    <div class="flex items-center">
        <div class="md:w-1/2 md:mx-auto">

            @if (session('status'))
                <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="flex flex-col break-words">
                Forum Threads
                <div class="w-full">
                    <p class="text-gray-700">
                        @forelse($threads as $thread)
                            <article class="my-4 p-6 bg-white rounded shadow">
                                <div class="flex items-center">
                                    <h3 class="flex-1 mb-2">
                                        <a href="{{ $thread->path() }}">
                                            {{ $thread->title }}
                                        </a>    
                                    </h3>
                                    <a href="{{ $thread->path() }}" class="pb-3">{{ $thread->replies_count }} {{ Str::plural('reply', $thread->replies_count) }}</a>
                                </div>
                                <div class="pb-4">{{ $thread->body }}</div>
                            </article>
                        @empty
                            <p>There are no relevant results.</p>
                        @endforelse
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
