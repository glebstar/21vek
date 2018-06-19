@extends('layout.admin.main')

@section('content')
    <div id="main-header" class="page-header">
        <ul class="breadcrumb">
            <li>
                <a href="/admin"><i class="icon-home"></i>Главная</a>
                <span class="divider">&raquo;</span>
            </li>
            <li>
                <i class="icon-phone"></i>Телефон
                <span class="divider">&raquo;</span>
            </li>
            <li>
                Изменить телефон
            </li>
        </ul>

        <h1 id="main-heading">
            Изменить телефон
        </h1>
    </div>

    <div id="main-content">
        <div class="row-fluid">
            <div class="span12 widget">
                <div class="widget-header">
                    <span class="title"><i class="icon-edit"></i> Изменить телефон</span>
                </div>
                <div class="widget-content form-container">
                    <form method="post" class="form-vertical">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="control-group">
                            <label class="control-label">Старый телефон</label>
                            <div class="controls">
                                <input type="text" class="form-control" id="old_phone">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Новое имя</label>
                            <div class="controls">
                                <input type="text" class="form-control" id="name">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label">Новый телефон</label>
                            <div class="controls">
                                <input type="text" class="form-control" id="phone">
                            </div>
                        </div>
                        <div class="form-actions">
                            <button class="btn btn-primary" onclick="return changePhone();">Изменить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('addscript')
    <script>
        function changePhone() {
            $.post('/admin/phone/change', {_token: csrf_token, old: $('#old_phone').val(), name: $('#name').val(), phone: $('#phone').val()}, function(data){
                if (data.result == 'ok') {
                    alert('Успешно заменён');
                } else {
                    alert(data.message);
                }
            });

            return false;
        }
    </script>
@endsection