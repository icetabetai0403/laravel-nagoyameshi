@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 col-lg-2">
            @component('components.sidebar', ['categories' => $categories])
            @endcomponent
        </div>
        <div class="col-md-9 col-lg-10">
            <div class="container mt-5">
                @if ($category !== null)
                    <a href="{{ route('stores.index') }}">トップ</a> > {{ $category->name }}
                    <h1>{{ $category->name }}の店舗一覧{{$total_count}}件</h1>
                @elseif ($keyword !== null)
                    <a href="{{ route('stores.index') }}">トップ</a> > 店舗一覧
                    <h1>"{{ $keyword }}"の検索結果{{ $total_count }}件</h1>
                @else
                    <h1>店舗一覧</h1>
                @endif
            </div>
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div>
                    Sort By
                    @sortablelink('price', '価格')
                    @sortablelink('score', '評価')
                </div>
            </div>
            <div class="container mt-4">
                <div class="row">
                    @foreach($stores as $store)
                    <div class="col-md-3 mb-4">
                        <a href="{{route('stores.show', $store)}}" class="store-link">
                            @if ($store->image !== "")
                                <img src="{{ asset($store->image) }}" class="img-thumbnail store-image" alt="{{ $store->name }}">
                            @else
                                <img src="{{ asset('img/dummy.png')}}" class="img-thumbnail store-image" alt="{{ $store->name }}">
                            @endif
                            <div class="mt-2">
                                <p class="nagoyameshi-store-label-link">
                                    {{ $store->name }}<br>
                                </p>
                            </div>
                        </a>
                        <div>
                            <p class="nagoyameshi-store-label">
                                @if ($store->reviews()->exists())
                                    <span class="nagoyameshi-star-rating" data-rate="{{ round($store->reviews->avg('score') * 2) / 2 }}"></span>
                                    <span>{{ round($store->reviews->avg('score'), 1) }}</span><br>
                                @endif
                                <label>￥{{ $store->price }}</label>
                            </p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $stores->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
