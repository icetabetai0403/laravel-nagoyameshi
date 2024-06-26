@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-2">
        @component('components.sidebar', ['categories' => $categories])
        @endcomponent
    </div>
    <div class="col-9">
        <div class="container">
            @if ($category !== null)
                <a href="{{ route('stores.index') }}">トップ</a> > {{ $category->name }}
                <h1>{{ $category->name }}の店舗一覧{{$total_count}}件</h1>
            @elseif ($keyword !== null)
                <a href="{{ route('stores.index') }}">トップ</a> > 店舗一覧
                <h1>"{{ $keyword }}"の検索結果{{ $total_count }}件</h1>
            @endif
        </div>
        <div>
            Sort By
            @sortablelink('price', '価格')
            @sortablelink('score', '評価')
        </div>
        <div class="container mt-4">
            <div class="row w-100">
                @foreach($stores as $store)
                <div class="col-3">
                    <a href="{{route('stores.show', $store)}}">
                    @if ($store->image !== "")
                        <img src="{{ asset($store->image) }}" class="img-thumbnail">
                        @else
                        <img src="{{ asset('img/dummy.png')}}" class="img-thumbnail">
                        @endif
                    </a>
                    <div class="row">
                        <div class="col-12">
                            <p class="nagoyameshi-store-label mt-2">
                                {{$store->name}}<br>
                                @if ($store->reviews()->exists())
                                    <span class="nagoyameshi-star-rating" data-rate="{{ round($store->reviews->avg('score') * 2) / 2 }}"></span>
                                    {{ round($store->reviews->avg('score'), 1) }}<br>
                                @endif
                                <label>￥{{$store->price}}</label>
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        {{ $stores->appends(request()->query())->links() }}
    </div>
</div>
@endsection