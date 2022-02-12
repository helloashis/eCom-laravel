@extends('admin.layout')
@section('blog') active @endsection
@section('admin_content')

    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="">Admin</a>
      <span class="breadcrumb-item">Blogs</span>
      <span class="breadcrumb-item active">Add Blogs</span>
    </nav>

    <div class="sl-pagebody">
        <div class="row justify-content-center mt-3">
            <div class="col-md-8">
                @if (Session('msg'))
                    <div class="alert alert-success alert-dismissible fade show">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong>{{Session('msg')}}</strong>
                    </div>
                @endif
            </div>
            <div class="col-md-8">
                <div class="card pd-20 pd-sm-40">
                    <h6 class="card-body-title">Add New Blog</h6>
                    <p>
                        This information for a signle blog.
                    </p>
                    <form action="{{ route('store.blog') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-layout">
                            <div class="row mg-b-25">

                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label class="form-control-label">Blog Title: <span class="tx-danger">*</span></label>
                                        <input value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" type="text" name="title" placeholder="Enter title">
                                        @error('title')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="form-control-label">Description: <span class="tx-danger">*</span></label>
                                        <textarea class="summernote form-control @error('description') is-invalid @enderror" name="description">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div><!-- col-4 -->

                                <div class="col-md-4">
                                    <div class="form-group mg-b-10-force">
                                        <label class="form-control-label">Thumbnail: <span class="tx-danger">*</span> </label>
                                        <input type="file" onchange="readURL(this);" name="thumbnail" class="form-control upload @error('thumbnail') is-invalid @enderror" id="">
                                        <img src="#" class="imageResult img-thumbnail" width="100%" height="250px" alt="">
                                        @error('thumbnail')
                                            <div class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </div>
                                        @enderror
                                    </div>
                                </div><!-- col-4 -->

                            </div><!-- row -->

                            <div class="form-layout-footer">
                                <button type="submit" class="btn btn-info mg-r-5">Submit</button>
                                <button type="reset" class="btn btn-secondary">Cancel</button>
                            </div><!-- form-layout-footer -->
                        </div><!-- form-layout -->
                    </form>
                </div><!-- card -->
            </div>

        </div><!-- row -->

    </div><!-- sl-pagebody -->


@endsection


