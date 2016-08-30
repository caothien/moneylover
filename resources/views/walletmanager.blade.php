@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th>Name</th>
                                <th>Money</th>
                                <th>Type</th>
                                <th>Note</th>
                                <th>Avatar</th>
                                <th></th>
                                <th></th>
                            </tr>
                            @foreach($wallets as $wallet)
                            <tr>
                                <td>{{$wallet->name_wallet}}</td>
                                <td>{{number_format($wallet->money_wallet,0)}}</td>
                                <td>{{$wallet->name_type}}</td>
                                <td>{{$wallet->note_wallet}}</td>
                                <td><img src="{{$wallet->avatar_wallet}}" alt="image" width="50" height="50"></td>
                                <td><a href="{{ url('editwallet')}}/{{$wallet->id_wallet}}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a></td>
                                <td><a href="{{ url('deletewallet')}}/{{$wallet->id_wallet}}"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a></td>
                            </tr>
                            @endforeach                                  
                        </table>
                        {{ $wallets->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection