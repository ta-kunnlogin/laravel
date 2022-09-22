@extends('layout')
@section('content')
<main class="py-4">
  <div class="col-md-5 mx-auto">
    <div class="card">
      <div class="card-header">
        <h4 class='text-center'>チーム作成</h1>
      </div>
      <div class="card-body">
        <div class="panel-body">
          @if($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach($errors->all() as $message)
              <li>{{ $message }}</li>
              @endforeach
            </ul>
          </div>
          @endif
        </div>
        <div class="card-body">
          <form action="" method="post">
            @csrf
            <label for='group_name' class='mt-2'>チーム名</label>
            <input type='group_name' class='form-control' name='group_name' id='group_name' />
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
