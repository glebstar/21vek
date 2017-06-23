@extends('layout.admin.main')

@section('content')
    <div id="main-header" class="page-header">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>Главная
                <span class="divider">&raquo;</span>
            </li>
            <li>
                <a href="/admin">Все объекты</a>
            </li>
        </ul>

        <h1 id="main-heading">
            Все объекты
        </h1>
    </div>

    <div id="main-content">
        <div class="row-fluid">
            <div class="span12 widget">
                <div class="widget-header">
                    <span class="title">
                        <i class="icol-table"></i>
                    </span>
                </div>
                <div class="widget-content table-container">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Категория</th>
                            <th>Район</th>
                            <th>Адрес</th>
                            <th>Комнат</th>
                            <th>Этаж</th>
                            <th>Этажей</th>
                            <th>Фото</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($objects as $object)
                        <tr>
                            <td><a href="/admin/editobject/{{ $object->id }}">{{ $object->category }}</a></td>
                            <td>{{ $object->sub_locality_name }}</td>
                            <td>{{ $object->address }}</td>
                            <td>@if($object->rooms){{ $object->rooms }}@endif</td>
                            <td>@if($object->floor){{ $object->floor }}@endif</td>
                            <td>@if($object->floors_total){{ $object->floors_total }}@endif</td>
                            <td><img src="/img/no-image.png" style="height: 100px;" /></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @include('admin.paginate', ['paginator' => $objects])

        </div>
    </div>
@endsection