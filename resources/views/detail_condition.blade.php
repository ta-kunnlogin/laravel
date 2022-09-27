@extends('layout')
@section('content')

<div class="col-md-6 container mt-5">
  <div class="card">
    <div class="card-header">
      <div class='text-center'>状態詳細</div>
    </div>
    <div class="card-body">
      <table class="table">
        <tr>
          <th scope="col">日付</th>
          <th scope="col">{{$condition['date']}}</th>
        </tr>
        <tr>
          <th scope="col">状態</th>
          <th scope="col">{{$condition['condition']}}</th>
        </tr>
        <tr>
          <th scope="col">コメント</th>
          <th scope="col">{{$condition['comment']}}</th>
        </tr>
        <tr>
          <th scope="col">フィードバック</th>
          <th scope="col">{{$condition['feedback']}}</th>
        </tr>
      </table>
    </div>
  </div>

  <div class="d-flex justify-content-around mt-3">
    @can('player')
    <a href="{{route ('delete.condition',['id'=>$condition['id']])}}">
      <button class=" btn btn-danger">削除</button>
    </a>
    <a href="{{route ('edit.condition',['id'=>$condition['id']])}}">
      <button class=" btn btn-secondary">編集</button>
    </a>
    @endcan

    @can('coach')
    <a href="{{route ('feedback.condition',['id'=>$condition['id']])}}">
      <button class=" btn btn-secondary">フィードバック作成</button>
    </a>
    @endcan
  </div>


  @endsection
