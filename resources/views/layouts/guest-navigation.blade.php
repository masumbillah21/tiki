<nav class="bg-gray-800 top-0 fixed w-full">
    <div class="mx-auto max-w-7xl px-2 sm:px-6 lg:px-8">
      <div class="relative flex h-16 items-center justify-between">
        <div class="flex flex-1 items-center justify-center sm:items-stretch sm:justify-start">
          <div class="flex flex-shrink-0 items-center">
            <a href="{{ route('home') }}">
                <x-application-logo class="block h-9 w-auto fill-current text-white" />
            </a>
          </div>
          <div class="hidden sm:ml-6 sm:block">
            <div class="flex space-x-4">
              <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'bg-gray-900' : ''}} text-white rounded-md px-3 py-2 text-sm font-medium">Book A Trip</a>
              
            </div>
          </div>
        </div>
        <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'bg-gray-900' : ''}} text-white rounded-md px-3 py-2 text-sm font-medium">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="{{ request()->routeIs('login') ? 'bg-gray-900' : ''}} text-white rounded-md px-3 py-2 text-sm font-medium">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="{{ request()->routeIs('register') ? 'bg-gray-900' : ''}} text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Register</a>
                    @endif
                @endauth
            @endif
        </div>
      </div>
    </div>
  
    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden" id="mobile-menu">
      <div class="space-y-1 px-2 pb-3 pt-2">
        @if (Route::has('login'))
            @auth
                <a href="{{ url('/dashboard') }}" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="bg-gray-900 text-white rounded-md px-3 py-2 text-sm font-medium">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="text-gray-300 hover:bg-gray-700 hover:text-white rounded-md px-3 py-2 text-sm font-medium">Register</a>
                @endif
            @endauth
        @endif
      </div>
    </div>
</nav>