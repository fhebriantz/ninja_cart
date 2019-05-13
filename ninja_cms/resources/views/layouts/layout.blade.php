<html xmlns="http://www.w3.org/1999/xhtml" lang="{{ app()->getLocale() }}">
    <!-- START: HEAD -->
    <head>
        @include('includeweb/head')

        @yield('header')
    </head>
    <!-- END: HEAD -->
    <body>
        <!-- Navbar mobile-->
        <nav class="navbar @yield('nav') navbar-expand-lg navbar-static-top mobileshow">
            @include('includeweb/navmobile')
        </nav>
        <!-- Navbar mobile end -->.

        <!-- Navbar pc -->
        <nav class="navbar @yield('navpc') navbar-expand-lg navbar-static-top mobilehide">
            @include('includeweb/navpc')
        </nav>
        
        <!-- Navbar pc end-->

        <!-- start: Content ================================================================= -->
          @yield('contents')
        <!-- end: content =================================================================== -->        

        <section class="navfoot">
            @include('includeweb/footer')
        </section>

        <section class="" style="margin-top: 30px;">
            <div class="contaier">
                    <div>
                        <img src="{{ asset('assets/img/footer.jpg')}}" style="width: 100%; height: auto;" alt="">
                    </div>
            </div>
        </section>
        @yield('marginbottom')
        @include('includeweb/scripts')

        @yield('scripts')
    </body>
</html>