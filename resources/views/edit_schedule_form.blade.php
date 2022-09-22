@extends('layout')
@section('content')
<main class="py-4">
  <div class="col-md-5 mx-auto">
    <div class="card">
      <div class="card-header">
        <h4 class='text-center'>menu</h4>
      </div>
      <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
          @csrf
          <label for='date' class='mt-2'>日付</label>
          <input type='month' class='form-control' name='date' id='date' value="">

          <label for='schedule' class='mt-2'>日付</label>
          <input type="file" class='form-control' name="schedule" id=schedule>

          <div class='row justify-content-center'>
            <button type='submit' class='btn btn-dark w-25 mt-3'>登録</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</main>

@endsection
