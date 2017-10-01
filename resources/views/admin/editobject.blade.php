@extends('layout.admin.main')

@section('content')
    <div id="main-header" class="page-header">
        <ul class="breadcrumb">
            <li>
                <i class="icon-home"></i>Главная
                <span class="divider">&raquo;</span>
            </li>
            <li>
                <a href="#">Редактировать объект</a>
            </li>
        </ul>

        <h1 id="main-heading">
            Редактирование объекта
        </h1>
    </div>

    <div id="main-content">

        <div class="row-fluid" style="margin-bottom: 20px;">
            @if($object->is_trash)
            <button class="j-bth-fromarchive btn btn-success" data-object-id="{{ $object->id }}">Вернуть из архива</button>
            @else
            <button class="j-bth-toarchive btn btn-danger" data-object-id="{{ $object->id }}">Удалить в архив</button>
            @endif
        </div>

        <div class="row-fluid">
            <div class="span12">
                <div class="widget">
                    <div class="widget-header">
                        <span class="title">Объект</span>
                    </div>
                    <div class="widget-content form-container">
                        <form method="post" action="/admin/editobject" class="form-horizontal">

                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="id" value="{{ $object->id }}">

                            <div class="control-group">
                                <label class="control-label" for="category">Тип объекта</label>
                                <div class="controls">
                                    <select id="category" name="category" class="span12">
                                        <option value="квартира" @if($object->category == 'квартира') selected @endif >Квартира</option>
                                        <option value="дом" @if($object->category == 'дом') selected @endif >Дом</option>
                                        <option value="комната" @if($object->category == 'комната') selected @endif >Комната</option>
                                        <option value="участок" @if($object->category == 'участок') selected @endif >Участок</option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="sub-locality-name">Район</label>
                                <div class="controls">
                                    <select id="sub-locality-name" name="sub-locality-name" class="span12">
                                        <option value="Железнодорожный" @if($object->sub_locality_name == 'Железнодорожный') selected @endif >Железнодорожный</option>
                                        <option value="Советский" @if($object->sub_locality_name == 'Советский') selected @endif >Советский</option>
                                        <option value="Октябрьский" @if($object->sub_locality_name == 'Октябрьский') selected @endif >Октябрьский</option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group{{ $errors->has('address') ? ' error' : '' }}">
                                <label class="control-label" for="address">Адрес</label>
                                <div class="controls">
                                    <input type="text" id="address" name="address" class="span12" value="{{ $object->address }}">
                                </div>
                            </div>

                            <div class="control-group vars area{{ $errors->has('area') ? ' error' : '' }}">
                                <label class="control-label" for="area">Общая площадь (кв.м.)</label>
                                <div class="controls">
                                    <input type="text" id="area" name="area" class="span12" value="{{ $object->area }}">
                                </div>
                            </div>

                            <div class="control-group vars lot-area{{ $errors->has('lot-area') ? ' error' : '' }}">
                                <label class="control-label" for="lot-area">Площадь участка (соток)</label>
                                <div class="controls">
                                    <input type="text" id="lot-area" name="lot-area" class="span12" value="{{ $object->lot_area }}">
                                </div>
                            </div>

                            <div class="control-group vars rooms{{ $errors->has('rooms') ? ' error' : '' }}">
                                <label class="control-label" for="rooms">Комнат</label>
                                <div class="controls">
                                    <input type="text" id="rooms" name="rooms" class="span12" value="{{ $object->rooms }}">
                                </div>
                            </div>

                            <div class="control-group vars floor{{ $errors->has('floor') ? ' error' : '' }}">
                                <label class="control-label" for="floor">Этаж</label>
                                <div class="controls">
                                    <input type="text" id="floor" name="floor" class="span12" value="{{ $object->floor }}">
                                </div>
                            </div>

                            <div class="control-group vars floors-total{{ $errors->has('floors-total') ? ' error' : '' }}">
                                <label class="control-label" for="floors-total">Этажей в доме</label>
                                <div class="controls">
                                    <input type="text" id="floors-total" name="floors-total" class="span12" value="{{ $object->floors_total }}">
                                </div>
                            </div>

                            <div class="control-group vars built-year{{ $errors->has('built-year') ? ' error' : '' }}">
                                <label class="control-label" for="built-year">Год постройки</label>
                                <div class="controls">
                                    <input type="text" id="built-year" name="built-year" class="span12" value="{{ $object->built_year }}">
                                </div>
                            </div>

                            <div class="control-group vars renovation">
                                <label class="control-label" for="renovation">Ремонт</label>
                                <div class="controls">
                                    <select id="renovation" name="renovation" class="span12">
                                        <option value="хороший" @if($object->renovation == 'хороший') selected @endif >Хороший</option>
                                        <option value="дизайнерский" @if($object->renovation == 'дизайнерский') selected @endif >Дизайнерский</option>
                                        <option value="евро" @if($object->renovation == 'евро') selected @endif >Евро</option>
                                        <option value="с отделкой" @if($object->renovation == 'с отделкой') selected @endif >С отделкой</option>
                                        <option value="требует ремонта" @if($object->renovation == 'требует ремонта') selected @endif >Требует ремонта</option>
                                        <option value="частичный ремонт" @if($object->renovation == 'частичный ремонт') selected @endif >Частичный ремонт</option>
                                        <option value="черновая отделка" @if($object->renovation == 'черновая отделка') selected @endif >Черновая отделка</option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="deal-status">Тип сделки</label>
                                <div class="controls">
                                    <select id="deal-status" name="deal-status" class="span12">
                                        <option value="прямая продажа" @if($object->deal_status == 'прямая продажа') selected @endif >прямая продажа</option>
                                        <option value="продажа от застройщика" @if($object->deal_status == 'продажа от застройщика') selected @endif >продажа от застройщика</option>
                                        <option value="переуступка" @if($object->deal_status == 'переуступка') selected @endif >переуступка</option>
                                        <option value="первичная продажа вторички" @if($object->deal_status == 'первичная продажа вторички') selected @endif >первичная продажа вторички</option>
                                        <option value="встречная продажа" @if($object->deal_status == 'встречная продажа') selected @endif >встречная продажа</option>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group{{ $errors->has('description') ? ' error' : '' }}">
                                <label class="control-label" for="description">Описание</label>
                                <div class="controls">
                                    <textarea id="description" name="description" class="span12">{{ $object->description }}</textarea>
                                </div>
                            </div>

                            <div class="control-group{{ $errors->has('price') ? ' error' : '' }}">
                                <label class="control-label" for="price">Цена</label>
                                <div class="controls">
                                    <input type="text" id="price" name="price" class="span12" value="{{ $object->price }}">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="name">Имя (необязательно)</label>
                                <div class="controls">
                                    <input type="text" id="name" name="name" class="span12" value="{{ $object->name }}">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="phone">Телефон (необязательно)</label>
                                <div class="controls">
                                    <input type="text" id="phone" name="phone" class="span12" value="{{ $object->phone }}">
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row-fluid">

            <div class="widget">
                <div class="widget-header">
                    <span class="title">Фотографии</span>
                </div>
                <div class="widget-content">
                    <div class="row-fluid">
                        @if(count($images) == 0)
                        <p class="alert alert-info">Нет фотографий</p>
                        @endif
                        @foreach($images as $image)
                            <div class="span3">
                                <img src="/photo/{{ $object->id }}/{{ $image->id }}.{{ $image->name }}" style="height: 100px;" />
                                <p><a href="#" class="j-btn-del-image" data-object-id="{{ $object->id }}" data-image-id="{{ $image->id }}">удалить</a></p>
                            </div>
                        @endforeach
                    </div>
                    <form method="post" action="/admin/addimage" enctype="multipart/form-data">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="id" value="{{ $object->id }}">
                        <input type="file" name="image" />
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('addscript')
    <script src="/adm/js/addobject.js?v={{ config('app.script_version') }}"></script>
@endsection