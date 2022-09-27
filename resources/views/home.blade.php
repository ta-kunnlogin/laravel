@extends('layout')
@section('content')

@can('player')
<main class="py-4">
  <div class="container">
    <div class="alert alert-dark" role="alert">
      <p>お知らせ</p>
      @foreach($alerts as $alert)
      <table>
        <tr>
          <th>{{$alert['date']}} : {{$alert['comment']}}</th>
        </tr>
      </table>
      @endforeach
    </div>

    <h3>チーム名：{{$team}}</h3>
    @if($noTeam == 1)
    <a href="{{route ('add.team',['id'=>$user['id']])}}">
      <button type="button" class="btn btn-dark">チーム選択</button>
    </a>
    @endif



    <div class="row justify-content-start my-4">
      <a href="{{route ('create.practice')}}">
        <button type="button" class="btn btn-dark">練習登録</button>
      </a>
      <a href="{{route ('create.condition')}}">
        <button type="button" class="btn btn-dark">状態登録</button>
      </a>
      <a href="{{route ('schedule')}}">
        <button type="button" class="btn btn-dark">menu</button>
      </a>
    </div>

    <div class=" mb-4">
      <div class="">
        <div class='d-flex justify-content-between'>
          <a href="{{date('Y-m', strtotime($nowMonth . '-1 m'))}}"> ＜＜前月</a>
          <a> {{$nowMonth}}</a>
          <a href="{{date('Y-m', strtotime($nowMonth . '1 month'))}}">来月＞＞</a>
        </div>
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
                <th scope="col"><a href="{{ route('practice.detail', ['id'=>$practice['practice_id']]) }}">#</a></th>
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
@endcan



@can('coach')
<main class="py-4">
  <div class="container">
    <div class="alert alert-dark" role="alert">
      <p>お知らせ</p>
      @foreach($alerts as $alert)
      <table>
        <tr>
          <th>{{$alert['date']}} : {{$alert['comment']}}</th>
        </tr>
      </table>
      @endforeach
    </div>
    <div class="row justify-content-start my-4">
      <a href="{{route ('schedule')}}">
        <button type="button" class="btn btn-dark">menu</button>
      </a>
      <a href="{{route ('create.event')}}">
        <button type="button" class="btn btn-dark">イベント紹介</button>
      </a>
      <a href="{{route ('create.schedule')}}">
        <button type="button" class="btn btn-dark">メニュー表</button>
      </a>
    </div>

    <h3>チーム名：{{$team}}</h3>
    <div id="search">
      {{ Form::text('name', null, ['id' => 'name', 'placeholder' => 'ユーザーを検索する']) }}
      {{ Form::button('取得', ['id'=>'button','type' => 'button']) }}
    </div>
    <div id="text"></div>

    @if($noTeam == 1)
    <a href="{{route ('add.team',['id'=>$user['id']])}}">
      <button type="button" class="btn btn-dark">チーム選択</button>
    </a>
    @endif

    <div class=" mb-4">
      <div class="">
        <div class='d-flex justify-content-between'>
          <a href="{{date('Y-m', strtotime($nowMonth . '-1 m'))}}"> ＜＜前月</a>
          <a> {{$nowMonth}}</a>
          <a href="{{date('Y-m', strtotime($nowMonth . '1 month'))}}">来月＞＞</a>
        </div>
      </div>


      <div id="card" class="card mb-4 mt-4 d-none">
        <div class="card-header">
          <div class='text-center'>トレーニング</div>
        </div>
        <div class="card-body">
          <table class='table'>
            <thead id="header"></thead>
            <tbody id="body"></tbody>
          </table>
        </div>
      </div>



      <div class="card mb-4 mt-4 practice">
        <div class="card-header">
          <div class='text-center'>トレーニング</div>
        </div>
        <div class="card-body">
          <table class='table'>
            <thead>
              <tr>
                <th scope='col'>詳細</th>
                <th scope='col'>選手名</th>
                <th scope='col'>日にち</th>
                <th scope='col'>午前</th>
                <th scope='col'>午後</th>
              </tr>
            </thead>
            <tbody>
              @foreach($groups as $practice)
              <tr>
                <th scope="col"><a href="{{ route('practice.detail', ['id'=>$practice['practice_id']]) }}">#</a></th>
                <th scope="col">{{$practice['name']}}</th>
                <th scope="col">{{$practice['date']}}</th>
                <th scope="col">{{$practice['morning']}}</th>
                <th scope="col">{{$practice['afternoon']}}</th>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      <div class="card condition">
        <div class="card-header">
          <div class='text-center'>状態</div>
        </div>
        <div class="card-body">
          <table class='table'>
            <thead>
              <tr>
                <th scope='col'>名前</th>
                <th scope='col'>詳細</th>
                <th scope='col'>日にち</th>
                <th scope='col'>状態</th>
              </tr>
            </thead>
            <tbody>
              @foreach($conditions_coach as $condition)
              <tr>
                <th scope="col"><a href="{{ route('condition.detail', ['id'=>$condition['id']]) }}">#</a></th>
                <th scope="col">{{$condition['name']}}</th>
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
@endcan

@can('master')
<main class="py-4">
  <div class="container">
    <div class="alert alert-dark" role="alert">
      <p>お知らせ</p>
      @foreach($alerts as $alert)
      <table>
        <tr>
          <th>{{$alert['date']}} : {{$alert['comment']}}</th>
          <th>
            <a href="{{ route('edit.alert', ['id'=>$alert['id']]) }}">
              <button class=" btn">編集</button>
            </a>
            <a href="{{ route('delete.alert', ['id'=>$alert['id']]) }}">
              <button class=" btn">削除</button>
            </a>
          </th>
        </tr>
      </table>
      @endforeach
    </div>
    <div class="row justify-content-start my-4">
      <a href="{{route ('create.practice')}}">
        <button type="button" class="btn btn-dark">練習登録</button>
      </a>
      <a href="{{route ('create.condition')}}">
        <button type="button" class="btn btn-dark">状態登録</button>
      </a>
      <a href="{{route ('schedule')}}">
        <button type="button" class="btn btn-dark">menu</button>
      </a>
      <a href="{{route ('create.event')}}">
        <button type="button" class="btn btn-dark">イベント紹介</button>
      </a>
      <a href="{{route ('create.alert')}}">
        <button type="button" class="btn btn-dark">お知らせ登録</button>
      </a>
      <a href="{{route ('create.schedule')}}">
        <button type="button" class="btn btn-dark">メニュー表</button>
      </a>
      <a href="{{route ('create.team')}}">
        <button type="button" class="btn btn-dark">チームを作成</button>
      </a>
    </div>


    <h3>ユーザー一覧</h3>
    <table class="table w-50">
      <tr>
        <th>詳細</th>
        <th>名前</th>
        <th>チーム名</th>
      </tr>
      @foreach($all_user as $user)
      <tr>
        <td>{{$user['id']}}</td>
        <td>{{$user['name']}}</td>
        <td>{{$user['group_name']}}</td>
      </tr>
      @endforeach
    </table>

  </div>
</main>
@endcan







@endsection
