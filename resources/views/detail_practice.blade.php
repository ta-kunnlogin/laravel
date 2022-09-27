@extends('layout')
@section('content')

<div class="col-md-6 container mt-5">
  <div class="card">
    <div class="card-header">
      <div class='text-center'>練習詳細</div>
    </div>
    <div class="card-body">
      <div class="card-body">
        <table class="table">
          <tr>
            <th scope="col">日付</th>
            <th scope="col">{{$practice['date']}}</th>
          </tr>
          <tr>
            <th scope="col">午前</th>
            <th scope="col">{{$practice['morning']}}</th>
          </tr>
          <tr>
            <th scope="col">メニュー内容</th>
            <th scope="col">{{$practice['category1']['training']}}</th>
          </tr>
          <tr>
            <th scope="col">午後</th>
            <th scope="col">{{$practice['afternoon']}}</th>
          </tr>
          <tr>
            <th scope="col">メニュー内容</th>
            <th scope="col">{{$practice['category2']['training']}}</th>
          </tr>
          <tr>
            <th scope="col">コメント</th>
            <th scope="col">{{$practice['comment']}}</th>
          </tr>
          <tr>
            <th scope="col">フィードバック</th>
            <th scope="col">{{$practice['feedback']}}</th>
          </tr>
        </table>
      </div>
    </div>
  </div>

  <div class="d-flex justify-content-around mt-3">
    @can('player')
    <a href="{{route ('delete.practice',['id'=>$practice['practice_id']])}}">
      <button class=" btn btn-danger">削除</button>
    </a>
    <a href="{{route ('edit.practice',['id'=>$practice['practice_id']])}}">
      <button class=" btn btn-secondary">編集</button>
    </a>
    @endcan

    @can('coach')
    <a href="{{route ('feedback.practice',['id'=>$practice['practice_id']])}}">
      <button class=" btn btn-secondary">フィードバック作成</button>
    </a>
    @endcan
  </div>

</div>

@endsection
