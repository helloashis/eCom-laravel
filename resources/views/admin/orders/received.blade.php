@extends('admin.layout')
@section('receivedorders') active @endsection
@section('admin_content')

    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="index.html">Admin</a>
      <span class="breadcrumb-item active">Received Orders</span>
    </nav>

    <div class="sl-pagebody">
        <div class="row justify-content-center mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        All Received Orders
                    </div>

                    <div class="card-body">
                        @if (Session('msg'))
                            <div class="alert alert-success alert-dismissible fade show">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>{{Session('msg')}}</strong>


                            </div>
                        @endif
                        <div class="table-wrapper">
                            <table id="datatable1" class="table table-bordered">
                                <thead>
                                    <tr >
                                        <th class="text-center">SL</th>
                                        <th class="text-center">Invoice No</th>
                                        <th class="text-center" >Payment Type</th>
                                        <th class="text-center" >Sub-Total</th>
                                        <th class="text-center" >Total</th>
                                        <th class="text-center" width="11%">Discount Status</th>
                                        <th class="text-center" width="21%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; ?>
                                    @foreach ($received_orders as $item)
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td>{{ $item->invoice_no }} </td>
                                            <td>{{ $item->payment_type }}</td>
                                            <td>{{ $item->sub_total }}</td>
                                            <td>{{ $item->total }}</td>
                                            <td class="text-center">
                                                @if ($item->discount_coupon == Null)
                                                    <span class="badge badge-danger"> No </span>
                                                @else
                                                    <span class="badge badge-success"> Yes </span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ url('admin/order/view/'.$item->id) }}" class="btn btn-warning btn-sm"> <i class="fa fa-eye"></i> View</a>
                                            </td>
                                        </tr>
                                        <?php $i++;?>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div><!-- col-8 -->
        </div><!-- row -->

    </div><!-- sl-pagebody -->


@endsection


