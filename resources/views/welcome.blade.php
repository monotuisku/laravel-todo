<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
        <style>
        * {
          box-sizing: border-box;
        }
        .l-content {
          max-width: 600px;
          margin: 0 auto;
        }
        #app {
          font-family: 'Avenir', Helvetica, Arial, sans-serif;
          -webkit-font-smoothing: antialiased;
          -moz-osx-font-smoothing: grayscale;
          /* text-align: center; */
          color: #2c3e50;
          margin-top: 60px;
          font-size: 24px;
        }
        .logo {
          display: block;
          margin: 20px auto;
          width: 70px;
        }
        </style>
    </head>
    <body>
      <div id="app" class="l-content">
        <img class ="logo" alt="Vue logo" src="{{ asset('images/logo.png') }}">
        <todo-list></todo-list>
      </div>
    </body>
    <script src=" {{ mix('js/app.js') }} "></script>
</html>
