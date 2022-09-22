@extends('layout')
@section('content')

<div class="container">
  <div class="d-flex justify-content-end mt-3">
    @can('coach')
    <a href="{{route ('delete.schedule',['id'=>$schedule[0]['data_id']])}}">
      <button class=" btn btn-danger mr-3">削除</button>
    </a>
    <!-- <a href="{{route ('edit.schedule',['id'=>$schedule[0]['data_id']])}}">
      <button class=" btn btn-secondary">編集</button>
    </a> -->
    @endcan
  </div>
  <h3 class="text-center">{{$schedule[0]['date']}}</h3>
  <div class="card">
    <iframe src="{{ asset($menu)}}" height="1000px">
  </div>
</div>


@endsection
