<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @include('cdn')
</head>
<body>
This is {{\App\Http\UserFacade::getUser()->name}}
<br>
His phone is : {{\App\Http\UserFacade::getUser()->phone}}


</body>
</html>


