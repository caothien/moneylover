@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-primary">
                <div class="panel-heading">Transfer Money</div>

                <div class="panel-body">
                    @if (count($errors) > 0)
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li><p style="color: red;">{{ $error }}</p></li>
                        @endforeach
                    </ul>
                    @endif
                    {!! Form::open(array('url' => '/transfer', 'method' => 'post', 'enctype' => 'multipart/form-data')) !!}
                    {!! Form::label('','Wallet send', array('for' => 'exampleInputEmail1')) !!}
                    <select class="form-control" name="walletsent">
                        <?php if (isset($wsent)) {
                            echo '<option>' . $wsent . '</option>';
                        } ?>
                        @foreach($wallets as $wallet)
                        <option>{{$wallet->name_wallet}}</option>
                        @endforeach 
                    </select>
                    {!! Form::label('','Wallet receive', array('for' => 'exampleInputEmail1')) !!}
                    <select class="form-control" name="walletreceive">
                        <?php if (isset($wreceive)) {echo '<option>' . $wreceive . '</option>';} ?>
                        @foreach($wallets as $wallet)
                        <option>{{$wallet->name_wallet}}</option>
                        @endforeach 
                    </select>
                    <p style="color:red;"><?php if (isset($errortrungvi)) {echo $errortrungvi;} ?></p>
                    <p style="color:red;"><?php if (isset($errorkhacloaitien)) {echo $errorkhacloaitien;} ?></p>
                    {!! Form::label('','Money', array('for' => 'exampleInputEmail1')) !!}
                    {!! Form::number('money', '', array('class' => 'form-control','id' => 'money', 'onkeypress' => 'return isNumberKey(event)', 'oninput' => 'limitNumber()')) !!}
                    <p style="color:red;"><?php if (isset($loithieutien)) {echo $loithieutien;} ?></p>
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