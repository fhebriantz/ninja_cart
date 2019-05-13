@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body text-center">
                    Hai <strong>{{ Auth::user()->name }}</strong> kamu sudah login, email kamu <strong>{{ Auth::user()->email }}</strong>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
