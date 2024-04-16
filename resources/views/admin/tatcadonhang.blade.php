@extends('admin.adminhome')

@section('content')

<div class="col-xs-12 col-md-12">
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">All orders</h6>
            <x-alert />
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
                            <th>Actions</th>

                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>ID</th>
                            <th>Buyer</th>
                            <th>Total Price</th>
                            <th>Status</th>
                            <th>Quantity</th>
                            <th>Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach($bills as $bill)
                        <tr>
                            <?php
                            ?>
                            <td>{{$bill->id}}</td>
                            <td>{{DB::table('users')->where('id',$bill->id_ofuser)->value('name')}}</td>
                            <td>{{$bill->bill_total}}</td>

                            <td>

                                    <select data-value="{{ $bill->id }}" name="status" class="custom-select custom-select-sm mr-1">

                                        @for ($i =1; $i <= 5; $i++) @if($bill->bill_status == $i)
                                            <option value="{{ $i }}" selected>
                                                @switch($i)
                                                @case(1)
                                                Receive order
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
                                                Received products
                                                @break

                                                @default
                                                <span>Something went wrong, please try again</span>
                                                @endswitch
                                            </option>
                                            @else
                                            <option value="{{ $i }}">
                                                @switch($i)
                                                @case(1)
                                                Receive order
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
                                                Received products
                                                @break

                                                @default
                                                <span>Something went wrong, please try again</span>
                                                @endswitch
                                            </option>
                                            @endif
                                            @endfor
                                    </select>

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
