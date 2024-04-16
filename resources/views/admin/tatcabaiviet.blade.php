@extends('admin.adminhome')
@section('content')

<div class="col-xs-12 col-md-12">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All post categories</h6>
            <x-alert />
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Post Name</th>
                            <th>Post Type</th>
                            <th>Post ID</th>
                            <th>Note</th>
                            <th>Actions</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Post Name</th>
                            <th>Post Type</th>
                            <th>Post ID</th>
                            <th>Note</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($blog as $blog)
                        <tr>
                            <td>{{$blog->blog_name}}</td>
                            <td>{{$blog->blog_type}}</td>
                            <td>{{$blog->id}}</td>
                            <td>{{$blog->blog_note}}</td>
                            <td>
                                <a href="{{URL::to('/admin/bai-viet/xoabaiviet/'.$blog->id)}}" onclick="return confirm('Are you sure you want to delete?
                                    ')" class="btn btn-danger btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-trash"></i>
                                    </span>
                                    <span class="text">Xóa</span>
                                </a>
                                <a href="{{URL::to('/admin/bai-viet/suabaiviet/'.$blog->id)}}"  class="btn btn-warning btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-tools"></i>
                                    </span>
                                    <span class="text">Sửa</span>
                                </a>
                            </td>

                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
