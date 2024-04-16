<?php
use Carbon\Carbon;
?>
@extends('admin.adminhome')
@section('content')

        <!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Admin management</h1>
    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
  </div>



<div class="row">

        <!-- Area Chart -->
        <div class="col-xs-12 col-sm-12">

          <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Admin management</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="manager_user" cellspacing="0">
                        <thead>
                            <tr>
                              <th>Account Name</th>
                              <th>Fullname</th>
                              <th>Email</th>
                              <th>Creation time</th>
                              <th><button id="create_account" class="btn btn-success">Create Account</button></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                              <th>Account Name</th>
                              <th>Fullname</th>
                              <th>Email</th>
                              <th>Creation time</th>
                              <th></th>
                            </tr>
                        </tfoot>
                        <tbody>
                        @foreach($admin as $value)
                        <tr data-id="291413">
                          <td align="center">{{$value->name}}</td>
                          <td align="center">{{$value->fullname}}</td>
                          <td align="center">{{$value->email}}</td>

                          <td>{{date("d/m/Y",strtotime($value->created_at))}}</td>
                          <td>
                            <a href="{{URL::to('admin/delete-account-admin/'.$value->id)}}" onclick="return confirm('Are you sure you want to delete?');" class="btn btn-danger">Delete</button>


                          </td>

                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
          </div>

          <!-- Pie Chart -->

        </div>

        <!-- Content Row -->


        </div>



</div>
<!-- /.container-fluid -->


      <!-- The Modal -->
<div class="modal" id="modal_create_account">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Create Account</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form action="{{route('post.createAccountAdmin')}}" method="post">
          @csrf
          <div class="form-group">
            <label for="name">Username (*):</label>
            <input type="text" class="form-control" placeholder="Username" id="name" name="name" required>
          </div>
          <div class="form-group">
            <label for="fullname">Fullname (*):</label>
            <input type="text" class="form-control" placeholder="Fullname" id="fullname" name="fullname" required>
          </div>
          <div class="form-group">
            <label for="email">Email (*):</label>
            <input type="email" class="form-control" placeholder="Enter email" id="email" name="email" required>
          </div>
          <div class="form-group">
            <label for="pwd">Password (*):</label>
            <input type="password" class="form-control" placeholder="Enter password" id="pwd" name="password" required>
          </div>

          <button type="submit" class="btn btn-primary">Create</button>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>














@endsection
