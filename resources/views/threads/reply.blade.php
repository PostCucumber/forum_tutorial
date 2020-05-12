<div class="flex flex-col break-words bg-white border border-2 rounded shadow-md mb-4">
    <div class="w-full p-6">
        <p class="">
            <a href="#">
                {{ $reply->owner->name }}
            </a>
            said {{ $reply->created_at->diffForHumans() }}
        </p>
        <p class="text-gray-700 pt-1">
            {{ $reply->body }}
        </p>
    </div>
</div>
