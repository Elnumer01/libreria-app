<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="/css/layout.css">
    <link rel="stylesheet" href="/css/table.css">
    <title>Document</title>
</head>
<body>
    <div class="sidebar">
        <div class="container__img">
            <img src="../../img/logoBook.png" alt="">
        </div>
        <a href="/authors">Autores</a>
        <a href="/books">Libros</a>
        <a href="/users">Usuarios</a>
        <a href="/loans">prestamos</a>
        <a href="{{url('logout')}}">cerrar sesion</a>
      </div>
    <div class="content">
        <div class="content__title">
            @yield('title')
        </div>
        <div class="content__page">
            @yield('container')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
