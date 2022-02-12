@extends('admin.layout')
@section('manage_product') active @endsection
@section('product_act') active @endsection
@section('product') block @endsection
@section('admin_content')

    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="">Admin</a>
      <span class="breadcrumb-item ">Product</span>
      <span class="breadcrumb-item active">Edit Product</span>
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
                <h6 class="card-body-title">Edit Product</h6>
                <p>
                    This information for a signle product.
                </p>
                <form action="{{ route('update.product') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input name="product_id" value="{{ $product->id }}" type="hidden" >
                    <div class="form-layout">
                        <div class="row mg-b-25">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Product Name: <span class="tx-danger">*</span></label>
                                    <input value="{{ $product->product_name }}" class="form-control @error('product_name') is-invalid @enderror" type="text" name="product_name" placeholder="Enter producut name">
                                    @error('product_name')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Category: <span class="tx-danger">*</span></label>
                                    <select class="form-control select2 @error('category') is-invalid @enderror" name="category" data-placeholder="Choose category">
                                        <option label="Choose category"></option>
                                        @foreach ($categories as $item)
                                            <option value="{{ $item->id }}" {{ $product->category_id == $item->id ? "selected":"" }}>{{ $item->cat_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Brand: <span class="tx-danger">*</span></label>
                                    <select class="form-control select2 @error('brand') is-invalid @enderror" name="brand" data-placeholder="Choose brand">
                                        <option label="Choose brand"></option>
                                        @foreach ($brands as $item)
                                            <option value="{{ $item->id }}" {{ $product->brand_id == $item->id ? "selected":"" }}>{{ $item->brand_name }}</option>
                                        @endforeach
                                    </select>
                                    @error('brand')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Price: <span class="tx-danger">*</span></label>
                                    <input value="{{ $product->product_price }}" class="form-control @error('price') is-invalid @enderror" type="number" name="price" min="1" >
                                    @error('price')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Discount Price: <span class="tx-danger">*</span></label>
                                    <input value="{{ $product->discount_price }}" class="form-control @error('discount_price') is-invalid @enderror" type="number" name="discount_price" min="1" >
                                    @error('discount_price')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Quantity: <span class="tx-danger">*</span></label>
                                    <input value="{{ $product->product_qty }}" class="form-control @error('quantity') is-invalid @enderror" type="number" name="quantity" min="1" >
                                    @error('quantity')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-12">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Short Description: <span class="tx-danger">*</span></label>
                                    <textarea class="summernote form-control @error('short_description') is-invalid @enderror" name="short_description">{{ $product->short_description }}</textarea>
                                    @error('short_description')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Long Description: <span class="tx-danger">*</span></label>
                                    <textarea class="summernote form-control @error('long_description') is-invalid @enderror" name="long_description">{{ $product->long_description }}</textarea>

                                    @error('long_description')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div><!-- col-8 -->
                        </div><!-- row -->

                        <div class="form-layout-footer">
                            <button type="submit" class="btn btn-info mg-r-5">Update data</button>
                        </div><!-- form-layout-footer -->
                    </div><!-- form-layout -->
                </form>
                <br>
                <form action="{{ route('update.image') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input name="product_id" value="{{ $product->id }}" type="hidden" >
                    <input name="image_one" value="{{ $product->image_one }}" type="hidden" >
                    <input name="image_two" value="{{ $product->image_two }}" type="hidden" >
                    <input name="image_three" value="{{ $product->image_three }}" type="hidden" >
                    <div class="form-layout">
                        <div class="row mg-b-25">
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Image One: <span class="tx-danger">*</span> <small>(This image will be thumbnail.)</small></label>
                                    <input type="file" name="image_one" class="form-control @error('image_one') is-invalid @enderror" id="">
                                    <img class="img-thumbnail" width="100%" height="100px" src="{{ asset('uploads/products/'.$product->image_one) }}" alt="{{ $product->image_one }}" >
                                    @error('image_one')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Image Two: <span class="tx-danger">*</span></label>
                                    <input type="file" name="image_two" class="form-control @error('image_two') is-invalid @enderror" id="">

                                    <img class="img-thumbnail" width="100%" height="100px" src="{{ asset('uploads/products/'.$product->image_two) }}" alt="{{ $product->image_two }}" >
                                    @error('image_two')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Image Three: <span class="tx-danger">*</span> </label>
                                    <input type="file" name="image_three" class="form-control @error('image_three') is-invalid @enderror" id="">
                                    <img class="img-thumbnail" width="100%" height="100px" src="{{ asset('uploads/products/'.$product->image_three) }}" alt="{{ $product->image_three }}" >
                                    @error('image_three')
                                        <div class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>
                            </div><!-- col-4 -->
                        </div><!-- row -->

                        <div class="form-layout-footer">
                            <button type="submit" class="btn btn-info mg-r-5">Update Image</button>
                        </div><!-- form-layout-footer -->
                    </div><!-- form-layout -->
                </form>
              </div><!-- card -->

        </div><!-- row -->

    </div><!-- sl-pagebody -->


@endsection


