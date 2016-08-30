@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Add Type Money</div>

                <div class="panel-body">
                    @if (count($errors) > 0)
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li><p style="color: red;">{{ $error }}</p></li>
                        @endforeach
                    </ul>
                    @endif
                    {!! Form::open(array('url' => '/addtypemoney', 'method' => 'post')) !!}
                    {!! Form::label('','Type Money', array('for' => 'exampleInputEmail1')) !!}
                    {!! Form::text('namemoney', '', array('class' => 'form-control', 'maxlength' => '15')) !!}
                    <p></p>
                    {!! Form::submit('Ok', array('class' => 'btn btn-default' )) !!}
                    {!! Form::button('Cancel', array('class' => 'btn btn-default', 'onclick' => 'checkCancel()')) !!}
                    {!! Form::close() !!}   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection