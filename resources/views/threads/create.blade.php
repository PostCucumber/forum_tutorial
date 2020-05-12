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
                    Create Thread
                </div>

                <div class="flex flex-wrap w-full p-6">
                    <form method="POST" action="/threads" class="w-full">
                       @csrf
                       <div class="mb-4">
                           <label for="channel_id" class="">Choose a channel</label>
                           <select name="channel_id" id="channel_id" class="mt-2 h-8 w-full" required>
                                <option value="">Choose one...</option>    
                                @foreach($channels as $channel)
                                    <option value="{{ $channel->id }}" {{ old('channel_id') == $channel->id ? 'selected' : '' }}>
                                        {{ $channel->name }}
                                    </option>
                               @endforeach
                           </select>
                       </div>
                       <div class="flex flex-wrap w-full mb-4">
                           <label for="title" class="w-full mb-2">Title</label>
                           <input type="text" id="title" name="title" value="{{ old('title') }}" class="w-full border rounded p-2 text-3xl" required>
                       </div>
                       <div class="flex flex-wrap w-full mb-4">
                           <label for="body" class="w-full mb-2">Body</label>
                           <textarea name="body" id="body" rows="8" class="w-full border rounded p-2" required>
                               {{ old('body') }}
                            </textarea>
                       </div>
                       <button type="submit">
                            Publish
                       </button> 
                        @if(count($errors))
                            <ul class="bg-red-100 border border-red-400 text-red-700 mt-4 px-4 py-3 rounded">
                                @foreach ($errors->all() as $error)        
                                    <li class="py-1">{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection