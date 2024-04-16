@extends('layouts.master')
@section('content')

    <section class="wrapper login sx">
        <div class="d1 step1">
            <img src="https://www.dienmayxanh.com/lich-su-mua-hang/Content/images/i1.png">
            <span>Tra cứu thông tin đơn hàng</span>
            <form id="frmGetVerifyCode" action="{{ route('history.checkLogIn') }}" method="POST">
                @csrf
                <input type="tel" name="txtPhoneNumber" placeholder="Nhập số điện thoại mua hàng" autocomplete="off"
                    maxlength="10">
                @if (session()->has('errorHistory'))
                    <label>{{ session()->get('errorHistory') }}</label>
                @endif
                <label class="hide"></label>
                <button type="submit" class="btn">Tiếp tục</button>
            </form>
        </div>
    </section>
@endsection
