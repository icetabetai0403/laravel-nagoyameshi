@extends('layouts.app')

@section('content')
<div class="container">
    <h1>レビュー一覧</h1>
    <div class="row">
        @foreach ($reviews as $review)
        <div class="col-md-6 mb-4">
            <div class="card">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <a href="{{ route('stores.show', $review->store->id) }}">
                            @if ($review->store->image)
                            <img src="{{ asset($review->store->image) }}" class="card-img review-image" alt="{{ $review->store->name }}">
                            @else
                            <img src="{{ asset('img/dummy.png') }}" class="card-img review-image" alt="ダミー画像">
                            @endif
                        </a>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $review->store->name }}</h5>
                            <h3 class="review-score-color">{{ str_repeat('★', $review->score) }}</h3>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $review->title }}</h6>
                            <p class="card-text review-content">{{ $review->content }}</p>
                            <p class="card-text"><small class="text-muted">{{ $review->created_at->format('Y/m/d') }} by {{ $review->user->name }}</small></p>
                            <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="d-inline">
                                <a href="{{ route('reviews.edit',$review->id) }}" class="btn btn-primary btn-sm">編集</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">削除</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection