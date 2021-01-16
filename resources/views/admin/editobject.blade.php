@extends('layout.admin.main')

@section('addstyle')
    <link rel="stylesheet" href="/adm/file-upload/css/jquery.fileupload.css">
    <link rel="stylesheet" href="/adm/magnific/dist/magnific-popup.css">
@endsection

@section('content')
    <div id="main-header" class="page-header">
        <ul class="breadcrumb">
            <li>
                <a href="/admin"><i class="icon-home"></i>Главная</a>
                <span class="divider">&raquo;</span>
            </li>
            <li>
                Редактировать объект
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

                            <div class="control-group vars new-building">
                                <label class="control-label">Новостройка</label>
                                <div class="controls">
                                    <label class="checkbox">
                                        <input type="checkbox" name="is_new_building" @if($object->is_new_building) checked="checked" @endif>
                                    </label>
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

                            <div class="control-group">
                                <label class="control-label" for="cadastral-number">Кадастровый номер</label>
                                <div class="controls">
                                    <input type="text" id="cadastral-number" name="cadastral_number" class="span12" value="{{ $object->cadastral_number }}">
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label" for="parent-phone">Собственник</label>
                                <div class="controls">
                                    <input type="text" id="parent-phone" name="parent_phone" class="span12" value="{{ $object->parent_phone }}">
                                </div>
                            </div>

                            <div class="control-group{{ $errors->has('description') ? ' error' : '' }}">
                                <label class="control-label" for="description">Описание</label>
                                <div class="controls">
                                    <textarea id="description" name="description" class="span12" style="height: 300px;">{{ $object->description }}</textarea>
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
                    <div class="row-fluid" id="photos-here">
                        @if(count($images) == 0)
                        <p id="no-photo-alert" class="alert alert-info">Нет фотографий</p>
                        @endif
                        <div id="my-photos">
                        @foreach($images as $image)
                            <div class="span3 my-img" data-image-id="{{ $image->id }}">
                                <img src="/photo/{{ $object->id }}/{{ $image->id }}.{{ $image->name }}" style="height: 100px;" />
                                <p><a href="#" data-object-id="{{ $object->id }}" data-image-id="{{ $image->id }}" onclick="return deleteImage(this)">удалить</a></p>
                            </div>
                        @endforeach
                        </div>
                    </div>

                    <span class="btn btn-success fileinput-button">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>Выберите изображения...</span>
                                        <!-- The file input field used as target for the file upload widget -->
                        <input id="fileupload" type="file" name="photos[]" multiple>
                    </span>
                    <br>
                    <br>
                    <!-- The global progress bar -->
                    <div id="progressbar"></div>
                </div>
            </div>
        </div>

        <div class="row-fluid">
            <div class="widget">
                <div class="widget-header">
                    <a name="documents"></a>
                    <span class="title">Документы</span>
                </div>
                <div class="widget-content">
                    <div class="row-fluid" id="photos-here">
                        @if(count($documents) == 0)
                            <p id="no-photo-alert" class="alert alert-info">Нет документов</p>
                        @endif
                        @foreach($documents as $document)
                            <div class="span3">
                                <a class="j-magnific-a" href="/documents/{{ $object->id }}/{{ $document->id }}.{{ $document->name }}"><img src="/documents/{{ $object->id }}/{{ $document->id }}.{{ $document->name }}" style="height: 100px;" /></a>
                                <p>{{ $document->documentname }}</p>
                                <p><a href="#" data-object-id="{{ $object->id }}" data-document-id="{{ $document->id }}" onclick="return deleteDocument(this)">удалить</a></p>
                            </div>
                        @endforeach
                    </div>

                    <div class="row-fluid">
                        <p><span class="alert-danger">Внимание!!!</span> Не используйте в именах документов кавычки</p>
                        <form method="POST" action="/admin/adddocument" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{ $object->id }}" name="id" />
                            <input type="file" name="document" />
                            Имя: <input type="text" class="form-control" style="margin-bottom: 0;" name="documentname" />
                            <button type="submit" class="btn btn-default">Отправить</button>
                            @if($errors->first('name'))<p class="help-block" style="color: #f00;">{{ $errors->first('name') }}</p> @endif
                        </form>
                    </div>

                    {{--
                    <span class="btn btn-success fileinput-button">
                        <i class="glyphicon glyphicon-plus"></i>
                        <span>Выберите изображения...</span>
                        <!-- The file input field used as target for the file upload widget -->
                        <input id="fileupload" type="file" name="photos[]" multiple>
                    </span>
                    --}}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('addscript')
    <script>
        var object_id = {{ $object->id }};
    </script>
    <script src="/adm/assets/jui/jquery.ui.touch-punch.min.js"></script>
    <script src="/adm/file-upload/js/vendor/jquery.ui.widget.js"></script>
    <script src="/adm/file-upload/js/jquery.iframe-transport.js"></script>
    <script src="/adm/file-upload/js/jquery.fileupload.js"></script>
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="/adm/magnific/dist/jquery.magnific-popup.min.js"></script>
    <script src="/adm/js/addobject.js?v={{ config('app.script_version') }}"></script>

    <script>
        $(document).ready(function(){
            $('.j-magnific-a').magnificPopup({type:'image'});
        });
    </script>
@endsection