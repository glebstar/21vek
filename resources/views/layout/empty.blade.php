<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>21 век - агентство недвижимости Улан-Удэ - @yield('addtitle')</title>

    <!-- Bootstrap -->
    <link href="/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/bootstrap/css/jumbotron-narrow.css" rel="stylesheet">
    <link href="/css/main.css?v={{ config('app.script_version') }}" rel="stylesheet">
@yield('addstyle')

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="container">
    <div class="header clearfix">
        <nav>
            <ul class="nav nav-pills pull-right">
                <li role="presentation" @if(Request::path() == '/') class="active" @endif><a href="/">Главная</a></li>
                <li role="presentation" @if(Request::path() == 'about') class="active" @endif><a href="/about">О нас</a></li>
                <li role="presentation" @if(Request::path() == 'contact') class="active" @endif><a href="/contact">Контакты</a></li>
            </ul>
        </nav>
        <h3 class="text-muted">21 век. Агентство недвижимости</h3>
    </div>

    @yield('category')
    @yield('content')

    <div class="row">
        <img src="/img/sb-1.png" />
    </div>

    <footer class="footer">
        <p>&copy; 2017 АН 21 век. Тел: 63-70-55</p>
    </footer>

</div> <!-- /container -->

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/bootstrap/js/bootstrap.min.js"></script>
@yield('addscript')
</body>
</html>