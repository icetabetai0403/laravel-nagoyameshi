@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center mt-3">
    <div class="w-50"> <!-- w-75 から w-50 に変更 -->
        <h1>お気に入り</h1>

        <hr>

        @foreach ($favorite_stores as $favorite_store)
        <div class="row mb-3 align-items-center"> <!-- mb-4 から mb-3 に変更 -->
            <div class="col-3"> <!-- col-md-2 から col-3 に変更 -->
                <div class="favorite-store-image-wrapper">
                    <a href="{{ route('stores.show', $favorite_store->id) }}">
                        @if ($favorite_store->image !== "")
                            <img src="{{ asset($favorite_store->image) }}" class="favorite-store-image" alt="{{ $favorite_store->name }}">
                        @else
                            <img src="{{ asset('img/dummy.png') }}" class="favorite-store-image" alt="dummy image">
                        @endif
                    </a>
                </div>
            </div>
            <div class="col-4"> <!-- col-md-4 から col-4 に変更 -->
                <a href="{{ route('stores.show', $favorite_store->id) }}" class="nagoyameshi-favorite-item-text h6 text-decoration-none">{{ $favorite_store->name }}</a>
                @if ($favorite_store->reviews()->exists())
                    <div class="favorite-store-rating">
                        <span class="nagoyameshi-star-rating" data-rate="{{ round($favorite_store->reviews->avg('score') * 2) / 2 }}"></span>
                        <span class="ml-2 small">{{ round($favorite_store->reviews->avg('score'), 1) }}</span>
                    </div>
                @endif
            </div>
            <div class="col-2"> <!-- col-md-3 から col-2 に変更 -->
                <p class="nagoyameshi-favorite-item-text small mb-0">{{ $favorite_store->price }}</p>
            </div>
            <div class="col-3 d-flex justify-content-end"> <!-- col-md-3 から col-3 に変更 -->
                <a href="{{ route('reservations.create', $favorite_store->id) }}" class="btn nagoyameshi-favorite-button btn-sm mr-1">予約</a> <!-- mr-2 から mr-1 に変更 -->
                <a href="{{ route('favorites.destroy', $favorite_store->id) }}" class="btn nagoyameshi-btn-danger btn-sm" onclick="event.preventDefault(); document.getElementById('favorites-destroy-form{{$favorite_store->id}}').submit();">
                    削除
                </a>
                <form id="favorites-destroy-form{{$favorite_store->id}}" action="{{ route('favorites.destroy', $favorite_store->id) }}" method="POST" class="d-none">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>
        @endforeach

        <hr>
        <div class="d-flex justify-content-center">
            {{ $favorite_stores->links() }}
        </div>
    </div>
</div>
@endsection