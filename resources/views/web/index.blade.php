@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-2">
        @component('components.sidebar', ['categories' => $categories])
        @endcomponent
    </div>
    <div class="col-9">
        <h1>おすすめ商品</h1>
        <div class="row">
        @foreach ($recommend_stores as $recommend_store)
            <div class="col-4">
                <a href="{{ route('stores.show', $recommend_store) }}">
                    @if ($recommend_store->image !== "")
                    <img src="{{ asset($recommend_store->image) }}" class="img-thumbnail">
                    @else
                    <img src="{{ asset('img/dummy.png')}}" class="img-thumbnail">
                    @endif
                </a>
                <div class="row">
                    <div class="col-12">
                        <p class="nagoyameshi-store-label mt-2">
                            {{ $recommend_store->name }}<br>
                            <label>￥{{ $recommend_store->price }}</label>
                        </p>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        <div class="d-flex justify-content-between">
            <h1>新着店舗</h1>
            <a href="{{ route('stores.index', ['sort' => 'id', 'direction' => 'desc']) }}">もっと見る</a>
        </div>
        <div class="row">
            @foreach ($recently_stores as $recently_store)
            <div class="col-3">
                <a href="{{ route('stores.show', $recently_store) }}">
                    @if ($recently_store->image !== "")
                    <img src="{{ asset($recently_store->image) }}" class="img-thumbnail">
                    @else
                    <img src="{{ asset('img/dummy.png') }}" class="img-thumbnail">
                    @endif
                </a>
                <div class="row">
                    <div class="col-12">
                        <p class="nagoyameshi-store-label mt-2">
                            {{ $recently_store->name }}<br>
                            <label>￥{{ $recently_store->price }}</label>
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection