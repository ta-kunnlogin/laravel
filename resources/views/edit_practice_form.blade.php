@extends('layout')
@section('content')
<main class="py-4">
  <div class="col-md-5 mx-auto">
    <div class="card">
      <div class="card-header">
        <h4 class='text-center'>練習編集</h1>
      </div>
      <div class="card-body">
        <div class="card-body">
          <form action="" method="post">
            @csrf
            <label for='date' class='mt-2'>日付</label>
            <input type='date' class='form-control' name='date' id='date' />

            <label for='morning' class='mt-2'>午前</label>
            <input type='morning' class='form-control' name='morning' id='morning' />

            <label for='category' class='mt-2'>カテゴリ</label>
            <select name='type_id_1' class='form-control'>
              <option value='' hidden>カテゴリ</option>
              @foreach($categories as $category)
              <option value="{{$category['id']}}">{{$category['name']}}</option>
              @endforeach
            </select>
            <a href="{{ route ('create.category')}}">カテゴリ追加</a>
            </br>

            <label for='afternoon' class='mt-2'>午後</label>
            <input type='afternoon' class='form-control' name='afternoon' id='afternoon' />

            <label for='category' class='mt-2'>カテゴリ</label>
            <select name='type_id_2' class='form-control'>
              <option value='' hidden>カテゴリ</option>
              @foreach($categories as $category)
              <option value="{{$category['id']}}">{{$category['name']}}</option>
              @endforeach
            </select>
            <a href="{{ route ('create.category')}}">カテゴリ追加</a>
            </br>

            <label for='image' class='mt-2'>画像</label>
            <input type='text' class='form-control' name='image' id='image' />

            <label for='comment' class='mt-2'>メモ</label>
            <textarea class='form-control' name='comment'></textarea>
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
