@extends('admin.layout')
@section('coupon') active @endsection
@section('admin_content')

    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="index.html">Admin</a>
      <span class="breadcrumb-item active">Discount Coupon</span>
    </nav>

    <div class="sl-pagebody">
        <div class="row justify-content-center mt-5">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        All Coupons
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
                        <div class="d-flex align-items-center justify-content-center bg-gray-100 ht-md-80 bd pd-x-20">
                            <form action="{{ route('store.coupon') }}" method="POST" class="d-md-flex pd-y-20 pd-md-y-0">
                                @csrf
                                <input type="text" value="{{ old('coupon_name') }}" class="form-control @error('coupon_name') is-invalid @enderror" name="coupon_name" placeholder="Coupon Name">
                                @error('coupon_name')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                                <input type="text" value="{{ old('get_amount') }}" class="form-control @error('get_amount') is-invalid @enderror" name="get_amount" placeholder="Get amount">
                                @error('get_amount')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror

                                <input type="date" class="form-control @error('experied_date') is-invalid @enderror" name="experied_date" placeholder="Experied date">
                                @error('experied_date')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror

                                <button type="submit" name="submit" class="btn btn-info pd-y-13 pd-x-20 bd-0 mg-md-l-10 mg-t-10 mg-md-t-0">Save</button>
                            </form>
                        </div>
                        <br>
                        <div class="table-wrapper">
                            <table id="datatable1" class="table table-bordered">
                                <thead>
                                    <tr >
                                        <th class="text-center">SL</th>
                                        <th class="text-center">Coupon Name</th>
                                        <th class="text-center" >Experied Date</th>
                                        <th class="text-center" width="11%">Status</th>
                                        <th class="text-center" width="21%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; ?>
                                    @foreach ($coupon as $item)
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td>{{ $item->coupon_name }} of discount {{ $item->get_amount }}%</td>
                                            <td>{{ $item->experied_date }}</td>
                                            <td class="text-center">
                                                @if ($item->coupon_status ==1)
                                                    <span class="badge badge-success"> Active</span>
                                                @else
                                                    <span class="badge badge-danger"> Experied </span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('delete-coupon', $item->id) }}" class="btn btn-danger btn-sm"> Delete</a>

                                                @if ($item->coupon_status ==1)
                                                <a href="{{ route('inactive-coupon', $item->id) }}" class="btn btn-warning btn-sm"> Inactive</a>
                                                @else
                                                <a href="{{ route('active-coupon', $item->id) }}" class="btn btn-success btn-sm"> Active</a>
                                                @endif
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


