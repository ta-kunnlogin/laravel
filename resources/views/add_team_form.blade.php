@extends('layout')
@section('content')
<main class="py-4">
  <div class="col-md-5 mx-auto">
    <div class="card">
      <div class="card-header">
        <h4 class='text-center'>チーム参加</h1>
          <p class="text-start">{{$user['name']}}</p>
      </div>
      <div class="card-body">
        <div class="card-body">
          <form action="" method="post">
            @csrf
            <label for='group_id' class='mt-2'>チーム選択</label>
            <select name='team_num' class='form-control'>
              <option value="" hidden></option>
              @foreach($groups as $group)
              @if($group['group_id'] >= 1)
              <option value="{{$group['group_id']}}">{{$group['group_name']}}</option>
              @endif
              @endforeach
            </select>
            <div class='row justify-content-center'>
              <button type='submit' class='btn btn-dark w-25 mt-3'>登録</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>


@endsection
