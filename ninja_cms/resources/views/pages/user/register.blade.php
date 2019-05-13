@extends('layouts.cmsnew')

@section('content')
<div class="container">

        <form class="form-signin" method="POST" action="{{ route('register') }}"> 
          {{ csrf_field() }}
          <div class="panel periodic-login">
              <div class="panel-body text-center">
                  <h1 class="atomic-symbol">Mi</h1>
                  <p class="atomic-mass">14.072110</p>
                  <p class="element-name">Miminium</p>

                  <i class="icons icon-arrow-down"></i>
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="text" class="form-text" required name="name" placeholder="Name">
                    <span class="bar"></span>
                    <label></label>
                  </div>
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="email" class="form-text" required name="email" placeholder="Email">
                    <span class="bar"></span>
                    <label></label>
                  </div>
                  <div class="form-group form-animate-text" style="margin-top:40px !important;">
                    <input type="password" class="form-text" required name="password" placeholder="password">
                    <span class="bar"></span>
                    <label></label>
                  </div>
                  <label class="pull-left">
                  <input type="checkbox" class="icheck pull-left" name="checkbox1"/> &nbsp Agree the terms and policy
                  </label>
                  <input type="submit" class="btn col-md-12 btn-primary" value="SignUp"/>
              </div>
                <div class="text-center" style="padding:5px;">
                    <a href="/family/public/login">Already have an account?</a>
                </div>
          </div>
        </form>

      </div>
  @endsection