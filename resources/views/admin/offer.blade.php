@extends('layout.admin.main')

@section('content')
    <div id="main-header" class="page-header">
        <ul class="breadcrumb">
            <li>
                <a href="/admin"><i class="icon-home"></i>Главная</a>
                <span class="divider">&raquo;</span>
            </li>
            <li>
                Заявки на продажу
            </li>
        </ul>

        <h1 id="main-heading">
            Заявки на продажу
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
                            <th>Дата</th>
                            <th>Телефон</th>
                            <th>Обработано</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($offers as $offer)
                            <tr>
                                <td>{{ date('d.m.Y H:i', strtotime($offer->created_at)) }}</td>
                                <td>{{ $offer->phone }}</td>
                                <td><input class="offer-completed" data-offer-id="{{ $offer->id }}" type="checkbox" @if($offer->is_comleted)checked @endif> </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('addscript')
    <script>
        $(document).ready(function () {
            $('.offer-completed').click(function () {
                var id = $(this).attr('data-offer-id');
                var completed = $(this).attr('checked') ? 1 : 0;
                $.post('/admin/offer/compl', {_token: csrf_token, id: id, is_completed: completed}, function (data) {
                    return false;
                });
            });
        });
    </script>
@endsection