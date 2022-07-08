@extends('layout')
@section('content')
<main class="py-4">
  <div class="col-md-5 mx-auto">
    <div class="card">
      <div class="card-header">
        <h4 class='text-center'>状態編集</h1>
      </div>
      <div class="card-body">
          <form action="" method="post">
            @csrf
            <label for='date' class='mt-2'>日付</label>
            <input type='date' class='form-control' name='date' id='date'/>

            <label for='condition' class='mt-2'>状態</label>
            <input type='condition' class='form-control' name='condition' id='condition'/>

            <label for='comment' class='mt-2'>メモ</label>
            <textarea class='form-control' name='comment'></textarea>
            <div class='row justify-content-center'>
              <button type='submit' class='btn btn-primary w-25 mt-3'>登録</button>
            </div>
          </form>
        </div>
    </div>
  </div>
</main>

@endsection
