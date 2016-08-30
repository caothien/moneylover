@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading text-center">Welcome To Money Lover !</div>

                <div class="panel-body">
                    <div class="thumbnail">
                        <img src="{{ URL::asset('images/logo.png') }}" alt="logo">
                    </div>  
                </div>
            </div>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
@endsection
