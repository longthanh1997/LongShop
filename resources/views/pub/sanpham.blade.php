<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">


    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"
        integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
</head>

<body>
    <h2>SAN PHAM</h2>
    @foreach ($products as $item)
        <p>{{ $item->product_name }}</p>
        <img src="{{ $item->product_image }}" alt="{{ $item->product_name }}">
        <p>{{ $item->product_price }}</p>
        <form action="{{ route('cart.add') }}" method="post" class="add-to-cart">
            @csrf
            <input type="hidden" name="product_id" class="product_id" value="{{ $item->id }}">
            <input type="hidden" name="product_name" class="product_name" value="{{ $item->product_name }}">
            <input type="hidden" name="product_price" class="product_price" value="{{ $item->product_price }}">
            <input type="hidden" name="product_image" class="product_image" value="{{ $item->product_image }}">
            <button type="submit">Mua ngay</button>
        </form>
    @endforeach

</body>

</html>
