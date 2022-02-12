@extends('admin.layout')
@section('category') active @endsection
@section('admin_content')

    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="index.html">Admin</a>
      <span class="breadcrumb-item ">Category</span>
      <span class="breadcrumb-item active">Edit Category</span>
    </nav>

    <div class="sl-pagebody">
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Edit Category
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
                            <form action="{{ route('update.category') }}" method="POST" class="d-md-flex pd-y-20 pd-md-y-0">
                                @csrf
                                <input type="hidden" name="id" value="{{ $category->id }}">
                                <input type="text" class="form-control @error('cat_name') is-invalid @enderror" name="cat_name" placeholder="Category Name" value="{{ $category->cat_name }}">
                                @error('cat_name')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                                <button type="submit" name="submit" class="btn btn-info btn-sm pd-y-13 pd-x-20 bd-0 mg-md-l-10 mg-t-10 mg-md-t-0">Update</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div><!-- col-8 -->
        </div><!-- row -->

    </div><!-- sl-pagebody -->


@endsection


