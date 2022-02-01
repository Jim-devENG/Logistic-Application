<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <p>Hello {{$data['name']}}</p>
    <p>Thank you for Placing an order <br>
        Here is Your Tracking number  {{$data['tracking_id']}}</p>
        <p>Order will be delivered within 2-4 days</p>
</body>
</html>