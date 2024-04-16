@extends('admin.adminhome')
@section('content')

<div class="col-xs-12 col-md-12">
<div class="card shadow mb-4">
    <a href="themmauudai" class="btn btn-success btn-icon-split">

        <span class="text">Add coupon code</span>
    </a>
</div>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All coupon codes</h6>
            <x-alert />
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <!-- <th>ID</th> -->
                            <th>Type</th>
                            <th>Coupon</th>
                            <th>Descrition</th>
                            <th>Value</th>
                            <th>Applicable products</th>
                            <th>Applicable categories</th>
                            <th>Expiration date</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <!-- <th>ID</th> -->
                            <th>Type</th>
                            <th>Coupon</th>
                            <th>Descrition</th>
                            <th>Value</th>
                            <th>Applicable products</th>
                            <th>Applicable categories</th>
                            <th>Expiration date</th>
                            <th>Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($coupon as $coupon)
                        <tr>
                            <!-- <td>{{$coupon->id}}</td> -->
                            <td>
                                @if ($coupon->coupon_type == 1) Discount by percentage
                                @else Discount by product
                                @endif
                            </td>
                            <td>{{$coupon->coupon_code}}</td>
                            <td>{{$coupon->coupon_description}}</td>
                            <td>{{$coupon->coupon_value}}</td>
                            <td>{{$coupon->product_name}}</td>
                            <td>{{$coupon->category_name}}</td>
                            <td>{{$coupon->coupon_date}}</td>

                            <td>
                                <a href="{{URL::to('/admin/don-hang/xoamauudai/'.$coupon->id)}}" onclick="return confirm('BAre you sure you want to delete?')" class="btn btn-danger btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-trash"></i>
                                    </span>
                                    <span class="text">Delete</span>
                                </a>
                                <a href="{{URL::to('/admin/don-hang/suamauudai/'.$coupon->id)}}"  class="btn btn-warning btn-icon-split">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-tools"></i>
                                    </span>
                                    <span class="text">Edit</span>
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
