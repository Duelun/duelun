<header>
    <div class="top-row">
        <img src="" />
        <div>
            <h1 class="title">{{ config('app.name', 'Laravel') }}</h1>
            <h2>'Everyone knew it was impossible, until a fool who didn't know came along and did it.'</h2>
        </div>
    </div>

    <nav>
        <li class="menu-item {{ (in_array(request()->path(), array('home', '', '/'))) ? 'selected' : '' }}">
            <a href="{{ url('/home') }}" class=""><i class="fas fa-home"></i><p>Home</p></a>
        </li>
        <li class="menu-item {{ (request()->path() === 'documents' || str_contains(request()->path(), 'document/')) ? 'selected' : '' }}">
            <a href="{{ url('/documents') }}" class=""><i class="fas fa-book-open"></i><p>Documents</p></a>
        </li>
        <li class="menu-item {{ (request()->path() === 'legal') ? 'selected' : '' }}" >
            <a href="{{ url('/legal') }}" class=""><i class="fas fa-file-contract"></i><p>Terms & Conditions</p></a>
        </li>
        <li class="menu-item {{ (request()->path() === 'support') ? 'selected' : '' }}" >
            <a href="{{ url('/support') }}" class=""><i class="fas fa-money-bill-wave"></i><p>Support</p></a>
        </li>
        <li class="menu-item {{ (request()->path() === 'contact') ? 'selected' : '' }}">
            <a href="{{ url('/contact') }}" class=""><i class="fas fa-address-card"></i><p>Contact</p></a>
        </li>

        @guest
            
            @if (Route::has('register'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>
            @endif
        @else
            <li class="menu-item {{ (str_contains(request()->path(), 'dashboard')) ? 'selected' : '' }}">
                <a href="/dashboard">
                    {{ Auth::user()->name }} - Dashboard
                </a>
            </li>

            <li class="menu-item">
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </li>

        @endguest

    </nav>


</header>