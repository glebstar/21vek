@extends('layout.main')

@section('addstyle')
    <link href="/flex/flexslider.css?v=2" rel="stylesheet">
@endsection

@section('addtitle')
    {{ $title }}
@endsection

@section('content')
    <div class="row">
        @if($object->category == 'квартира')
        <h3>{{ $object->rooms }} комнатная квартира, {{ number_format($object->price, 0, '.', ' ') }} р.</h3>
        @endif

        @if($object->category != 'квартира')
            <h3>Продаётся {{ $object->category }}, {{ number_format($object->price, 0, '.', ' ') }} р.</h3>
        @endif

    </div>

    <div class="row">
        <div class="flexslider">
            <ul class="slides">
                @if(count($images) == 0)
                <li>
                    <img src="/img/no-image.png" />
                </li>
                @endif
                @foreach($images as $image)
                <li>
                    <img src="/photo/{{ $object->id }}/{{ $image->id }}.{{ $image->name }}" />
                </li>
                @endforeach
            </ul>
        </div>
    </div>

    <div class="row">
        <ul class="list-group">
            <li class="list-group-item">
                <span class="badge">{{ $object->sub_locality_name }}</span>
                Район
            </li>
            <li class="list-group-item">
                <span class="badge">{{ $object->address }}</span>
                Адрес
            </li>

            @if($object->category == 'квартира')
            <li class="list-group-item">
                <span class="badge">{{ $object->rooms }}</span>
                Комнат
            </li>
            <li class="list-group-item">
                <span class="badge">{{ $object->floor }} из {{ $object->floors_total }}</span>
                Этаж
            </li>
            <li class="list-group-item">
                <span class="badge">{{ $object->area }} кв.м</span>
                Общая площадь
            </li>
            <li class="list-group-item">
                <span class="badge">{{ $object->renovation }}</span>
                Ремонт
            </li>
            <li class="list-group-item">
                <span class="badge">{{ $object->deal_status }}</span>
                Условия сделки
            </li>
            @endif

            @if($object->category == 'дом')
                <li class="list-group-item">
                    <span class="badge">{{ $object->rooms }}</span>
                    Комнат
                </li>
                <li class="list-group-item">
                    <span class="badge">{{ $object->floors_total }}</span>
                    Этажей
                </li>
                <li class="list-group-item">
                    <span class="badge">{{ $object->area }} кв.м</span>
                    Общая площадь
                </li>
                <li class="list-group-item">
                    <span class="badge">{{ $object->lot_area }} соток</span>
                    Площадь участка
                </li>
                <li class="list-group-item">
                    <span class="badge">{{ $object->built_year }}</span>
                    Год постройки
                </li>
                <li class="list-group-item">
                    <span class="badge">{{ $object->renovation }}</span>
                    Ремонт
                </li>
                <li class="list-group-item">
                    <span class="badge">{{ $object->deal_status }}</span>
                    Условия сделки
                </li>
            @endif

            @if($object->category == 'комната')
                <li class="list-group-item">
                    <span class="badge">{{ $object->floor }} из {{ $object->floors_total }}</span>
                    Этаж
                </li>
                <li class="list-group-item">
                    <span class="badge">{{ $object->area }} кв.м</span>
                    Общая площадь
                </li>
                <li class="list-group-item">
                    <span class="badge">{{ $object->renovation }}</span>
                    Ремонт
                </li>
                <li class="list-group-item">
                    <span class="badge">{{ $object->deal_status }}</span>
                    Условия сделки
                </li>
            @endif

            @if($object->category == 'участок')
                <li class="list-group-item">
                    <span class="badge">{{ $object->lot_area }} соток</span>
                    Площадь участка
                </li>
                <li class="list-group-item">
                    <span class="badge">{{ $object->deal_status }}</span>
                    Условия сделки
                </li>
            @endif
        </ul>

        <div class="panel panel-default">
            <div class="panel-body">
                {!! nl2br($object->description) !!}
            </div>
        </div>
    </div>

    <div class="row" style="margin-bottom: 20px;">
        @if($object->is_trash)
            <span class="label label-danger" style="font-size: 20px;">Объявление находится в архиве</span>
        @else
            <span class="label label-info" style="font-size: 20px;">@if($object->name){{ $object->name }} @else {{ $user->name }} @endif, тел. @if($object->phone){{ $object->phone }} @else {{ $user->phone }} @endif</span>
        @endif
    </div>
@endsection

@section('addscript')
    <script src="/flex/jquery.flexslider-min.js?v=2"></script>

    <script type="text/javascript">
        $(window).load(function() {
            $('.flexslider').flexslider({
                slideshow: false
            });
        });
    </script>
@endsection