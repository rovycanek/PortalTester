<header>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                SSL Tester
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto">
                    @guest
                    @else
                    @can('work-IPs')
                    <li><a class="nav-link" href="/IPs">IPs</a></li>
                    @endcan
                    @endguest
                </ul>
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                    </li>
                    @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                    @endif
                    @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            @can('testing-history')
                            <a class="dropdown-item" href="/tests">
                                Testing history
                            </a>
                            @endcan
                            @can('login-history')
                            <a class="dropdown-item" href="/LoginLog">
                                Login history
                            </a>
                            @endcan
                            @can('manage-users')
                            <a class="dropdown-item" href="/admin/users">
                                User Management
                            </a>
                            @endcan
                            @can('manage-colors')
                            <a class="dropdown-item" href="/admin/colors">
                                Color Management
                            </a>
                            @endcan
                            @can('manage-IPs')
                            <a class="dropdown-item" href="/admin/IPs">
                                IPs Management
                            </a>
                            @endcan
                            @can('manage-login')
                            <a class="dropdown-item" href="/admin/LoginLog">
                                Login Management
                            </a>
                            @endcan
                            @can('manage-tests')
                            <a class="dropdown-item" href="/admin/tests">
                                Tests Management
                            </a>
                            @endcan
                            @can('manage-SSL')
                            <a class="dropdown-item" href="/admin/testSsl">
                                SSL test tool Management
                            </a>
                            @endcan
                            @can('work-IPs')
                            <a class="dropdown-item" href="/IPs/create">
                                Create IP
                            </a>
                            @endcan
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>