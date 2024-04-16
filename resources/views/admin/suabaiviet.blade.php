@extends('admin.adminhome')
@section('content')
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">EDITING</h6>
</div>
<div class="container-fluid">

    <div class="card card-info card-outline">
        <div class="card-body">
            <form action="{{URL::to('/admin/bai-viet/postsuabaiviet')}}" method="post" class="mb-0" id="admin-form" enctype='multipart/form-data'>
            @csrf
                <div class="form-group row align-items-center">
                    <label class="col-sm-2 col-form-label text-sm-right ">Id</label>
                    <div class="col-xs-12 col-sm-8">
                        <input type="text" name="id" value="{{$blogEdit->id}}" class="form-control form-control-sm" readonly>
                    </div>
                </div>

                <div class="form-group row align-items-center">
                    <label class="col-sm-2 col-form-label text-sm-right required">Type</label>
                    <div class="col-xs-12 col-sm-8">
                        <input type="text" name="type" value="{{$blogEdit->blog_type}}" class="form-control form-control-sm">
                    </div>
                </div>

                <div class="form-group row align-items-center">
                    <label class="col-sm-2 col-form-label text-sm-right required">Name</label>
                    <div class="col-xs-12 col-sm-8">
                        <input type="text" name="name" value="{{$blogEdit->blog_name}}" class="form-control form-control-sm">
                    </div>
                </div>

                <div class="form-group row align-items-center">
                    <label class="col-sm-2 col-form-label text-sm-right required">Avatar</label>
                    <div class="col-xs-12 col-sm-8">
                        <img src="{{ URL::asset('public/blog_img/'.$blogEdit->blog_avatar) }}"/>
                        <input type="file" id="avatar" name="avatar">

                    </div>
                </div>
                <div class="form-group row align-items-center">
                    <label class="col-sm-2 col-form-label text-sm-right required">Note</label>
                    <div class="col-xs-12 col-sm-8">
                        <input type="text" name="note" value="{{$blogEdit->blog_note}}" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="form-group row align-items-center">
                    <label class="col-sm-2 col-form-label text-sm-right required">Content</label>
                    <div class="col-xs-12 col-sm-8">
                        <textarea id="blog-content" name="content" rows="4" cols="50">{{$blogEdit->blog_content}}
                        </textarea>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-12 col-sm-8 offset-sm-2">
                    <button type="submit" class="btn btn-primary" name="suabaiviet" id="suabaiviet">Save</button>
                        <a href="http://localhost/dienmayxanh/admin/bai-viet/tatcabaiviet" class="btn btn-sm btn-danger mr-1"> Cancel</a>

                    </div>
                </div>
            </form>
        </div>

    </div>
    @endsection
