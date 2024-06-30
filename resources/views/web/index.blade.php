@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-lg-2">
            @component('components.sidebar', ['categories' => $categories])
            @endcomponent
        </div>
        <div class="col-md-9 col-lg-10">
            <h1>おすすめ店舗</h1>
            <div class="row">
            @foreach ($recommend_stores as $recommend_store)
                <div class="col-md-4 mb-4">
                    <a href="{{ route('stores.show', $recommend_store) }}" class="store-link">
                        @if ($recommend_store->image !== "")
                        <img src="{{ asset($recommend_store->image) }}" class="img-thumbnail recommend-store-image" alt="{{ $recommend_store->name }}">
                        @else
                        <img src="{{ asset('img/dummy.png')}}" class="img-thumbnail recommend-store-image" alt="{{ $recommend_store->name }}">
                        @endif
                        <div class="mt-2">
                            <p class="nagoyameshi-store-label-link">
                                {{ $recommend_store->name }}<br>
                            </p>
                        </div>
                    </a>
                    <div>
                        <p class="nagoyameshi-store-label">
                            @if ($recommend_store->reviews()->exists())
                                <span class="nagoyameshi-star-rating" data-rate="{{ round($recommend_store->reviews->avg('score') * 2) / 2 }}"></span>
                                <span>{{ round($recommend_store->reviews->avg('score'), 1) }}</span><br>
                            @endif
                            <label>￥{{ $recommend_store->price }}</label>
                        </p>
                    </div>
                </div>
            @endforeach
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h1>新着店舗</h1>
                <a href="{{ route('stores.index', ['sort' => 'id', 'direction' => 'desc']) }}" class="btn btn-link">もっと見る</a>
            </div>
            <div class="row">
                @foreach ($recently_stores as $recently_store)
                <div class="col-md-3 mb-4">
                    <a href="{{ route('stores.show', $recently_store) }}" class="store-link">
                        @if ($recently_store->image !== "")
                        <img src="{{ asset($recently_store->image) }}" class="img-thumbnail new-store-image" alt="{{ $recently_store->name }}">
                        @else
                        <img src="{{ asset('img/dummy.png') }}" class="img-thumbnail new-store-image" alt="{{ $recently_store->name }}">
                        @endif
                        <div class="mt-2">
                            <p class="nagoyameshi-store-label-link">
                                {{ $recently_store->name }}<br>
                            </p>
                        </div>
                    </a>
                    <div>
                        <p class="nagoyameshi-store-label">
                            @if ($recently_store->reviews()->exists())
                                <span class="nagoyameshi-star-rating" data-rate="{{ round($recently_store->reviews->avg('score') * 2) / 2 }}"></span>
                                <span>{{ round($recently_store->reviews->avg('score'), 1) }}</span><br>
                            @endif
                            <label>￥{{ $recently_store->price }}</label>
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
