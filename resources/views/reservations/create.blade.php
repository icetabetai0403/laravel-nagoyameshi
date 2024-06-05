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
        @php
            $startDate = now(); // 今日の日付を取得
            $endDate = now()->addWeeks(3); // 3週間後の日付を取得

            // 今日から3週間後までの日付を生成して配列に格納
            $dates = [];
            while ($startDate <= $endDate) {
                $dates[] = $startDate->format('Y-m-d');
                $startDate->addDay(); // 日付を1日進める
            }
        @endphp

        @foreach ($dates as $date)
            <option value="{{ $date }}">{{ $date }}</option>
        @endforeach
        </select>
    </div>
    <div>
        <strong>予約時間:</strong>
        <select name="reservation_time" id="reservation_time">
        @for ($hour = 10; $hour <= 22; $hour++)
          @for ($minute = 0; $minute < 60; $minute += 60) {{-- 1時間刻み --}}
            @php
                $time = sprintf('%02d:%02d', $hour, $minute);
            @endphp
            <option value="{{ $time }}">{{ $time }}</option>
            @endfor
        @endfor
        </select>
    </div>
    <div>
        <strong>予約人数:</strong>
        <select name="reservation_people_number" id="reservation_people_number">
        @for ($num = 1; $num <= 30; $num++)
            <option value="{{ $num }}">{{ $num }}名</option>
        @endfor
        </select>
    </div>
    <input type="hidden" name="store_id" value="{{$store_id}}">
    <div>
        <button type="submit">Submit</button>
    </div>

</form>
@endsection