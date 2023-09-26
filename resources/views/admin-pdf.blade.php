<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order PDF</title>

</head>
<style>
.order{
    text-align: center;
}
</style>
<body>
    <h1 class="order">Order Details</h1>

    
   Customer Address : <h3>{{$order->address}}</h3>
    Customer Payment Status: <h3 >{{$order->payment_status}}</h3>
    Customer Delivery Status:<h3 >{{$order->delivery_status}}</h3>

</body>
</html>