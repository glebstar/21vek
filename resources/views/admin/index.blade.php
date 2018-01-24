@extends('layout.admin.main')

@section('content')
    <div id="main-header" class="page-header">
        <ul class="breadcrumb">
            <li>
                <a href="/admin"><i class="icon-home"></i>Главная</a>
                <span class="divider">&raquo;</span>
            </li>
            <li>
                Все объекты
            </li>
        </ul>

        <h1 id="main-heading">
            Все объекты
        </h1>
    </div>

    <div id="main-content">
        <div class="control-group">
            <div class="controls">
                <div class="input-append">
                    <input type="text" id="input-search" value="{{ $_q or '' }}"><button type="button" class="btn" id="btn-search">
                        <i class="icon-search"></i>
                    </button>
                </div>
            </div>
        </div>
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
                            <th>Собственник</th>
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
                            <td><a href="/admin/editobject/{{ $object->id }}">@if(!$object->image_name)<img src="/img/no-image.png" style="height: 100px;" />@else <img src="/photo/{{ $object->id }}/{{ $object->image_name }}" style="height: 100px;" /> @endif</a></td>
                            <td>{{ $object->parent_phone }}</td>
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

@section('addscript')
    <script>
        $(document).ready(function () {
            $('#btn-search').click(function(){
                location.href = '/admin/?_q=' + $('#input-search').val();
            });
        });
    </script>
@endsection