<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if(session()->has('error')) {{ session()->get('error') }} @endif
    <form action="{{ route('pay') }}" method="POST">
        @csrf
        <input type="text" name="email" placeholder="email">
        <br>
        <input type="number" name="amount" placeholder="amount" value="4000">
        <br>
        <input type="number" name="user_id" placeholder="user_id" value="1">
        <br>
        <input type="number" name="aff_id" placeholder="aff_id" value="2">
        <br>
        <input type="text" name="currency" placeholder="currency" >
        <br>
        <input type="number" name="product_id" placeholder="product_id" value="5">
        <br>
        <button type="submit">Submit</button>
    </form>
</body>
</html>