@extends('admin.layout')
@section('brand') active @endsection
@section('admin_content')

    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="index.html">Admin</a>
      <span class="breadcrumb-item active">Brand</span>
    </nav>

    <div class="sl-pagebody">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        All Brand
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
                            <form action="{{ route('store.brand') }}" method="POST" class="d-md-flex pd-y-20 pd-md-y-0">
                                @csrf
                                <input type="text" class="form-control @error('brand_name') is-invalid @enderror" name="brand_name" placeholder="Brand Name">
                                @error('brand_name')
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
                                        <th class="text-center">Brand Name</th>
                                        <th class="text-center" width="11%">Status</th>
                                        <th class="text-center" width="30%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; ?>
                                    @foreach ($brands as $item)
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td>{{ $item->brand_name }}</td>
                                            <td>
                                                @if ($item->brand_status ==1)
                                                    <span class="badge badge-success"> Active</span>
                                                @else
                                                    <span class="badge badge-danger"> Inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('edit-brand', $item->brand_slug) }}" class="btn btn-info btn-sm"> Edit</a>
                                                <a href="{{ route('delete-brand', $item->id) }}" class="btn btn-danger btn-sm"> Delete</a>

                                                @if ($item->brand_status ==1)
                                                <a href="{{ route('inactive-brand', $item->id) }}" class="btn btn-warning btn-sm"> Inactive</a>
                                                @else
                                                <a href="{{ route('active-brand', $item->id) }}" class="btn btn-success btn-sm"> Active</a>
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


