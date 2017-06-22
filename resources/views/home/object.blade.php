@extends('layout.main')

@section('addstyle')
    <link href="/flex/flexslider.css" rel="stylesheet">
@endsection

@section('addtitle')
    {{ $title }}
@endsection

@section('content')
    <div class="row">
        @if($object->category == 'квартира')
        <h3>{{ $object->rooms }} комнатная квартира, {{ number_format($object->price, 0, '.', ' ') }} р.</h3>
        @endif
    </div>

    <div class="row">
        <div class="flexslider">
            <ul class="slides">
                <li>
                    <img src="/img/1.jpg" />
                    <p class="flex-caption">Captions and cupcakes. Winning combination.</p>
                </li>
                <li>
                    <img src="/img/2.jpg" />
                    <p class="flex-caption">This image is wrapped in a link!</p>
                </li>
                <li>
                    <img src="/img/3.jpg" />
                </li>
                <li>
                    <img src="/img/4.jpg" />
                </li>
            </ul>
        </div>
    </div>

    <div class="row">
        <ul class="list-group">
            <li class="list-group-item">
                <span class="badge">Железнодорожный</span>
                Район
            </li>
            <li class="list-group-item">
                <span class="badge">Волконского, 1а</span>
                Адрес
            </li>
            <li class="list-group-item">
                <span class="badge">2</span>
                Комнат
            </li>
            <li class="list-group-item">
                <span class="badge">2 из 5</span>
                Этаж
            </li>
            <li class="list-group-item">
                <span class="badge">48 кв.м</span>
                Общая площадь
            </li>
            <li class="list-group-item">
                <span class="badge">63-70-55</span>
                Телефон
            </li>
        </ul>

        <div class="panel panel-default">
            <div class="panel-body">
                Продается отличная квартира на втором этаже 30-ти этажного кирпичного дома.
                Санузел раздельный, отопление печное
            </div>
        </div>
    </div>

    <div class="row" style="margin-bottom: 20px;">
        <span class="label label-info" style="font-size: 20px;">Оксана, тел. 8-9025-63-70-55, 8-9025-655-320</span>
    </div>
@endsection

@section('addscript')
    <script src="/flex/jquery.flexslider-min.js"></script>

    <script type="text/javascript">
        $(window).load(function() {
            $('.flexslider').flexslider({
                slideshow: false
            });
        });
    </script>
@endsection