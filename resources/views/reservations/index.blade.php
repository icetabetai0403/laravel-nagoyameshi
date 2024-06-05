@extends('layouts.app')

@section('content')
<table class="table">
    <thead>
        <tr>
            <th></th>
            <th>店舗名</th>
            <th>予約日</th>
            <th>予約時間</th>
            <th>予約人数</th>
            <th>操作</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($reservations as $reservation)
        <tr>
            <td>
                <a href="{{ route('stores.show', $reservation->store->id) }}">
                    <img src="{{ asset('img/dummy.png') }}" class="img-thumbnail" style="max-width: 100px;">
                </a>
            </td>
            <td><p class="h3">{{ $reservation->store->name }}</p></td>
            <td>{{ $reservation->reservation_date }}</td>
            <td>{{ $reservation->reservation_time }}</td>
            <td>{{ $reservation->reservation_people_number }}名</td>
            <td>
                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST">
                    <a href="{{ route('reservations.show',$reservation->id) }}" class="btn btn-primary">予約詳細</a>
                    <a href="{{ route('reservations.edit',$reservation->id) }}" class="btn btn-success">予約変更</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">キャンセル</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
