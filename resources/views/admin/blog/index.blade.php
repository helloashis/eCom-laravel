@extends('admin.layout')
@section('blog') active @endsection
@section('admin_content')

    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="index.html">Admin</a>
      <span class="breadcrumb-item ">Blog</span>
      <span class="breadcrumb-item active">Blog List</span>
    </nav>

    <div class="sl-pagebody">
        <div class="row justify-content-center mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        All BLog

                        <a href="{{ route('admin.add_blog') }}" class="btn btn-success btn-sm float-right">Add New</a>
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
                                        <th class="text-center">Title</th>
                                        <th class="text-center">Description</th>
                                        <th class="text-center" width="8%">Status</th>
                                        <th class="text-center" width="20%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i=1; ?>
                                    @foreach ($blogs as $item)
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td>
                                                <img class="img-thumbnail" width="80px" height="50px" src="{{ asset('uploads/blogs') }}/{{ $item->thumbnail }}" alt="" srcset="">
                                            </td>
                                            <td>{{ $item->title }}</td>
                                            <td class="text-center">
                                                {!! substr($item->description, 0, 180)  !!}
                                            </td>
                                            <td class="text-center">
                                                @if ($item->status ==1)
                                                    <span class="badge badge-success"> Published</span>
                                                @else
                                                    <span class="badge badge-danger"> Draft</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="" class="btn btn-info btn-sm"> Edit</a>
                                                <a href="{{ route('delete-blogs', $item->id) }}" class="btn btn-danger btn-sm"> Delete</a>

                                                @if ($item->status ==1)
                                                <a href="{{ route('inactive-blogs', $item->id) }}" class="btn btn-warning btn-sm"> Inactive</a>
                                                @else
                                                <a href="{{ route('active-blogs', $item->id) }}" class="btn btn-success btn-sm"> Active</a>
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


