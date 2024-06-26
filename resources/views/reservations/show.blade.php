@extends('layouts.app')

@section('content')
<div>
    <h2>予約詳細</h2>
</div>
<div>
    <a href="{{ route('reservations.index') }}"> Back</a>
</div>

<div>
    <strong>予約日:</strong>
    {{ $reservation->reservation_date }}
</div>

<div>
    <strong>予約時間:</strong>
    {{ $reservation->formatted_reservation_time }}
</div>

<div>
    <strong>予約人数:</strong>
    {{ $reservation->reservation_people_number }}名
</div>
@endsection