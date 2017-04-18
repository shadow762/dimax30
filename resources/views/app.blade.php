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
        <script>
            window.Laravel = <?php echo json_encode([
                    'csrfToken' => csrf_token(),
            ]); ?>
        </script>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans&amp;subset=cyrillic" rel="stylesheet">

        <!-- Compiled and minified CSS -->
        <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/css/materialize.min.css">-->
        <!--<link rel="stylesheet" href="{{ asset('public/css/main.css') }}">-->
        <link rel="stylesheet" href="{{ asset('public/css/app.css') }}">

        <!-- Compiled and minified JavaScript -->
        <!--<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>-->
        <!--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.8/js/materialize.min.js"></script>-->
    </head>
<body>
<aside class="left-sidebar">
    <div id="logo-place"></div>
    <ul>
        <li class="current"><a href="{{ route('orders.index') }}">Заказы</a></li>
        <li><a href="{{ route('clients.index') }}">Клиенты</a></li>
        <li><a href="#">Запчасти</a></li>
        <li><a href="#">Услуги</a></li>
    </ul>
</aside>
<main>
    <header class="main-header">
        <div class="search-block">
            <div>
                <input type="search" placeholder="Найдите, что искали...">
            </div>
        </div>
        <div class="btn-block">
            <div><div class="clearfix"><div class="add-order-i icon-i"></div>Новый заказ</div></div>
            <div><div class="clearfix"><div class="filter-i icon-i"></div>Фильтр</div></div>
            <div><div class="clearfix"><div class="person-i icon-i"></div>Выход</div></div>
        </div>
        @yield('header')
    </header>
    <section id="content">@yield('content')</section>
</main>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script type="text/javascript" src="/public/js/app.js"></script>
<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


</body>
</html>