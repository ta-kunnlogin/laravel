@extends('layout')
@section('content')
<main class="py-4">
  <div class="col-md-5 mx-auto">
    <div class="card">
      <div class="card-header">
        <h4 class='text-center'>チーム登録</h4>
      </div>
      <div class="card-body">
        <form action="" method="post">
          @csrf
          <label for='team_id' class='mt-2'>チーム</label>
          <select name='team_id' class='form-control'>
            <option value='' hidden>カテゴリ</option>

          </select>
          <div class='row justify-content-center'>
            <button type='submit' class='btn btn-dark w-25 mt-3'>登録</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>

@endsection
