<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  <!-- start: Css -->
  @include('include/head')
  <!-- end: Css -->
  @yield('header')
</head>

<body id="mimin" class="dashboard">

      <!-- start: Header -->
      @include('include/nav')
      <!-- end: Header -->

      <div class="container-fluid mimin-wrapper">
          <!-- start:Left Menu -->
          @include('include/left_menu')  
          <!-- end: Left Menu -->
          <!-- start: Content -->
          @yield('content')
          <!-- end: content -->

          <!-- start: right menu -->
          <!-- end: right menu -->
      </div>

      <!-- start: Mobile -->
      @include('include/mobile')
      <!-- end: Mobile -->

<!-- start: Javascript -->
@include('include/scripts')
 @yield('scripts')
</body>
</html>