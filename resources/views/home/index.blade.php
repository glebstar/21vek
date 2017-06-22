@extends('layout.main')

@section('content')
<div class="row marketing">
    <div class="col-lg-6">
        <h4><a href="obj.html">2-к квартира, 2 400 000 р.</a></h4>
        <a href=""><img src="img/1.jpg" /></a>
        <p>Железнодорожный, Гагарина, 37, 48 кв.м., 2/5</p>

        <h4><a href="">2-к квартира, 2 400 000 р.</a></h4>
        <a href=""><img src="img/1.jpg" /></a>
        <p>Железнодорожный, Гагарина, 37</p>

        <h4><a href="">1-к квартира, 1 300 000 р.</a></h4>
        <a href=""><img src="img/2.jpg" /></a>
        <p>Советский, Фрунзе, 15</p>
    </div>

    <div class="col-lg-6">
        <h4><a href="">1-к квартира, 1 300 000 р.</a></h4>
        <a href=""><img src="img/no-image.png" /></a>
        <p>Советский, Фрунзе, 15</p>

        <h4><a href="">2-к квартира, 2 400 000 р.</a></h4>
        <a href=""><img src="img/1.jpg" /></a>
        <p>Железнодорожный, Гагарина, 37</p>

        <h4><a href="">2-к квартира, 2 400 000 р.</a></h4>
        <a href=""><img src="img/1.jpg" /></a>
        <p>Железнодорожный, Гагарина, 37</p>
    </div>
</div>

<ul class="pagination">
    <li>
        <a href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
        </a>
    </li>
    <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li>
    <li>
        <a href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
        </a>
    </li>
</ul>
@endsection