@extends('admin.adminhome')
@section('content')

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
            <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
          </div>

          <!-- Content Row -->
          <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Product quantity</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$qlt_product}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-calendar fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Total amount in bill Completed</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$total_price}}</div>
                    </div>
                    <div class="col-auto">

                      <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Order Number Completed</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$total_bill_success}}</div>
                        </div>
                        <div class="col">
                          <div class="progress progress-sm mr-2">
                            <?php
                            if($total_bill_success > 0){
                              $p = $total_bill_success/$all_bill;
                            }
                            else{
                              $p = 0;
                            }


                            ?>
                            <div class="progress-bar bg-info" role="progressbar" style="width: {{$p}}%" aria-valuenow="{{$total_bill_success}}" aria-valuemin="0" aria-valuemax="{{$all_bill}}"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">

                     <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">New orders</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800">{{$total_bill_new}}</div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-cart-plus fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->

          <div class="row">

            <!-- Area Chart -->
            <div class="col-xs-12 col-sm-12">

              <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">New orders</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Buyer</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Quantity</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Buyer</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Quantity</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($bills as $bill)
                        <tr>
                            <td>{{$bill->id}}</td>
                            <td>{{DB::table('users')->where('id',$bill->id_ofuser)->value('name')}}</td>
                            <td>{{$bill->bill_total}}</td>

                            <td>
                                <form action="{{URL::to('/admin/don-hang/changestatus/value-new/'.$bill->id)}}" method="post" id="status">
                                    @csrf
                                    <select name="status" class="custom-select custom-select-sm mr-1">

                                        @for ($i =1; $i <= 5; $i++) @if($bill->bill_status == $i)
                                            <option value="{{ $i }}" selected>
                                                @switch($i)
                                                @case(1)
                                                Receive orders
                                                @break
                                                @case(2)
                                                Wait for pay
                                                @break
                                                @case(3)
                                                Waiting for packaging
                                                @break
                                                @case(4)
                                                Being transported
                                                @break
                                                @case(5)
                                                Products received
                                                @break

                                                @default
                                                <span>Something went wrong, please try again</span>
                                                @endswitch
                                            </option>
                                            @else
                                            <option value="{{ $i }}">
                                                @switch($i)
                                                @case(1)
                                                Receive orders
                                                @break
                                                @case(2)
                                                Wait for pay
                                                @break
                                                @case(3)
                                                Waiting for packaging
                                                @break
                                                @case(4)
                                                Being transported
                                                @break
                                                @case(5)
                                                Products received
                                                @break

                                                @default
                                                <span>Something went wrong, please try again</span>
                                                @endswitch
                                            </option>
                                            @endif
                                            @endfor
                                    </select>
                                </form>
                            </td>

                            <td>{{$bill->bill_so_luong}}</td>
                            <td>

                                <a href="{{URL::to('/admin/don-hang/xoadonhang/'.$bill->id)}}" onclick="return confirm('Are you sure you want to delete?')" class="btn btn-danger btn-icon-split">
                                  <span class="icon text-white-50">
                                      <i class="fas fa-trash"></i>
                                  </span>
                                  <span class="text">Delete</span>
                              </a>
                              <a href="{{URL::to('/admin/don-hang/sendmail/'.$bill->id)}}" class="btn btn-success btn-icon-split">
                                  <span class="icon text-white-50">
                                      <i class="fas fa-check"></i>
                                  </span>
                                  <span class="text">Send notification email</span>
                              </a>
                              <a href="{{URL::to('/admin/don-hang/suadonhang/'.$bill->id)}}"  class="btn btn-warning btn-icon-split">
                                  <span class="icon text-white-50">
                                      <i class="fas fa-tools"></i>
                                  </span>
                                  <span class="text">Edit</span>
                              </a>
                                <!-- <a href="{{URL::to('/admin/don-hang/hoantatdonhang/'.$bill->id)}}" class="btn btn-success btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-check"></i>
                                    </span>
                                    <span class="text">Hoàn Tất</span>
                                </a> -->
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
        <!-- /.container-fluid -->


@endsection
