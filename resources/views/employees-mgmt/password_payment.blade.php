@extends('employees-mgmt.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Payment Password for Payement ID : {{$payment->id}} </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('post.password', $payment->id) }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                            <label  class="col-md-4 control-label">Payment Password QRcode</label>

                            <div class="col-md-6">
                                {!! QrCode::size(200)->generate($payment->password)!!}
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Payment Password</label>

                            <div class="col-md-6">
                                <input  type="password" class="form-control" name="password" value="{{ old('password') }}" required>
                            </div>
                        </div>
                        <input type="hidden" class="form-control" name="email" value="{{ Auth()->user()->email }}">

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
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
