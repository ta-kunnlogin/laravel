<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'トレーニング共有') }}</title>

  <!--Scripts -->

  <script src="{{ asset('js/app.js') }}" defer></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script>
    $(function() {
      $('#button').click(function() {
        // $('#button').on('click', function() {
        $('#name').empty(); //もともとある要素を空にする
        $('#card').removeClass('d-none');
        $('.practice').remove();
        $('.condition').remove();



        const name = $('#name').val(); //検索ワードを取得
        $.ajax({
          type: 'get',
          url: '/user/index/',
          //後述するweb.phpのURLと同じ形にする
          data: {
            'name': name
          },
          dataType: 'json', //json形式で受け取る
        }).done(function(response) { //ajaxが成功したときの処理
          console.log(response);

          if (response.length === 0) {
            $('#text').empty();
            $('#text').append('<p class="">ユーザーが見つかりません</p>');
            // // $('#search').move();
            // $('#search').remove();
            $('#header').empty();
            $('#body').empty();
          } else {
            $('#text').empty();
            $('#header').empty();
            $('#body').empty();
            table = `
            <tr>
            <th scope='col'>名前</th>
            <th scope='col'>詳細</th>
            <th scope='col'>日にち</th>
            <th scope='col'>午前</th>
            <th scope='col'>午後</th>
            </tr>
            `;
            message = '';
            $('#header').append(table);
          }

          $.each(response, function(index, value) { //dataの中身からvalueを取り出す
            let name = value.name;
            let date = value.date;
            let morning = value.morning;
            let afternoon = value.afternoon;
            let comment = value.comment;
            let id = '';
            id = value.practice_id;

            message = `
            <tr>
            <th scope="col"><a href="/practice/${id}/detail">#</a></th>
            <th scope="col">${name}</th>
            <th scope="col">${date}</th>
            <th scope="col">${morning}</th>
            <th scope="col">${afternoon}</th>
            </tr>
            `

            $('#body').append(message);
          });

        }).fail(function(err) {
          console.log(err);
          //ajax通信がエラーのときの処理
          alert('どんまい！');
        });
      });
    });
  </script>



  <!-- Fonts -->
  <link rel="dns-prefetch" href="//fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

  <!-- Styles -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  @yield('stylesheet')
</head>

<body>
  <div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
          トレーニング共有
        </a>
      </div>
      <div class="my-navbar-control">
        @if(Auth::check())
        <span class="my-navbar-item">{{Auth::user()->name }}</span>
        <form id="logout-form" action="{{route('logout')}}" method="POST">
          @csrf
          <input type="submit" value="ログアウト">
        </form>
        @else
        <a class="my-navbar-item" href="{{route('login')}}">ログイン</a>
        /
        <a class="my-navbar-item" href="{{route('register')}}">会員登録</a>
        @endif
      </div>
    </nav>
    @yield('content')
  </div>

</body>

</html>
