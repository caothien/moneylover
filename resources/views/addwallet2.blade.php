@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Add Wallet</div>

                <div class="panel-body">
                    @if (count($errors) > 0)
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li><p style="color: red;">{{ $error }}</p></li>
                        @endforeach
                    </ul>
                    @endif
                    {!! Form::open(array('url' => '/addwallet', 'method' => 'post', 'enctype' => 'multipart/form-data')) !!}
                    {!! Form::label('','Name Wallet', array('for' => 'exampleInputEmail1')) !!}
                    {!! Form::label('','&nbsp; (*)', array('for' => 'exampleInputEmail1', 'class' => 'batbuoc')) !!}
                    {!! Form::text('name', $input["name"], array('class' => 'form-control', 'maxlength' => '15' )) !!}
                    {!! Form::label('','Money', array('for' => 'exampleInputEmail1')) !!}
                    {!! Form::label('','&nbsp; (*)', array('for' => 'exampleInputEmail1', 'class' => 'batbuoc')) !!}
                    {!! Form::number('money', $input["money"], array('class' => 'form-control','id' => 'money', 'onkeypress' => 'return isNumberKey(event)', 'oninput' => 'limitNumber()')) !!}
                    {!! Form::label('','Type Money', array('for' => 'exampleInputEmail1')) !!}
                    {!! Form::label('','&nbsp; (*)', array('for' => 'exampleInputEmail1', 'class' => 'batbuoc')) !!}
                    <select class="form-control" name="typemoney">
                        @foreach($typeMoneys as $typemoney)
                        <option value="{{$typemoney->id_type}}">{{$typemoney->name_type}}</option>
                        @endforeach 
                    </select>                            
                    {!! Form::label('','Note', array('for' => 'exampleInputEmail1')) !!}
                    {!! Form::text('note', $input["note"], array('class' => 'form-control', 'maxlength' => '35')) !!}
                    {!! Form::label('','Avatar', array('for' => 'exampleInputEmail1')) !!}     
                    {!! Form::file('image', array('accept' => 'image/*')) !!}
                    <p style="color:red;"><?php if (isset($error)) {echo $error;} ?></p>
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