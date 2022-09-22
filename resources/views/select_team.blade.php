@extends('layout')
@section('content')



<table>
  <tr>
    <th>詳細</th>
    <th>名前</th>
    <th>チーム</th>
  </tr>
  @foreach($users as $user)
  <tr>
    <td>{{$user['id']}}</td>
    <td>{{$user['name']}}</td>
    <td>{{$user['group_name']}}</td>
    <td><a href="{{ route('add.team', ['id'=>$user['id']]) }}">チーム登録</a></td>
  </tr>
  @endforeach
</table>


@endsection
