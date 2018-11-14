@extends('employees-mgmt.base')
@section('action-content')
    <!-- Main content -->
    <section class="content">
      <div class="box">
  <div class="box-header">
    <div class="row">
        <div class="col-sm-8">
          <h3 class="box-title">List of employees</h3>
        </div>
        {{--User Role--}}
        @role('user')
        <div class="col-sm-4">
          <a class="btn btn-primary" href="{{ route('create.payment') }}">Add Payment</a>
        </div>
        @endrole
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
      <div class="row">
        <div class="col-sm-6"></div>
        <div class="col-sm-6"></div>
      </div>
    <div id="example2_wrapper" class="dataTables_wrapper form-inline dt-bootstrap">
      <div class="row">
        <div class="col-sm-12">
          <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
              <tr role="row">
                <th width="10%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">ID</th>
                <th width="10%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Payer</th>
                <th width="10%" class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Name: activate to sort column descending" aria-sort="ascending">Employee</th>
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Department: activate to sort column ascending">Token</th>
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Division: activate to sort column ascending">Status</th>
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Created Date</th>
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Updated Date</th>
                  {{--ROle Admin--}}
                <th width="8%" class="sorting hidden-xs" tabindex="0" aria-controls="example2" rowspan="1" colspan="1">Action</th>
              </tr>
            </thead>
            <tbody>
            @foreach ($payment as $payment)
                <tr role="row" class="odd">
                  <td class="sorting_1">{{$payment->id}}</td>
                  <td class="hidden-xs">{{ $payment->payer }}</td>
                  <td class="hidden-xs">{{ $payment->employee_id }}</td>
                  <td class="hidden-xs">{{ $payment->token }}</td>
                  <td class="hidden-xs">{{ $payment->status }}</td>
                  <td class="hidden-xs">{{ $payment->created_at->diffForHumans() }}</td>
                  <td class="hidden-xs">{{ $payment->created_at->diffForHumans() }}</td>
                  <td>
                      {{--role admin--}}
                    <form class="row" method="POST" action="{{ route('employee-management.destroy', ['id' => $payment->id]) }}">
                        @role('admin')
                             @if($payment->status === 'open')
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <a href="{{ route('payment.password', $payment->id)}}" class="btn btn-success btn-margin">
                                    Sent Money
                                </a>
                            @endif
                        @endrole

                        {{--role user--}}

                        @role('user')
                            @if($payment->status === 'paid')
                                <a href="{{ route('close.payment', $payment->id)}}" class="btn btn-warning btn-margin">
                                    close payment
                                </a>
                            @endif
                        @endrole
                    </form>
                  </td>
              </tr>
            @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-7">
          <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
              {{--{!! $payment->render() !!}--}}
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>
    </section>
    <!-- /.content -->
  </div>
@endsection