@extends('layouts.cmsnew')

@section('content')

<div class="container">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

        <form class="form-signin"  method="POST" action="{{ route('password.email') }}"> 
          {{ csrf_field() }}
          <div class="panel periodic-login">
              <div class="panel-body text-center">
                  <h1 class="atomic-symbol">CMS</h1>
                  <p class="atomic-mass">FAMILY</p>
                  <p class="element-name">Made In Indonesia</p>

                  <i class="icons icon-arrow-down"></i>
                            <div class="form-group form-animate-text">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        

                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn col-md-12">
                                    Send Password Reset Link
                                </button>
                            </div>
                        </div>   
                    </div>
            </form>
        </div>
  @endsection