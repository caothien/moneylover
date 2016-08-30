@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Edit Wallet</div>

                <div class="panel-body">
                    {!! Form::open(array('url' => '/updatewallet', 'method' => 'post', 'enctype' => 'multipart/form-data')) !!}
                    {!! Form::hidden('idwallet',$wallets->id_wallet, array('for' => 'exampleInputEmail1')) !!}
                    {!! Form::label('','Name Wallet', array('for' => 'exampleInputEmail1')) !!}
                    {!! Form::label('','&nbsp; (*)', array('for' => 'exampleInputEmail1', 'class' => 'batbuoc')) !!}
                    {!! Form::text('name', $wallets->name_wallet, array('class' => 'form-control', 'required', 'maxlength' => '15' )) !!}
                    {!! Form::label('','Money', array('for' => 'exampleInputEmail1')) !!}
                    {!! Form::label('','&nbsp; (*)', array('for' => 'exampleInputEmail1', 'class' => 'batbuoc')) !!}
                    {!! Form::number('money', $wallets->money_wallet, array('class' => 'form-control','id' => 'money', 'onkeypress' => 'return isNumberKey(event)', 'oninput' => 'limitNumber()', 'required')) !!}
                    {!! Form::label('','Type Money', array('for' => 'exampleInputEmail1')) !!}
                    {!! Form::label('','&nbsp; (*)', array('for' => 'exampleInputEmail1', 'class' => 'batbuoc')) !!}
                    <select class="form-control" name="typemoney">
                        <option value="{{$wallets->id_type}}">{{$wallets->name_type}}</option>
                        @foreach($typeMoneys as $typemoney)
                        <option value="{{$typemoney->id_type}}">{{$typemoney->name_type}}</option>
                        @endforeach 
                    </select>                            
                    {!! Form::label('','Note', array('for' => 'exampleInputEmail1')) !!}
                    {!! Form::text('note', $wallets->note_wallet, array('class' => 'form-control', 'maxlength' => '35')) !!}
                    {!! Form::label('','Avatar', array('for' => 'exampleInputEmail1')) !!} 
                    <p></p>
                    <img src="{{ asset($wallets->avatar_wallet) }}" alt="image" class="img-thumbnail"  width="100" height="100">
                    <p></p>
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

