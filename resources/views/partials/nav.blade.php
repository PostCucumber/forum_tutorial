<nav class="bg-blue-900 shadow mb-8 py-6">
    <div class="container mx-auto px-6 md:px-0">
        <div class="flex items-center justify-center">
            <div class="mr-6">
                <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-100 no-underline mr-4">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <div class="dropdown inline-block relative mr-4">
                    <a>
                        Browse
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down inline-block"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </a>
                    <ul class="dropdown-menu absolute hidden p-4 bg-gray-100 rounded shadow w-40 h-auto overflow-auto">
                        <li class="py-2">
                            <a href="/threads">
                                Recent Threads
                            </a>
                        </li>
                        <li class="py-2">
                            <a href="/threads?popular=1">
                                Popular Threads
                            </a>
                        </li>
                        @if(Auth::check())
                            <li class="py-2">
                                <a href="/threads?by={{ auth()->user()->name }}">
                                    My Threads
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
                <a href="/threads/create" class="mr-4">
                    New Thread
                </a>
                <div class="dropdown inline-block relative mr-4">
                    <a>
                        Channels
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-down inline-block"><polyline points="6 9 12 15 18 9"></polyline></svg>
                    </a>
                    <ul class="dropdown-menu absolute hidden p-4 bg-gray-100 rounded shadow w-40 h-64 overflow-auto">
                        @foreach($channels as $channel)
                            <li class="py-2">
                                <a href="/threads/{{ $channel->slug }}">
                                    {{ $channel->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="flex-1 text-right">
                @guest
                    <a class="no-underline hover:underline text-gray-300 text-sm p-3" href="{{ route('login') }}">{{ __('Login') }}</a>
                    @if (Route::has('register'))
                        <a class="no-underline hover:underline text-gray-300 text-sm p-3" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                @else
                    <a href="{{ route('profile', Auth::user()) }}" 
                       class="text-gray-300 text-sm pr-4"
                    >
                        {{ Auth::user()->name }}
                    </a>
                    <a href="{{ route('logout') }}"
                        class="no-underline hover:underline text-gray-300 text-sm p-3"
                        onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        {{ csrf_field() }}
                    </form>
                @endguest
            </div>
        </div>
    </div>
</nav>
