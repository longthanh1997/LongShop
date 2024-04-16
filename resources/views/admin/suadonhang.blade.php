@extends('admin.adminhome')
@section('content')
<div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">Sửa đơn hàng</h6>

</div>
<div class="container-fluid">

    <div class="card card-info card-outline">
        <div class="card-body">
            <form action="{{URL::to('/admin/don-hang/postsuadonhang')}}" method="post" class="mb-0" id="admin-form" enctype='multipart/form-data'>
            @csrf
                <div class="form-group row align-items-center">
                    <label class="col-sm-2 col-form-label text-sm-right ">Id</label>
                    <div class="col-xs-12 col-sm-8">
                        <input type="text" name="id" value="{{$bill->id}}" class="form-control form-control-sm" readonly>
                    </div>
                </div>
                <div class="form-group row align-items-center">
                    <label class="col-sm-2 col-form-label text-sm-right ">Người mua</label>
                    <div class="col-xs-12 col-sm-8">
                        <input type="text" name="name" value="{{$name}}" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="form-group row align-items-center">
                    <label class="col-sm-2 col-form-label text-sm-right ">Total</label>
                    <div class="col-xs-12 col-sm-8">
                        <input type="text" name="total" value="{{$bill->bill_total}}" class="form-control form-control-sm">
                    </div>
                </div>
                <div class="form-group row align-items-center">
                    <label class="col-sm-2 col-form-label text-sm-right ">Trạng thái</label>
                    <div class="col-xs-12 col-sm-8">
                        <select name="status" class="custom-select custom-select-sm mr-1">
                            @for ($i =1; $i <= 5; $i++) @if($bill->bill_status == $i)
                                <option value="{{ $i }}" selected>
                                    @switch($i)
                                    @case(1)
                                    Nhận đơn
                                    @break
                                    @case(2)
                                    Chờ thanh toán
                                    @break
                                    @case(3)
                                    Chờ đóng gói
                                    @break
                                    @case(4)
                                    Đang vận chuyển
                                    @break
                                    @case(5)
                                    Đã nhận hàng
                                    @break

                                    @default
                                    <span>Something went wrong, please try again</span>
                                    @endswitch
                                </option>
                                @else
                                <option value="{{ $i }}">
                                    @switch($i)
                                    @case(1)
                                    Nhận đơn
                                    @break
                                    @case(2)
                                    Chờ thanh toán
                                    @break
                                    @case(3)
                                    Chờ đóng gói
                                    @break
                                    @case(4)
                                    Đang vận chuyển
                                    @break
                                    @case(5)
                                    Đã nhận hàng
                                    @break

                                    @default
                                    <span>Something went wrong, please try again</span>
                                    @endswitch
                                </option>
                                @endif
                                @endfor
                        </select>
                    </div>
                </div>
                <div class="form-group row align-items-center">
                    <label class="col-sm-2 col-form-label text-sm-right ">Số lượng</label>
                    <div class="col-xs-12 col-sm-8">
                        <input type="number" name="quantity" value="{{$bill->bill_so_luong}}" class="form-control form-control-sm">
                    </div>
                </div>


                <div class="card-footer">
                    <div class="col-12 col-sm-8 offset-sm-2">
                    <button type="submit" class="btn btn-primary" name="suabaiviet" id="suabaiviet">Save</button>
                        <a href="/dienmayxanh/admin/don-hang/tatcadonhang" class="btn btn-sm btn-danger mr-1"> Cancel</a>
                    </div>
                </div>
            </form>
        </div>

    </div>
    @endsection
