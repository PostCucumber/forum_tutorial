@extends('layouts.app')

@section('content')
    <div class="flex flex-wrap items-start mx-20">
        <div class="md:w-2/3 flex flex-wrap items-center">
            @if (session('status'))
                <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <div class="flex flex-col break-words w-full bg-white border border-2 rounded shadow-md mb-4">
                <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
                    <span class="font-thin text-sm"><a href="#">{{ $thread->owner->name }}</a> posted</span> <h2 class="pt-2">{{ $thread->title }}</h2>
                </div>
                <div class="w-full p-6">
                    <p class="text-gray-700 break-all leading-normal">
                        {{ $thread->body }}
                    </p>
                </div>
            </div>
            <div class="w-full">
                @foreach($replies as $reply)
                    @include ('threads.reply')
                @endforeach
            </div>

            <div class="mb-4">
                {{ $replies->links() }}
            </div>

            @if(auth()->check())
                <div class="flex w-full">
                    <form method="POST" action="{{ $thread->path() . '/replies' }}" class="w-full">
                        {{ csrf_field() }}
                        <textarea name="body" id="body" class="w-full mb-4 p-4 h-20 rounded shadow"></textarea>
                        <button type="submit" class="float-right">Add Comment</button>
                    </form>
                </div>
            @else
                <div class="flex w-full pl-6 pb-4">
                    <p>Please <a href="{{ route('login') }}">sign in</a> to participate in this forum.</p>
                </div>
            @endif
        </div>
        <div class="w-1/3">
            <div class="md:ml-4 p-6 bg-white rounded shadow">
                <p>
                    This thread was published {{ $thread->created_at->diffForHumans() }} by
                    <a href="#">{{ $thread->owner->name }}</a>, and currently has
                    {{ $thread->replies_count }} {{ Str::plural('comment', $thread->replies_count) }}
                </p>
            </div>
        </div>
    </div>
@endsection
