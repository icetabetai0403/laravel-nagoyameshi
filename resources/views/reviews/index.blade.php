@extends('layouts.app')

@section('content')
    @foreach ($reviews as $review)
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('stores.show', $review->store->id) }}"><img src="{{ asset('img/dummy.png') }}" class="img-fluid"></a>
            </div>
            <div class="col-md-8">
                <p class="h3">{{ $review->store->name }}</p>
                <h3 class="review-score-color">{{ str_repeat('★', $review->score) }}</h3>
                <p class="h3">{{ $review->title }}</p>
                <p class="h3">{{ $review->content }}</p>
                <label>{{ $review->created_at }} {{ $review->user->name }}</label><br>
                <form action="{{ route('reviews.destroy', $review->id) }}" method="POST">
                    <a href="{{ route('reviews.edit',$review->id) }}">編集</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit">削除</button>
                </form>
            </div>
        </div>
    </div>
    @endforeach
@endsection
