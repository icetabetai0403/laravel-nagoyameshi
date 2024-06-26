@extends('layouts.app')

@section('content')
<div>
    <h2>予約変更</h2>
</div>
<div>
    <a href="{{ route('reservations.index') }}">Back</a>
</div>

<form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <strong>予約日:</strong>
        <select name="reservation_date" id="reservation_date">
        @foreach ($dates as $date)
            <option value="{{ $date }}" {{ $date == $reservation->reservation_date ? 'selected' : '' }}>{{ $date }}</option>
        @endforeach
        </select>
    </div>
    <div>
        <strong>予約時間:</strong>
        <select name="reservation_time" id="reservation_time">
        @foreach ($times as $time)
            <option value="{{ $time }}" {{ $time == $reservation->formatted_reservation_time ? 'selected' : '' }}>{{ $time }}</option>
        @endforeach
        </select>
    </div>
    <div>
        <strong>予約人数:</strong>
        <select name="reservation_people_number" id="reservation_people_number">
        @foreach ($peopleNumbers as $number)
            <option value="{{ $number }}" {{ $number == $reservation->reservation_people_number ? 'selected' : '' }}>{{ $number }}名</option>
        @endforeach
        </select>
    </div>
    <input type="hidden" name="store_id" value="{{ $reservation->store_id }}">
    <div>
        <button type="submit">変更</button>
    </div>

</form>
@endsection