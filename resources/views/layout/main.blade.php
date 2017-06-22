@extends('layout.empty')

@section('category')
    <div class="row">
        <ul class="nav nav-tabs">
            <li role="presentation" @if(Request::path() == '/') class="active" @endif><a href="/">Вся недвижимость</a></li>
            <li role="presentation" @if(Request::path() == 'prodaja-kvartir-v-ulan-ude') class="active" @endif><a href="/prodaja-kvartir-v-ulan-ude">Квартиры</a></li>
            <li role="presentation" @if(Request::path() == 'prodaja-domov-v-ulan-ude') class="active" @endif><a href="/prodaja-domov-v-ulan-ude">Дома</a></li>
            <li role="presentation" @if(Request::path() == 'prodaja-komnat-v-ulan-ude') class="active" @endif><a href="/prodaja-komnat-v-ulan-ude">Комнаты</a></li>
            <li role="presentation" @if(Request::path() == 'prodaja-uchastkov-v-ulan-ude') class="active" @endif><a href="/prodaja-uchastkov-v-ulan-ude">Участки</a></li>
        </ul>
        <h2>{{ $category }}</h2>
    </div>
@endsection