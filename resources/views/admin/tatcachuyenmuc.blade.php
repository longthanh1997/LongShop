@extends('admin.adminhome')
@section('content')

<div class="col-xs-12 col-md-12">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary"> All article categories</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>
                                Name list</th>
                            <th>Mã danh mục</th>
                            <th>Thao tác</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Tên Danh mục</th>
                            <th>Mã danh mục</th>
                            <th>Thao tác</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($categories as $categories)
                        <tr>
                            <td>{{$categories->categories_name}}</td>

                            <td>{{$categories->id}}</td>
                            <td>
                                <a href="{{URL::to('/admin/bai-viet/xoachuyenmuc/'.$categories->id)}}" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-trash"></i>
                                    </span>
                                    <span class="text">Delete</span>
                                </a></td>

                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection
