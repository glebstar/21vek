@extends('layout.main')

@section('addtitle')
    {{ $title }}
@endsection

@section('content')
<div class="row marketing idx-object">
    <div class="filters">
        <form action="{{ Request::path() }}">
            <div class="input-group">
                <label for="area">Район:</label>
                <select id="area" name="area">
                    <option value="0" @if(!$area)selected @endif>Показать все</option>
                    <option value="1" @if(1 == $area)selected @endif>Железнодорожный</option>
                    <option value="2" @if(2 == $area)selected @endif>Советский</option>
                    <option value="3" @if(3 == $area)selected @endif>Октябрьский</option>
                </select>
            </div>
            @if(Request::path() == 'prodaja-kvartir-v-ulan-ude' || Request::path() == '/')
            <div class="input-group">
                <label for="rooms">Комнат:</label>
                <select id="rooms" name="rooms">
                    <option value="0" @if(!$rooms)selected @endif>Показать все</option>
                    <option value="1" @if(1 == $rooms)selected @endif>1</option>
                    <option value="2" @if(2 == $rooms)selected @endif>2</option>
                    <option value="3" @if(3 == $rooms)selected @endif>3</option>
                    <option value="4" @if(4 == $rooms)selected @endif>4 и более</option>
                </select>
            </div>
            @endif
            <div class="input-group">
                <button class="btn btn-default" type="submit">Применить</button>
            </div>
        </form>
    </div>
    <div style="clear: both"></div>
    @foreach($objects as $key=>$object)
        @if($key == 0)
            <div class="col-lg-6">
        @endif
                @if($object->category == 'квартира')
                <h4><a href="{{ $object->getUrl() }}">{{ $object->rooms }}-к квартира, {{ number_format($object->price, 0, '.', ' ') }} руб.</a></h4>
                <a href="{{ $object->getUrl() }}">@if(!$object->image_name)<img src="/img/no-image.png" />@else <img src="/photo/{{ $object->id }}/{{ $object->image_name }}" /> @endif</a>
                <p class="obj-desc">{{ $object->sub_locality_name }}, {{ $object->address }}, {{ $object->area }} кв.м., {{ $object->floor }}/{{ $object->floors_total }}</p>
                @endif

                @if($object->category == 'дом')
                    <h4><a href="{{ $object->getUrl() }}">Продаю {{ $object->floors_total }}-эт дом, {{ number_format($object->price, 0, '.', ' ') }} руб.</a></h4>
                    <a href="{{ $object->getUrl() }}">@if(!$object->image_name)<img src="/img/no-image.png" />@else <img src="/photo/{{ $object->id }}/{{ $object->image_name }}" /> @endif</a>
                    <p class="obj-desc">{{ $object->sub_locality_name }}, {{ $object->address }}, {{ $object->area }} кв.м.</p>
                @endif

                @if($object->category == 'комната')
                    <h4><a href="{{ $object->getUrl() }}">Продаю комнату, {{ number_format($object->price, 0, '.', ' ') }} руб.</a></h4>
                    <a href="{{ $object->getUrl() }}">@if(!$object->image_name)<img src="/img/no-image.png" />@else <img src="/photo/{{ $object->id }}/{{ $object->image_name }}" /> @endif</a>
                    <p class="obj-desc">{{ $object->sub_locality_name }}, {{ $object->address }}, {{ $object->area }} кв.м., {{ $object->floor }}/{{ $object->floors_total }}</p>
                @endif

                @if($object->category == 'участок')
                    <h4><a href="{{ $object->getUrl() }}">Продаю участок, {{ number_format($object->price, 0, '.', ' ') }} руб.</a></h4>
                    <a href="{{ $object->getUrl() }}">@if(!$object->image_name)<img src="/img/no-image.png" />@else <img src="/photo/{{ $object->id }}/{{ $object->image_name }}" /> @endif</a>
                    <p class="obj-desc">{{ $object->sub_locality_name }}, {{ $object->address }}, {{ $object->lot_area }} соток</p>
                @endif

                @if($key != 3 && $key != count($objects)-1)
                <hr />
                @endif
        @if($key == 3)
            </div>
            <div class="col-lg-6">
        @endif

        @if($key == count($objects)-1)
            </div>
        @endif
    @endforeach
</div>


{{ $objects->links() }}
@endsection