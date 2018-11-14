@extends('employees-mgmt.base')

@section('action-content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Add new Payment</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('post.payment') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                            <label  class="col-md-4 control-label">token</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control" name="wallet" value="{{ old('token') }}" required autofocus>

                                @if ($errors->has('token'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('token') }}</strong>
                                    </span>
                                @endif
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
