@extends('layout.admin.main')

@section('content')
    <div id="main-header" class="page-header">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>Главная
                <span class="divider">&raquo;</span>
            </li>
            <li>
                <a href="/admin/addobject">Добавить объект</a>
            </li>
        </ul>

        <h1 id="main-heading">
            Добавление нового объекта
        </h1>
    </div>

    <div id="main-content">
        <div class="row-fluid">
            <div class="span12">
                <div class="widget">
                    <div class="widget-header">
                        <span class="title">Новый объект</span>
                    </div>
                    <div class="widget-content form-container">
                        <form method="post" action="/admin/addobject" class="form-horizontal">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="control-group">
                                <label class="control-label" for="category">Тип объекта</label>
                                <div class="controls">
                                    <select id="category" name="category" class="span12">
                                        <option value="квартира" @if(old('category') == 'квартира') selected @endif >Квартира</option>
                                        <option value="дом" @if(old('category') == 'дом') selected @endif >Дом</option>
                                        <option value="комната" @if(old('category') == 'комната') selected @endif >Комната</option>
                                        <option value="участок" @if(old('category') == 'участок') selected @endif >Участок</option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="sub-locality-name">Район</label>
                                <div class="controls">
                                    <select id="sub-locality-name" name="sub-locality-name" class="span12">
                                        <option value="Железнодорожный" @if(old('sub-locality-name') == 'Железнодорожный') selected @endif >Железнодорожный</option>
                                        <option value="Советский" @if(old('sub-locality-name') == 'Советский') selected @endif >Советский</option>
                                        <option value="Октябрьский" @if(old('sub-locality-name') == 'Октябрьский') selected @endif >Октябрьский</option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group{{ $errors->has('address') ? ' error' : '' }}">
                                <label class="control-label" for="address">Адрес</label>
                                <div class="controls">
                                    <input type="text" id="address" name="address" class="span12" value="{{ old('address') }}">
                                </div>
                            </div>

                            <div class="control-group vars area{{ $errors->has('area') ? ' error' : '' }}">
                                <label class="control-label" for="area">Общая площадь (кв.м.)</label>
                                <div class="controls">
                                    <input type="text" id="area" name="area" class="span12">
                                </div>
                            </div>

                            <div class="control-group vars lot-area{{ $errors->has('lot-area') ? ' error' : '' }}">
                                <label class="control-label" for="lot-area">Площадь участка (соток)</label>
                                <div class="controls">
                                    <input type="text" id="lot-area" name="lot-area" class="span12">
                                </div>
                            </div>

                            <div class="control-group vars rooms{{ $errors->has('rooms') ? ' error' : '' }}">
                                <label class="control-label" for="rooms">Комнат</label>
                                <div class="controls">
                                    <input type="text" id="rooms" name="rooms" class="span12">
                                </div>
                            </div>

                            <div class="control-group vars floor{{ $errors->has('floor') ? ' error' : '' }}">
                                <label class="control-label" for="floor">Этаж</label>
                                <div class="controls">
                                    <input type="text" id="floor" name="floor" class="span12">
                                </div>
                            </div>

                            <div class="control-group vars floors-total{{ $errors->has('floors-total') ? ' error' : '' }}">
                                <label class="control-label" for="floors-total">Этажей в доме</label>
                                <div class="controls">
                                    <input type="text" id="floors-total" name="floors-total" class="span12">
                                </div>
                            </div>

                            <div class="control-group vars built-year{{ $errors->has('built-year') ? ' error' : '' }}">
                                <label class="control-label" for="built-year">Год постройки</label>
                                <div class="controls">
                                    <input type="text" id="built-year" name="built-year" class="span12">
                                </div>
                            </div>

                            <div class="control-group vars renovation">
                                <label class="control-label" for="renovation">Ремонт</label>
                                <div class="controls">
                                    <select id="renovation" name="renovation" class="span12">
                                        <option value="хороший">Хороший</option>
                                        <option value="дизайнерский">Дизайнерский</option>
                                        <option value="евро">Евро</option>
                                        <option value="с отделкой">С отделкой</option>
                                        <option value="требует ремонта">Требует ремонта</option>
                                        <option value="частичный ремонт">Частичный ремонт</option>
                                        <option value="черновая отделка">Черновая отделка</option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="deal-status">Тип сделки</label>
                                <div class="controls">
                                    <select id="deal-status" name="deal-status" class="span12">
                                        <option value="прямая продажа">прямая продажа</option>
                                        <option value="продажа от застройщика">продажа от застройщика</option>
                                        <option value="переуступка">переуступка</option>
                                        <option value="первичная продажа вторички">первичная продажа вторички</option>
                                        <option value="встречная продажа">встречная продажа</option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group{{ $errors->has('description') ? ' error' : '' }}">
                                <label class="control-label" for="description">Описание</label>
                                <div class="controls">
                                    <textarea id="description" name="description" class="span12"></textarea>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="name">Имя (необязательно)</label>
                                <div class="controls">
                                    <input type="text" id="name" name="name" class="span12">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="phone">Телефон (необязательно)</label>
                                <div class="controls">
                                    <input type="text" id="phone" name="phone" class="span12">
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                                <button type="reset" class="btn" type="reset">Отмена</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('addscript')
    <script src="/adm/js/addobject.js?v={{ config('app.script_version') }}"></script>
@endsection