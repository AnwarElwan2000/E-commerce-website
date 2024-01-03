<header class="header_section">
    <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
            <a class="navbar-brand" href="{{ url('/') }}"><img width="250" src="/home/images/logo.png"
                    alt="#" /></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class=""> </span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ url('/') }}">Home <span class="sr-only">(current)</span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('products') }}">Products</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">Contact</a>
                    </li>



                    @if (isset($cart_count))
                        <li class="nav-item btn btn-primary btn-sm">
                            <a class="nav-link text-light" class="bg-primary"
                                href="{{ url('show_cart') }}">Cart[{{ $cart_count }}]</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('show_cart') }}">Cart</a>
                        </li>
                    @endif



                    @if (isset($order_count))
                        <li class="nav-item btn btn-success btn-sm ml-3">
                            <a class="nav-link text-light" href="{{ url('show_order') }}">order[{{ $order_count }}]</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('show_order') }}">order</a>
                        </li>
                    @endif


                    <form class="form-inline">
                        <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit">
                            <i class="fa fa-search" aria-hidden="true"></i>
                        </button>
                    </form>
                    @if (Route::has('login'))
                        @auth

                            <li class="nav-item">
                                <div class="dropdown show">
                                    <a class="btn btn-danger dropdown-toggle" href="#" role="button" id="auth"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                        {{ Auth::user()->name }}
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="auth">
                                        <small class="text-muted ml-4">Manage Account</small>
                                        <x-dropdown-link :href="route('profile.edit')">
                                            {{ __('Profile') }}
                                        </x-dropdown-link>

                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf

                                            <x-dropdown-link :href="route('logout')"
                                                onclick="event.preventDefault();
                                                  this.closest('form').submit();">
                                                {{ __('Log Out') }}
                                            </x-dropdown-link>
                                        </form>


                                    </div>
                                </div>

                            </li>
                        @else
                            <li class="nav-item">
                                <a class="btn btn-primary" title="Login" href={{ route('login') }}
                                    id="loginCss">Login</a>
                            </li>

                            <li class="nav-item">
                                <a class="btn btn-success" title="Register" href={{ route('register') }}>Register</a>
                            </li>
                        @endauth
                    @endif

                </ul>
            </div>
        </nav>
    </div>
</header>
