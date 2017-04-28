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
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400&amp;subset=cyrillic" rel="stylesheet">

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
        <li class="current"><a href="{{ route('orders.panel') }}">Заказы</a></li>
        <li><a href="{{ route('clients.index') }}">Клиенты</a></li>
        <li><a href="#">Запчасти</a></li>
        <li><a href="#">Услуги</a></li>
        <li><a href="{{ route('accounts.index') }}">Касса</a></li>
    </ul>
</aside>
<main>
    <div id="orders-block">
        <section id="notifications">
            <div v-for="(notification, key) in notifications.notifications" class="notification" @click="notifications.clear(key)">@{{ notification.message }}</div>
        </section>
        <header class="main-header">
            @yield('header')
        </header>
        <section id="content">@yield('content')</section>
    </div>
</main>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
<script type="text/javascript" src="/public/js/all.js"></script>
<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">


</body>
</html>