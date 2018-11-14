@extends('employees-mgmt.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Payment for Payement ID : {{$payment->id }} </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{route('paid.payment', $payment->id)}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{method_field('PATCH')}}
                        <div class="form-group">
                            <label  class="col-md-4 control-label">Reciever</label>
                            <div class="col-md-6">
                                <input  type="email" class="form-control" value="{{ $payment->employee_id }}" disabled>
                                <input  type="hidden" class="form-control" name="reciever" value="{{ $payment->employee_id }}" disabled>
                            </div>
                        </div>

                        <div class="form-group">
                            <label  class="col-md-4 control-label">Sender</label>
                            <div class="col-md-6">
                                <input  type="email" class="form-control"  value="{{ Auth()->user()->email }}" disabled>
                                <input  type="hidden" class="form-control" name="sender" value="{{ Auth()->user()->email }}" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-md-4 control-label">Wallet QRCode</label>
                            <div class="col-md-6">
                                {!! QrCode::size(200)->generate($payment->token)!!}
                            </div>
                        </div>
                        <div class="form-group">
                            <label  class="col-md-4 control-label">Wallet</label>
                            <div class="col-md-6">
                                <p  type="text" class="form-control" >{{ $payment->token }}</p>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="paid" class="btn btn-warning">
                                    Paid
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
