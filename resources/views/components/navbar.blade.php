<!-- Header -->
<style>
    .dropdown {
        position: static !important;
    }
    .dropdown-menu {
        margin-top: 20px !important;
        width: 100% !important;
    }
</style>
<header class="header-v4">
    <!-- Header desktop -->
    <div class="container-menu-desktop">
        <!-- Topbar -->
        <div class="top-bar">
            <div class="content-topbar flex-sb-m h-full container">
                <div class="left-top-bar">Lorem ipsum dolor sit amet wwe</div>
                <div class="right-top-bar flex-w h-full">
                    <a href="#" class="flex-c-m trans-04 p-lr-25">
                        Help & FAQs
                    </a>
                    @if(Auth::check())
                        <a href="{{route('profile',auth()->id())}}" class="flex-c-m trans-04 p-lr-25">
                            My Account
                        </a>
                    @else
                        <a href="{{route('login')}}" class="flex-c-m trans-04 p-lr-25">
                            Login
                        </a>
                        <a href="{{route('register')}}" class="flex-c-m trans-04 p-lr-25">
                            Register
                        </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="wrap-menu-desktop how-shadow1">
            <nav class="limiter-menu-desktop container">

                <!-- Logo desktop -->
                <a href="{{route('home')}}" class="logo">
                    <img src="{{asset('images/icons/logo-01.png')}}" alt="IMG-LOGO">
                </a>

                <!-- Menu desktop -->
                <div class="menu-desktop">
                    <ul class="main-menu">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Shop Category
                            </a>
                            <!--dropdown sub items of menu-->
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                @php
                                    $parent_categories = App\Services\GetCategories::getParentCategory();
                                    $child_categories = App\Services\GetCategories::getChildCategory();
                                @endphp

                                <div class="container">
                                    <div class="row my-3">
                                        @foreach($parent_categories as $parent_category)
                                            <div class="m-all-20">
                                                <h1 class="font-bold text-xl my-2">{{$parent_category->name}}</h1>
                                                <div>
                                                    @foreach($child_categories as $child_category)
                                                        @if($parent_category->id == $child_category->parent_id)
                                                            <h1 class="font-medium my-3">
                                                                <a href="{{route('product.view',['category' => $child_category->id])}}">
                                                                    {{$child_category->name}}
                                                                </a>
                                                            </h1>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li id="home">
                            <a href="{{route('home')}}">Home</a>
                        </li>
                        <li id="blog">
                            <a href="{{route('blog')}}">Blog</a>
                        </li>
                        <li id="about">
                            <a href="{{route('about')}}">About</a>
                        </li>
                        <li id="contact">
                            <a href="{{route('contact')}}">Contact</a>
                        </li>
                    </ul>
                </div>

                <!-- Icon header -->
                <div class="wrap-icon-header flex-w flex-r-m">
                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
                        <i class="zmdi zmdi-search"></i>
                    </div>

                    <div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti "
                         data-notify="{{Gloudemans\Shoppingcart\Facades\Cart::instance('cart')->content()->count()}}">
                        <a href="{{route('shopping.cart')}}"> <i class="zmdi zmdi-shopping-cart"></i></a>
                    </div>

                    <a href="{{route('wishlist')}}" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti"
                       data-notify="{{Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->content()->count()}}">
                        <i class="zmdi zmdi-favorite-outline"></i>
                    </a>
                </div>
            </nav>
        </div>
    </div>

    <!-- Header Mobile -->
    <div class="wrap-header-mobile">
        <!-- Logo moblie -->
        <div class="logo-mobile">
            <a href="{{route('home')}}"><img src="{{asset('images/icons/logo-01.png')}}" alt="IMG-LOGO"></a>
        </div>

        <!-- Icon header -->
        <div class="wrap-icon-header flex-w flex-r-m m-r-15">
            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
                <i class="zmdi zmdi-search"></i>
            </div>

            <div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart"
                 data-notify="{{Gloudemans\Shoppingcart\Facades\Cart::instance('cart')->content()->count()}}">
                <a href="{{route('shopping.cart')}}"> <i class="zmdi zmdi-shopping-cart"></i></a>
            </div>

            <a href="{{route('wishlist')}}" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti"
               data-notify="{{Gloudemans\Shoppingcart\Facades\Cart::instance('wishlist')->content()->count()}}">
                <i class="zmdi zmdi-favorite-outline"></i>
            </a>
        </div>

        <!-- Button show menu -->
        <div class="btn-show-menu-mobile hamburger hamburger--squeeze">
            <span class="hamburger-box">
                <span class="hamburger-inner"></span>
            </span>
        </div>
    </div>


    <!-- Menu Mobile -->
    <div class="menu-mobile">
        <ul class="topbar-mobile">
            <li>
                <div class="right-top-bar flex-w h-full">
                    <a href="#" class="flex-c-m trans-04 p-lr-25">
                        Help & FAQs
                    </a>
                    @if(Auth::check())
                        <a href="#" class="flex-c-m trans-04 p-lr-25">
                            My Account
                        </a>
                        <a href="{{route('logout.perform')}}" class="flex-c-m trans-04 p-lr-25">
                            Logout
                        </a>
                    @else
                        <a href="{{route('login')}}" class="flex-c-m trans-04 p-lr-25">
                            Login
                        </a>
                        <a href="{{route('register')}}" class="flex-c-m trans-04 p-lr-25">
                            Register
                        </a>
                    @endif
                </div>
            </li>
        </ul>

        <ul class="main-menu-m">
            <li class="home">
                <a href="{{route('home')}}">Home</a>
            </li>

            <li id="shop">
                <a href="{{route('product.category.all')}}">Shop</a>
            </li>

            <li id="blog">
                <a href="{{route('blog')}}">Blog</a>
            </li>

            <li id="about">
                <a href="{{route('about')}}">About</a>
            </li>

            <li id="contact">
                <a href="{{route('contact')}}">Contact</a>
            </li>
        </ul>
    </div>

    <!-- Modal Search -->
    <div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
        <div class="container-search-header">
            <button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
                <img src="{{asset('images/icons/icon-close2.png')}}" alt="CLOSE">
            </button>

            <form action="{{route('product.category.all')}}" method="GET" class="wrap-search-header flex-w p-l-15">
                <button class="flex-c-m trans-04">
                    <i class="zmdi zmdi-search"></i>
                </button>
                <input class="plh3" type="text" name="search" placeholder="Search...">
            </form>
        </div>
    </div>
</header>
@push('scripts')
    <script>
        let link = document.location.href.split('/');
        if (link[3] == '') {
            $("#home").addClass("active-menu");
        }
        else if (link[3] == 'product') {
            $("#shop").addClass("active-menu");
        }
        else if (link[3] == 'blog') {
            $("#blog").addClass("active-menu");
        }
        else if (link[3] == 'about') {
            $("#about").addClass("active-menu");
        }
        else if (link[3] == 'blog') {
            $("#blog").addClass("active-menu");
        }
        else if (link[3] == 'contact') {
            $("#contact").addClass("active-menu");
        }
    </script>
@endpush
