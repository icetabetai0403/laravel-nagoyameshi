@extends('layouts.app')

@section('content')
<div>
    <h2>Add New reservation</h2>
</div>
<div>
    <a href="{{ route('reservations.index') }}">Back</a>
</div>

<form action="{{ route('reservations.store', ['store_id' => $store_id]) }}" method="POST">
    @csrf

    <div>
        <strong>予約日:</strong>
        <select name="reservation_date" id="reservation_date">
        @foreach ($dates as $date)
            <option value="{{ $date }}">{{ $date }}</option>
        @endforeach
        </select>
    </div>
    <div>
        <strong>予約時間:</strong>
        <select name="reservation_time" id="reservation_time">
        @foreach ($times as $time)
            <option value="{{ $time }}">{{ $time }}</option>
        @endforeach
        </select>
    </div>
    <div>
        <strong>予約人数:</strong>
        <select name="reservation_people_number" id="reservation_people_number">
        @foreach ($peopleNumbers as $number)
            <option value="{{ $number }}">{{ $number }}名</option>
        @endforeach
        </select>
    </div>
    <input type="hidden" name="store_id" value="{{$store_id}}">
    <div>
        <button type="submit">Submit</button>
    </div>

</form>
@endsection