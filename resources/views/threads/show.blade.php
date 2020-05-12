@extends('layouts.app')

@section('content')
    <div class="flex flex-wrap items-center">
        <div class="md:w-1/2 md:mx-auto">

            @if (session('status'))
                <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                    {{ session('status') }}
                </div>
            @endif

            <div class="flex flex-col break-words bg-white border border-2 rounded shadow-md mb-4">
                <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
                    <span class="font-thin text-sm">{{ $thread->owner->name }} posted</span> <h2 class="pt-2">{{ $thread->title }}</h2>
                </div>
                <div class="w-full p-6">
                    <p class="text-gray-700">
                        {{ $thread->body }}
                    </p>
                </div>
            </div>
            @foreach($thread->replies as $reply)
                @include ('threads.reply')
            @endforeach
        </div>
        @if(auth()->check())
            <div class="flex w-full justify-center">
                <div class="md:w-1/2">
                    <form method="POST" action="{{ $thread->path() . '/replies' }}">
                        {{ csrf_field() }}
                        <textarea name="body" id="body" class="w-full mb-4 p-4 h-20 rounded shadow"></textarea>
                        <button type="submit" class="float-right">Add Comment</button>
                    </form>
                </div>
            </div>
        @else
            <div class="flex w-full justify-center">
                <p>Please <a href="{{ route('login') }}">sign in</a> to participate in this forum.</p>
            </div>
        @endif
    </div>
@endsection
