@extends('admin.layout')
@section('slider') active @endsection
@section('admin_content')

    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="">Admin</a>
      <span class="breadcrumb-item">Slider</span>
      <span class="breadcrumb-item active">Add Slider</span>
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
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Add New Slider</h6>
                <p>
                    This information for a signle slider.
                </p>
                <form action="{{ route('store.slider') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-layout">
                        <div class="row mg-b-25">
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                                    <select class="form-control select2 @error('category') is-invalid @enderror" name="category" data-placeholder="Choose category">
                                        <option label="Choose category"></option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}">{{ $item->cat_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <label class="form-control-label">Slider Title: <span class="tx-danger">*</span></label>
                                    <input value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" type="text" name="title" placeholder="Enter slider">
                                    @error('title')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-12">
                            <div class="form-group">
                                <label class="form-control-label">Sub Title: <span class="tx-danger">*</span></label>
                                <input value="{{ old('sub_title') }}" class="form-control @error('sub_title') is-invalid @enderror" type="text" name="sub_title" placeholder="Enter the sub title">
                                @error('sub_title')
                                    <div class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-12">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Thumbnail: <span class="tx-danger">*</span> </label>
                                    <input type="file" onchange="readURL(this);" name="image" class="form-control upload @error('image') is-invalid @enderror" id="">
                                    <img src="#" class="imageResult img-thumbnail" width="100%" height="250px" alt="">
                                    @error('image')
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

        </div><!-- row -->

    </div><!-- sl-pagebody -->


@endsection


