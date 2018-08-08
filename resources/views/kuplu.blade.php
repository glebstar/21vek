<!DOCTYPE HTML>
<html>
<head>
    <title>Куплю квартиру в Железнодорожном районе, г. Улан-Удэ | 21 век, агентство недвижимости</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://fonts.googleapis.com/css?family=EB+Garamond" rel="stylesheet">
    <link rel="stylesheet" href="/assets-kup/css/main.css" />
    <style>
        body {
            font-family: 'EB Garamond', serif;
        }
        p {
            margin-bottom: 10px;
        }

        .my-form {
            padding: 20px;
        }
    </style>
</head>
<body class="subpage">

<!-- Header -->
<header id="header">
    <div class="logo"><a href="/">Агентство недвижимости "21 век", г. Улан-Удэ, тел. 8-9025-655-320</a></div>
</header>

<!-- Two -->
<section id="two" class="wrapper style2">
    <div class="inner">
        <div class="box">
            <div class="content">
                <header class="align-center">
                    <p>Агентство недвижимости "21 век", г. Улан-Удэ</p>
                    <h2>Куплю квартиру в Железнодорожном районе, г. Улан-Удэ</h2>
                </header>
                <p>На данный момент у нас много заявок на покупку квартир в Железнодорожном районе, г. Улан-Удэ, а квартир на продажу очень не хватает.</p>

                <p>Если вы продаёте квартиру в Железнодорожном районе, <strong>оставьте нам свой телефон, мы вам перезвоним</strong>. Или позвоните по телефону <strong>8-9025-655-320</strong></p>

                <p>С нами вы продадите свою квартиру быстро и дорого!</p>
            </div>
        </div>

        <div class="box my-form">
            <form method="post" onsubmit="return submPhone();">
                {{ csrf_field() }}
                <label for="phone">Ваш телефон:</label>
                <div class="row uniform">
                    <div class="6u">
                        <input type="text" id="phone" name="phone">
                    </div>
                    <div class="3u$">
                        <input type="submit" class="button special" value="Отправить">
                    </div>
                </div>
            </form>
        </div>

        @if($success)
            <div class="box">
                <div class="content">
                    <header class="align-center">
                        <h2>Спасибо, ваш телефон отправлен</h2>
                    </header>
                    <p>Мы вам перезвоним в ближайшее время.</p>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Footer -->
<footer id="footer">
    <div class="container">
        <ul class="icons">
            <li><a href="https://vk.com/21vek_an" class="icon fa-vk" target="_blank"><span class="label">Наша группа ВКонтакте</span></a></li>
            <li><a href="mailto:glebstarkov@gmail.com" target="_top" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
            <!--
            <li><a href="#" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
            <li><a href="#" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
            <li><a href="#" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
            <li><a href="#" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
            -->
        </ul>
    </div>
    <div class="copyright">
        &copy; 21vek-an.ru Агентство недвижимости "21 век". 2018 г.
    </div>
</footer>

<!-- Scripts -->
<script src="/assets-kup/js/jquery.min.js"></script>
<script src="/assets-kup/js/jquery.scrollex.min.js"></script>
<script src="/assets-kup/js/skel.min.js"></script>
<script src="/assets-kup/js/util.js"></script>
<script src="/assets-kup/js/main.js"></script>
<script>
    function submPhone() {
        if (!$('#phone').val()) {
            return false;
        }

        return true;
    }
</script>

</body>
</html>