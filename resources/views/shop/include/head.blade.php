<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{$title  ?? 'Главная страница'}}</title>
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="{{asset('css/app.css')}}" type="text/css" rel="stylesheet">
    <script src="{{asset('js/app.js')}}"  type="text/javascript"></script>
    <link href="{{asset('css/styles.css')}}" type="text/css" rel="stylesheet">
</head>
