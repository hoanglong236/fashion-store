<div class="aa-header-top-area">
    <!-- Start header top left -->
    <div class="aa-header-top-left">
        <!-- Start language -->
        <div class="aa-language">
            <div class="dropdown">
                <a class="btn dropdown-toggle" href="#" type="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="true">
                    <img src="{{ asset('assets/img/flag/english.jpg') }}" alt="english flag">ENGLISH
                    <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="#">
                            <img src="{{ asset('assets/img/flag/french.jpg') }}" alt="">FRENCH
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{ asset('assets/img/flag/english.jpg') }}" alt="">ENGLISH
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Start cellphone -->
        <div class="cellphone hidden-xs">
            <p><span class="fa fa-phone"></span>00-62-658-658</p>
        </div>
    </div>

    <div class="header-top-right">
        <ul class="header-top-nav-right">
            <li class="hidden-xs"><a href="wishlist.html">Wishlist</a></li>
            @if (Auth::guard('customer')->check())
                <li class="hidden-xs">
                    <a href="{{ route('order.index') }}">My Orders</a>
                </li>
                <li>
                    <div class="dropdown">
                        <a class="btn dropdown-toggle" href="#" type="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="true">
                            {{ Auth::guard('customer')->user()->name }}
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="dropdown-menu__item">
                                <a class="dropdown-menu__item-link" href="{{ route('customer.info') }}">
                                    My Account
                                </a>
                            </li>
                            <li class="dropdown-menu__item">
                                <a class="dropdown-menu__item-link" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); $('#logoutForm').submit();">Logout</a>
                            </li>
                        </ul>
                    </div>
                    <form id="logoutForm" action="{{ route('logout') }}" method="post">
                        @csrf
                    </form>
                </li>
            @else
                <li>
                    <a href="{{ route('login') }}">Login</a>
                </li>
            @endif
        </ul>
    </div>
</div>
