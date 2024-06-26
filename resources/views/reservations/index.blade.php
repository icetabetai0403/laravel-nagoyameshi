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
        @php
            $reservationTime = \Carbon\Carbon::parse($reservation->reservation_date . ' ' . $reservation->reservation_time);
            $now = \Carbon\Carbon::now();
            $isFutureReservation = $reservationTime > $now;
        @endphp
        <tr>
            <td>
                <a href="{{ route('stores.show', $reservation->store->id) }}">
                    @if ($reservation->store->image)
                    <img src="{{ asset($reservation->store->image) }}" class="img-thumbnail" style="max-width: 100px;">
                    @else
                    <img src="{{ asset('img/dummy.png') }}" class="img-thumbnail" style="max-width: 100px;">
                    @endif
                </a>
            </td>
            <td><p class="h3">{{ $reservation->store->name }}</p></td>
            <td>{{ $reservation->reservation_date }}</td>
            <td>{{ $reservation->formatted_reservation_time }}</td>
            <td>{{ $reservation->reservation_people_number }}名</td>
            <td>
                <a href="{{ route('reservations.show',$reservation->id) }}" class="btn btn-primary">予約詳細</a>
                @if ($isFutureReservation)
                <a href="{{ route('reservations.edit',$reservation->id) }}" class="btn btn-success">予約変更</a>
                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">キャンセル</button>
                    @endif
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
