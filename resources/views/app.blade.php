<?php
/**
 * Created by PhpStorm.
 * User: vkazalin
 * Date: 12.01.2017
 * Time: 9:24
 * MAIN LAYOUT
 *
 */
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">
        <link rel="stylesheet" href="{{ asset('public/css/main.css') }}">

        <!-- Compiled and minified JavaScript -->
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>
        <script src="{{asset('public/js/main.js')}}" type="text/javascript"></script>
        <script src="{{asset('public/js/modal.js')}}" type="text/javascript"></script>
    </head>
<body>
<header class="main-header">
    @yield('header')
</header>
<aside class="left-sidebar">
    <ul>
        <li><a href="{{ route('orders.index') }}">Заказы</a></li>
        <li><a href="{{ route('clients.index') }}">Клиенты</a></li>
        <li><a href="#">Запчасти</a></li>
        <li><a href="#">Услуги</a></li>
        <li><a href="#">Выход</a></li>
    </ul>
</aside>
<main>
 @yield('content')
</main>
</body>
</html>