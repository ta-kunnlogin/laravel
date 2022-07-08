@extends('layout')
@section('content')
<main class="py-4">
  <div class="col-md-5 mx-auto">
    <div class="card">
      <div class="card-header">
        <h4 class='text-center'>カテゴリ追加</h1>
      </div>
      <div class="card-body">
        <div class="card-body">
          <form action="" method="post">
            @csrf

            <label for='name' class='mt-2'>カテゴリ名</label>
            <input type='name' class='form-control' name='name' id='name' />

            <div class='row justify-content-center'>
              <button type='submit' class='btn btn-primary w-25 mt-3'>登録</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</main>

@endsection
