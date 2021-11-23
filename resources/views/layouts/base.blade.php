<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    @yield('meta')
    
    <title>Czarlike  @yield('page_title')</title>
    <!-- Main CSS -->
    <link rel="icon" href="{{ asset('images/favicon/'.site()->favicon) }}" type="image/png" />

    <link rel="stylesheet" href="{{ asset('home_asset/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
     <!-- Scrollbar Custom CSS -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
    <!-- CSS only -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glider-js@1/glider.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- font awsome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

    @yield('css')
</head>
<body>

    @include('sweetalert::alert')

    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar" class="d-lg-none d-md-block">
            <div id="dismiss">
                <i class="fas fa-arrow-left"></i>
            </div>



            <ul class="list-unstyled components">
                <div class="input-group p-1 mb-3">
                    <input type="search" placeholder="Search for Products, Brands & More" class="form-control">
                    <button class="btn btn-dark"><i class="fas fa-search"></i></button>
                </div>
                <div class="sidebar-header d-flex">
                    <h5><i class="fab fa-facebook"></i></h5>
                    <h5><i class="fab fa-twitter"></i></h5>
                    <h5><i class="fab fa-instagram"></i></h5>
                    <h5><i class="fab fa-google"></i></h5>
                    <h5><i class="fab fa-youtube"></i></h5>
                </div>
                <li class="active">
                    <a href="{{ route('homepage') }}">Home</a>
                </li>
                <li>
                    <a href="#pageSubmenu" data-bs-toggle="collapse" aria-expanded="false">Categories</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        @foreach (categories() as $category)
                        <li>
                            <a href="@if (($category->subcategories->count() > 0))
                                #subCategory{{ $category->id }}
                            @else {{ route('products','cat_id='.$category->id) }} @endif" data-bs-toggle="collapse" aria-expanded="false">{{ $category->title }}</a>
                            <ul class="collapse list-unstyled" id="subCategory{{ $category->id }}">
                                @foreach ($category->subcategories as $sc)
                                    <li class="">
                                        <a href="@if (($sc->childcat->count() > 0))
                                            #childCategory{{ $sc->id }}
                                        @else {{ route('products','sub_cat_id='.$sc->id) }} @endif" class="ps-4" data-bs-toggle="collapse" aria-expanded="false">{{ $sc->title }}</a>
                                        <ul class="collapse list-unstyled" id="childCategory{{ $sc->id }}">
                                            @foreach ($sc->childcat as $cc)
                                                <li><a class="ps-5" href="{{ route('products','child_cat_id='.$cc->id) }}">{{ $cc->title }}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach
                    </ul>
                </li>
                <li>
                    <a href="{{ route('my.orders') }}">My Orders</a>
                </li>
                <li>
                    <a href="{{ route('view.wishlist') }}">Wishlists</a>
                </li>
                <li>
                    <a href="{{ route('contact.us') }}">Contact</a>
                </li>
            </ul>

        </nav>

        <!-- Page Content  -->
        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light d-lg-none d-md-block">
                <div class="container-fluid">

                    <button type="button" id="sidebarCollapse" class="btn btn-dark">
                        <i class="fas fa-align-left"></i>
                    </button>

                    <div class="logo mx-auto">
                        <img src="img\logo1.png" alt="">
                    </div>

                   <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a href="" class="nav-link"><h3><i class="fas fa-shopping-cart"></i></h3></a>
                    </li>
                   </ul>
                </div>
            </nav>

            <section id="navbar" class="d-none d-lg-block ">
                <nav1 class="navbar navbar-expand-lg border-bottom ">
                    <div class="container">
                        @auth
                        <ul class="navbar-nav nav ms-auto">
                            <li class="nav-item"><a href="" class="nav-link" data-bs-toggle="modal" data-bs-target="#search"><i class="fas fa-search"></i></a></li>

                            <li class="nav-item"><a href="{{ route('cart') }}" class="nav-link"><i class="fas fa-shopping-cart"></i><span class="badge bg-warning rounded-circle" style="top:-5px;position: relative;">{{ cart_count() }}</span> Items </a></li>
                            <li class="nav-item"><a href="{{ route('view.wishlist') }}" class="nav-link"><i class="fas fa-heart"></i><span class="badge bg-warning rounded-circle" style="top:-5px;position: relative;">{{ wishlist()->count() }}</span></a></li>
                            <li class="nav-item"><a href="" class="nav-link">₹ {{ cart_amount() }}.00</a></li>
                            <li class="nav-item dropdown"><a href="#" data-bs-toggle="dropdown" id="dropdownMenuLink" role="button" aria-haspopup="true" aria-expanded="false" dropdown class="nav-link dropdown"><i class="fas fa-user"></i> {{ Auth::user()->user_name }}</a>
                                <ul class="dropdown-menu border card-shadow-lg ps-0" style="border-radius: 10px;" aria-labelledby="dropdownMenuLink">
                                    <li><a class="dropdown-item ms-0" href="
                                            @if (Auth::user()->user_type == 'superAdmin' || Auth::user()->user_type == "admin")
                                                {{ route('super.admin.profile') }}
                                            @else
                                                <!--{{ route('profile') }}-->
                                                #
                                            @endif
                                    ">My profile</a></li>
                                    <li><a class="dropdown-item ms-0" href="{{ route('my.orders') }}">My Orders</a></li>
                                    <li><a class="dropdown-item ms-0" href="{{ route('view.wishlist') }}">Wishlist</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <form action="{{ route('logout') }}" id="logout_form" method="post">
                                        @csrf
                                    </form>

                                    <li><a class="dropdown-item ms-0" href="#" onclick="javascript:$('#logout_form').submit();">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                        @else
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item"><a href="{{ route('login') }}" class="nav-link"><i class="fas fa-login"></i>Login </a></li>
                            <li class="nav-item"><a href="{{ route('register') }}" class="nav-link"><i class="fas fa-out"></i>Register</a></li>
                            <li class="nav-item"><a href="{{ route('cart') }}" class="nav-link"><i class="fas fa-shopping-cart"></i><span class="badge bg-warning rounded-circle" style="top:-5px;position: relative;">0</span> Items </a></li>
                            <li class="nav-item"><a href="{{ route('view.wishlist') }}" class="nav-link"><i class="fas fa-heart"></i><span class="badge bg-warning rounded-circle" style="top:-5px;position: relative;">0</span> Items </a></li>
                            <li class="nav-item"><a href="" class="nav-link">₹ 00.00</a></li>
                            <li class="nav-item"><a href="" class="nav-link" data-bs-toggle="modal" data-bs-target="#search"><i class="fas fa-search"></i></a></li>
                        </ul>
                        @endauth
                    </div>
                </nav1>

                <div class="modal fade" id="search" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content p-0">

                        <div class="modal-body p-0">
                        <form action="{{ route('products') }}" method="get">
                            <div class="input-group">
                                <input type="search" name="search" placeholder="Search for Products, Brands & more.." class="form-control">
                                <button class="btn btn-dark"><i class="fas fa-search"></i></button>
                            </div>
                        </form>
                        </div>

                    </div>
                    </div>
                </div>

                <nav2 class="navbar navbar-expand-lg sticky-lg-top shadow-sm bg-white">
                    <div class="container">
                        <div class="logo">
                            <a href="{{ route('homepage') }}"><img src="{{ asset('images/logo/'.site()->logo) }}" alt="{{ site()->logo }}"></a>
                        </div>
                        <style>
                            ul.nav li.dropdown-category:hover ul.dropdown-menu-category {
                                display: block;
                            }
                            li.sub-dropdown:hover ul.dropdown-sub-menu {
                                display: block;
                            }
                            li.child-dropdown:hover ul.dropdown-child-menu {
                                display: block;
                            }

                        </style>
                        <ul class="navbar-nav nav ms-auto">
                            <li class="nav-item"><a href="{{ route('homepage') }}" class="nav-link">HOME</a></li>
                            <li class="nav-item dropdown dropdown-category">
                                <a href="" class="nav-link dropdown" data-bs-toggle="dropdown" id="categoryDropDown" role="button" aria-haspopup="true" aria-expanded="false">CATEGORY</a>
                                <ul class="dropdown-menu  dropdown-menu-category border card-shadow-lg ps-0" style="border-radius: 10px; width:400px; right:-100%;" aria-labelledby="categoryDropDown">
                                    @foreach (categories() as $category)
                                    <li class="sub-dropdown">
                                        <a class="dropdown-item ms-0 dropdown" id="subCategoryDropDown{{ $category->id }}" aria-haspopup="true" aria-expanded="false" href="{{ route('products','cat_id='.$category->id) }}">{{ $category->title }}</a>
                                        @if (count($category->subcategories) > 0)
                                        <ul class="dropdown-sub-menu dropdown-menu border card-shadow-lg ps-0" style="border-radius: 10px; width:300px; right:0%;" aria-labelledby="subCategoryDropDown">
                                            <li><a href="" class="ms-0 dropdown-item disabled text-primary">{{ $category->title }}</a></li>
                                            <hr>
                                            @foreach ($category->subcategories as $sc)
                                                <li class="child-dropdown" >
                                                    <a class="dropdown-item ms-0 dropdown" id="childCategoryDropDown{{ $category->id }}" aria-haspopup="true" aria-expanded="false" href="{{ route('products','sub_cat_id='.$sc->id) }}">{{ $sc->title }}</a>
                                                    @if ($sc->childcat->count() > 0)
                                                    <ul class="dropdown-child-menu dropdown-menu border card-shadow-lg ps-0" style="border-radius: 10px; width:300px; right:100%; top:10%;" aria-labelledby="childCategoryDropDown">
                                                        <li><a href="" class="ms-0 dropdown-item disabled text-primary">{{ $sc->title }}</a></li>
                                                        <hr>
                                                        @foreach ($sc->childcat as $cc)
                                                            <li><a href="{{ route('products','child_cat_id='.$cc->id) }}" class="ms-0 dropdown-item">{{ $cc->title }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                    @endif
                                                </li>
                                            @endforeach

                                        </ul>
                                        @endif
                                    </li>
                                    @endforeach
                                </ul>
                            </li>

                            <li class="nav-item"><a href="{{ route('contact.us') }}" class="nav-link">CONTACT</a></li>
                        </ul>
                    </div>
                </nav2>
            </section>


            {{-- <section id="poster">
                <img src="{{ asset('home_asset/img\poster8.jpg') }}" alt="">
                <div class="poster-content">
                    <div class="data text-center">
                        <h4>New Collection</h4>
                        <button class="mt-4">Shop Now</button>
                    </div>
                </div>
            </section> --}}
            @php
                $url = Request::segment(1)
            @endphp
            @if ($url != "login" && $url != "register" )
                @include('home.include.slider')
            @endif
            @yield('content')

            <section id="feature" class="">
                <div class="container my-5">
                    <div class="row text-center">
                        <div class="col-lg-4 col-6">
                        <div class="icon">
                            <img src="{{ asset('home_asset/img/payment1.webp')}}" alt="">
                        </div>
                        <div class="policy">
                            <h5 class="text-center">Secure Payment</h5>
                        </div>
                        </div>
                        <div class="col-lg-4 col-6">
                            <div class="icon">
                            <img src="{{ asset('home_asset\img\shipping.png')}}" alt="">
                        </div>
                        <div class="policy">
                            <h5 class="text-center">Free Shipping & Returns</h5>
                        </div>

                        </div>
                        <div class="col-lg-4 col-6">
                            <div class="icon">
                            <img src="{{ asset('home_asset\img\service.png')}}" alt="">
                        </div>
                        <div class="policy">
                            <h5 class="text-center">24/7 Customer Service</h5>
                        </div>
                        </div>
                    </div>
                </div>
            </section>


            <footer class="p-4">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <a href="{{ route('homepage') }}"><p><strong>Home</strong></p></a>
                            <a href="{{ route('about.us') }}"><p>About us</p></a>
                            <a href="{{ route('contact.us') }}"><p>Contact us</p></a>
                            <a href="{{ route('terms') }}"><p>Terms and Conditions</p></a>
                            <a href="{{ route('rrc') }}"><p>Refund, Return and Cancellation</p></a>
                            <a href="{{ route('policy') }}"><p>Privacy Policy</p></a>
                        </div>
                        <div class="col-lg-3">
                            <a href="#"><p><strong>Contact</strong></p></a>
                            <a href="#"><p><i class="fas fa-map-marker-alt"></i> {{ site()->address }}</p></a>
                            <a href="#"><p><i class="fas fa-envelope"></i> {{ site()->email }}</p></a>
                            <a href="#"><p><i class="fas fa-phone"></i> Call: +91 {{ site()->contact }}</p></a>

                        </div>
                        <div class="col-lg-3">
                            <a href=""><p><strong>Company</strong></p></a>
                            <a href="#"><p><i class="fas fa-truck"></i> Shipping & returns</p></a>
                            {{-- <a href="#"><p> <i class="fas fa-question-circle"></i>FAQ</p></a> --}}
                            <div class="social-links mb-3">
                                <a href="#"><p><strong>Social Links</strong></p></a>
                                <a href="{{ site()->facebook }}"><span><i class="fab fa-facebook"></i></span></a>
                                <a href="{{ site()->twitter }}"><span><i class="fab fa-twitter"></i></span></a>
                                <a href="{{ site()->instagram }}"><span><i class="fab fa-instagram"></i></span></a>
                                <a href="{{ site()->google }}"><span><i class="fab fa-google"></i></span></a>
                                <a href="{{ site()->youtube }}"><span><i class="fab fa-youtube"></i></span></a>
                            </div>
                        </div>
                        <div class="col-lg-3 border-0">
                            <a href=""><p><strong>Recieve Our News & Updates</strong></p></a>
                            <input type="text" placeholder="Enter Email" class="form-control form-control-sm">
                            <button class="btn btn-sm btn-primary w-100 my-3">Subscribe Now</button>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <div class="overlay"></div>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> --}}
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/glider-js@1/glider.min.js"></script>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- Main JS -->
    <script src="{{ asset('home_asset/js/script.js') }}"></script>
</body>
</html>
