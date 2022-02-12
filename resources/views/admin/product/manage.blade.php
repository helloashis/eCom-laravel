@extends('admin.layout')
@section('manage_product') active @endsection
@section('product_act') active @endsection
@section('product') block @endsection
@section('admin_content')

    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="index.html">Admin</a>
      <span class="breadcrumb-item ">Products</span>
      <span class="breadcrumb-item active">Manage Products</span>
    </nav>

    <div class="sl-pagebody">
        <div class="row justify-content-center mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        All product
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
                                        <th class="text-center" >SL</th>
                                        <th class="text-center" width="11%">Thumbnail</th>
                                        <th class="text-center">Product Name</th>
                                        <th class="text-center">Category</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Discount Price</th>
                                        <th class="text-center" width="8%">Status</th>
                                        <th class="text-center" width="20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; ?>
                                    @foreach ($products as $item)
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td>
                                                <img class="img-thumbnail" width="50px" src="{{ asset('uploads/products') }}/{{ $item->image_one }}" alt="" srcset="">
                                            </td>
                                            <td>{{ $item->product_name }}</td>
                                            <td>{{ $item->category->cat_name }}</td>
                                            <td class="text-center">

                                                @if ($item->product_qty>0)
                                                    {{ $item->product_qty }}
                                                @else
                                                <h5 class="badge badge-warning"> Sold Out </h5>
                                                @endif
                                            </td>
                                            <td>{{ $item->product_price }} </td>
                                            <td> {{ $item->discount_price }}</td>
                                            <td class="text-center">
                                                @if ($item->product_status ==1)
                                                    <span class="badge badge-success"> Published</span>
                                                @else
                                                    <span class="badge badge-danger"> Draft</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('edit-product', $item->product_slug) }}" class="btn btn-info btn-sm"> Edit</a>
                                                <a href="{{ route('delete-product', $item->id) }}" class="btn btn-danger btn-sm"> Delete</a>

                                                @if ($item->product_status ==1)
                                                <a href="{{ route('inactive-product', $item->id) }}" class="btn btn-warning btn-sm"> Inactive</a>
                                                @else
                                                <a href="{{ route('active-product', $item->id) }}" class="btn btn-success btn-sm"> Active</a>
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


