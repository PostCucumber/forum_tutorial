<div class="flex flex-col break-words bg-white border border-2 rounded shadow-md mb-4">
    <div class="w-full p-6">
        <div class="flex items-center pb-4">
            <p class="flex-1">
                <a href="/profiles/{{ $reply->owner->name }}">
                    {{ $reply->owner->name }}
                </a>
                said {{ $reply->created_at->diffForHumans() }}
            </p>
            <div>
                <form method="POST" action="/replies/{{ $reply->id }}/favorites">
                    {{ csrf_field() }}
                    
                    <button type="submit" {{ $reply->isFavorited() ? 'disabled' : '' }}>
                        {{ $reply->favorites_count }} {{ Str::plural('favorite', $reply->favorites_count) }}
                    </button>
                </form>
            </div>
        </div>
        <p class="text-gray-700 pt-1">
            {{ $reply->body }}
        </p>
    </div>
</div>
