@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-center">
    <div class="row w-75">
        <div class="col-5 offset-1">
        @if ($store->image)
            <img src="{{ asset($store->image) }}" class="w-100 img-fluid">
            @else
            <img src="{{ asset('img/dummy.png')}}" class="w-100 img-fluid">
            @endif
        </div>
        <div class="col">
            <div class="d-flex flex-column">
                <h1 class="">
                    {{$store->name}}
                </h1>
                @if ($store->reviews()->exists())
                    <p>
                        <span class="nagoyameshi-star-rating" data-rate="{{ round($store->reviews->avg('score') * 2) / 2 }}"></span>
                        {{ round($store->reviews->avg('score'), 1) }}
                    </p>
                @endif
                <p class="">
                    {{$store->description}}
                </p>
                <hr>
                <p class="d-flex align-items-end">
                    ￥{{$store->price}}(税込)
                </p>
                <hr>
            </div>
            @auth
            <form method="POST" class="m-3 align-items-end">
                @csrf
                <input type="hidden" name="id" value="{{$store->id}}">
                <input type="hidden" name="name" value="{{$store->name}}">
                <input type="hidden" name="price" value="{{$store->price}}">
                <input type="hidden" name="weight" value="0">
                <div class="row">

                    <div class="col-5">
                    @if(Auth::user()->favorite_stores()->where('store_id', $store->id)->exists())
                        <a href="{{ route('favorites.destroy', $store->id) }}" class="btn nagoyameshi-favorite-button text-favorite w-100" onclick="event.preventDefault(); document.getElementById('favorites-destroy-form').submit();">
                            <i class="fa fa-heart"></i>
                            お気に入り解除
                        </a>
                    @else
                        <a href="{{ route('favorites.store', $store->id) }}" class="btn nagoyameshi-favorite-button text-favorite w-100" onclick="event.preventDefault(); document.getElementById('favorites-store-form').submit();">
                            <i class="fa fa-heart"></i>
                            お気に入り
                        </a>
                    @endif
                    </div>
                </div>
            </form>
            <div class="col-7">
                        <a href="{{ route('reservations.create', ['store_id' => $store->id]) }}" class="nagoyameshi-favorite-reservation"><i class="fas fa-shopping-cart"></i>予約</a>
                    </div>
            <form id="favorites-destroy-form" action="{{ route('favorites.destroy', $store->id) }}" method="POST" class="d-none">
                @csrf
                @method('DELETE')
            </form>
            <form id="favorites-store-form" action="{{ route('favorites.store', $store->id) }}" method="POST" class="d-none">
                @csrf
            </form>
            @endauth
        </div>

        <div class="offset-1 col-11">
            <hr class="w-100">
            <h3 class="float-left">カスタマーレビュー</h3>
            @if ($store->reviews()->exists())
                <p>
                    <span class="nagoyameshi-star-rating" data-rate="{{ round($store->reviews->avg('score') * 2) / 2 }}"></span>
                    {{ round($store->reviews->avg('score'), 1) }}
                </p>
            @endif
        </div>

        <div class="offset-1 col-10">
        <div class="row">
                @foreach($reviews as $review)
                <div class="offset-md-5 col-md-5">
                    <h3 class="review-score-color">{{ str_repeat('★', $review->score) }}</h3>
                    <p class="h3">{{ $review->title }}</p>
                    <p class="h3">{{$review->content}}</p>
                    <label>{{$review->created_at}} {{$review->user->name}}</label>
                </div>
                @endforeach
            </div><br />

            @auth
            <div class="row">
                <div class="offset-md-5 col-md-5">
                    <form method="POST" action="{{ route('reviews.store') }}">
                        @csrf
                        <h4>評価</h4>
                            <select name="score" class="form-control m-2 review-score-color">
                                <option value="5" class="review-score-color">★★★★★</option>
                                <option value="4" class="review-score-color">★★★★</option>
                                <option value="3" class="review-score-color">★★★</option>
                                <option value="2" class="review-score-color">★★</option>
                                <option value="1" class="review-score-color">★</option>
                            </select>
                        <h4>タイトル</h4>
                        @error('title')
                            <strong>タイトルを入力してください</strong>
                        @enderror
                        <input type="text" name="title" class="form-control m-2">
                        <h4>レビュー内容</h4>
                        @error('content')
                            <strong>レビュー内容を入力してください</strong>
                        @enderror
                        <textarea name="content" class="form-control m-2"></textarea>
                        <input type="hidden" name="store_id" value="{{$store->id}}">
                        <button type="submit" class="btn nagoyameshi-submit-button ml-2">レビューを追加</button>
                    </form>
                </div>
            </div>
            @endauth
        </div>
    </div>
</div>
@endsection