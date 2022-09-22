@extends('layout')
@section('content')
<main class="py-4">
  <div class="col-md-5 mx-auto">
    <div class="card">
      <div class="card-header">
        <h4 class='text-center'>お知らせ作成</h1>
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
            <label for='date' class='mt-2'>日付</label>
            <input type='date' class='form-control' name='date' id='date' value="{{old('date')}}" />
            <label for='comment' class='mt-2'>コメント</label>
            <textarea class='form-control' name='comment'>{{old('comment')}}</textarea>
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
