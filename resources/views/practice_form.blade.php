@extends('layout')
@section('content')
<main class="py-4">
  <div class="col-md-5 mx-auto">
    <div class="card">
      <div class="card-header">
        <h4 class='text-center'>練習登録</h1>
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

            <label for='morning' class='mt-2'>午前</label>
            <input type='morning' class='form-control' name='morning' id='morning' value="{{old('morning')}}" />

            <label for='category' class='mt-2'>カテゴリ</label>
            <select name='type_id_1' class='form-control' value="">
              <option value="{{old('type_id_1')}}" hidden>カテゴリ</option>
              @foreach($categories as $category)
              <option value=" {{$category['training_id']}}">{{$category['training']}}</option>
              @endforeach
            </select>
            <a href="{{ route ('create.category')}}">カテゴリ追加</a>
            </br>

            <label for='afternoon' class='mt-2'>午後</label>
            <input type='afternoon' class='form-control' name='afternoon' id='afternoon' value="{{old('afternoon')}}" />

            <label for='category' class='mt-2'>カテゴリ</label>
            <select name='type_id_2' class='form-control' value="">
              <option value="{{old('type_id_2')}}" hidden></option>
              @foreach($categories as $category)
              <option value=" {{$category['training_id']}}">{{$category['training']}}</option>
              @endforeach
            </select>
            <a href="{{ route ('create.category')}}">カテゴリ追加</a>
            </br>

            <label for='comment' class='mt-2'>メモ</label>
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
