<header id="header"><!--header-->
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->
    
    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <a href="index.html"><img src="images/home/logo.png" alt="" /></a>
                    </div>
                   
                </div>
                <div class="col-sm-8">
                    <div class="mainmenu pull-right">
                        <ul class="nav navbar-nav">
                            
                           
                            <li><a href="{{route('client.checkout')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                            <li><a href="/cart"><i class="fa fa-shopping-cart"></i> Cart</a>
                            </li>
                           
                            @if (Auth::check())
                             
                           
                            <li class="dropdown"><a href="#"><i class="fa fa-user"></i> {{Auth::user()->name}}</a>
                                <ul role="menu" class="sub-menu">
                                   
                                    <li><a href="{{route('client.checkout')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li> 
                                    <li><a href="/cart"><i class="fa fa-shopping-cart"></i> Cart</a></li>
                                    <li><a href="/listOrder"><i class="fa fa-book"></i> Order</a>
                                    @can('is-admin')
                                        
                                    <li><a href="{{route('admin.home')}}"><i class="fa fa-users"></i> Quản trị Admin</a></li> 
                                    @endcan
                                    <li><a href="{{route('logout')}}"><i class="fa fa-sign-out"></i> Logout</a></li> 
                                </ul>
                            </li>
                            @else
                            <li><a href="{{route('login')}}"><i class="fa fa-lock"></i> Login</a></li>
                            @endif
                           
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-9">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="/" class="active">Home</a></li>
                            <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="{{route('client.listProducts')}}">Products</a></li>
                                 
                                   
                                </ul>
                            </li> 
                            <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="blog.html">Blog List</a></li>
                                    <li><a href="blog-single.html">Blog Single</a></li>
                                </ul>
                            </li> 
                            <li><a href="404.html">404</a></li>
                            <li><a href="contact-us.html">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="search_box pull-right">
                        <form action="{{route('client.searchProduct')}}" method="get">
                            @csrf
                            <input type="text" placeholder="Search" name="search_tag" value="{{old('search_tag')}}">
                            <button type="submit" class="btn btn-warning">Search</button>
                        </form>
                        
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header><!--/header-->

