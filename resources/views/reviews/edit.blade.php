@extends('layouts.app')

@section('content')
<div>
    <h2>レビュー編集</h2>
</div>
<div>
    <a href="{{ route('reviews.index') }}"> Back</a>
</div>

<form action="{{ route('reviews.update',$review->id) }}" method="POST">
    @csrf
    @method('PUT')

    <h4>評価</h4>
        <select name="score" class="form-control m-2 review-score-color">
            <option value="5" class="review-score-color" {{ $review->score == 5 ? 'selected' : '' }}>★★★★★</option>
            <option value="4" class="review-score-color" {{ $review->score == 4 ? 'selected' : '' }}>★★★★</option>
            <option value="3" class="review-score-color" {{ $review->score == 3 ? 'selected' : '' }}>★★★</option>
            <option value="2" class="review-score-color" {{ $review->score == 2 ? 'selected' : '' }}>★★</option>
            <option value="1" class="review-score-color" {{ $review->score == 1 ? 'selected' : '' }}>★</option>
        </select>
    <h4>タイトル</h4>
        @error('title')
            <strong>タイトルを入力してください</strong>
        @enderror
    <input type="text" name="title" class="form-control m-2" value="{{ old('title', $review->title) }}">
    <h4>レビュー内容</h4>
        @error('content')
            <strong>レビュー内容を入力してください</strong>
        @enderror
    <textarea name="content" class="form-control m-2">{{ old('content', $review->content) }}</textarea>
    <input type="hidden" name="store_id" value="{{ $review->store_id }}">
    <button type="submit" class="btn nagoyameshi-submit-button ml-2">レビューを修正</button>
</form>
@endsection