@extends('layouts.app')

@section('content')
    <div class="lg:w-1/2 md:w-2/3 w-full md:px-0 px-4 mx-auto">
        <div class="pb-10">
            <h1>
                {{ $profileUser->name }}
            </h1>
            <p>since {{ $profileUser->created_at->diffForHumans() }}</p>
        </div>

        <div class="flex flex-wrap justify-start">
            <div class="w-full">
                <h2>Threads</h2>
            </div>
            @foreach($threads as $thread)
                <div class="flex flex-col break-words w-full bg-white border border-2 rounded shadow-md mb-4">
                    <div>
                        <div class="flex items-center font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
                            <div class="flex-1">
                                <h3><a href="{{ $thread->path() }}">{{ $thread->title }}</a></h3>
                            </div>
                            <div class="">
                                created {{ $thread->created_at->diffForHumans() }}
                            </div>
                        </div>
                    </div>
                    <div class="w-full p-6">
                        <p class="text-gray-700 break-all leading-normal">
                            {{ $thread->body }}
                        </p>
                    </div>
                </div>
            @endforeach

            <div class="">
                {{ $threads->links() }}
            </div>
        </div>
    </div>
@endsection