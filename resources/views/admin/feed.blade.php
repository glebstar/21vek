@extends('layout.admin.main')

@section('content')
    <div id="main-header" class="page-header">
        <ul class="breadcrumb">
            <li>
                <a href="/admin"><i class="icon-home"></i>Главная</a>
                <span class="divider">&raquo;</span>
            </li>
            <li>
                Генерация фида
            </li>
        </ul>

        <h1 id="main-heading">
            Генерация фида
        </h1>
    </div>

    <div id="main-content">
        <div class="row-fluid">
            Фид: <br />
            <a href="{{ config('app.url') }}/21vek-an-feed.xml" target="_blank">{{ config('app.url') }}/21vek-an-feed.xml</a><br />
            <a href="{{ config('app.url') }}/21vek-an-feed-cian.xml" target="_blank">{{ config('app.url') }}/21vek-an-feed-cian.xml</a>
        </div>
        <div class="row-fluid">
            <a href="/admin/feed/gen" class="btn btn-success">Перегенерировать</a>
        </div>
    </div>
@endsection