@extends('layout')
@section('content')
<main class="py-4">
  <div class="container">
    <div class="row justify-content-start my-4">
      <a href="{{route ('create.practice')}}">
        <button type="button" class="btn btn-primary">練習登録</button>
      </a>
      <a href="{{route ('create.condition')}}">
        <button type="button" class="btn btn-primary">状態登録</button>
      </a>
    </div>

    <div class="card mb-4">
      <div class="card-header">
        <div class='text-center'>トレーニング</div>
      </div>
      <div class="card-body">
        <table class='table'>
          <thead>
            <tr>
              <th scope='col'>詳細</th>
              <th scope='col'>日にち</th>
              <th scope='col'>午前</th>
              <th scope='col'>午後</th>
            </tr>
          </thead>
          <tbody>
            @foreach($practices as $practice)
            <tr>
              <th scope="col"><a href="{{ route('practice.detail', ['id'=>$practice['id']]) }}">#</a></th>
              <th scope="col">{{$practice['user']['name']}}</th>
              <th scope="col">{{$practice['date']}}</th>
              <th scope="col">{{$practice['morning']}}</th>
              <th scope="col">{{$practice['afternoon']}}</th>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <div class='text-center'>状態</div>
      </div>
      <div class="card-body">
        <table class='table'>
          <thead>
            <tr>
              <th scope='col'>詳細</th>
              <th scope='col'>日にち</th>
              <th scope='col'>状態</th>
            </tr>
          </thead>
          <tbody>
            @foreach($conditions as $condition)
            <tr>
              <th scope="col"><a href="{{ route('condition.detail', ['id'=>$condition['id']]) }}">#</a></th>
              <th scope="col">{{$condition['date']}}</th>
              <th scope="col">{{$condition['condition']}}</th>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</main>

@endsection
