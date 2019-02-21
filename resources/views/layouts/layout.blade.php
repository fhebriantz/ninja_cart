<html lang="en">
    <!-- START: HEAD -->
    <head>
        @include('include_cart/head')

        @yield('head')
    </head>
    <!-- END: HEAD -->
    <body>
        <!-- Navbar mobile-->
        <nav class="navbar menu">
            @include('include_cart/nav')
        </nav>
        <!-- Navbar mobile end -->
        
          @yield('content')      

        <section>
            @include('include_cart/footer')
          	@yield('footer')
        </section>


    </body>
        @include('include_cart/script')
        @yield('script')
</html>