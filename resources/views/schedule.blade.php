@extends('layout')
@section('content')

<div class="container pt-4">

  <div class="card">
    <div class="card-header">
      <h3>一覧</h3>
    </div>
    <div class="card-body">
      <ul>
        @foreach($schedules as $schedule)
        <li>
          <a href="{{ route('schedule.detail', ['id'=>$schedule['data_id']]) }}">
            {{$schedule['date']}}
          </a>
        </li>
        @endforeach
      </ul>
    </div>
  </div>



  @endsection
