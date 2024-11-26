<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/login.css">
    <title>Login</title>
</head>
<body>
    <div class="container">
        <img class="container__img" src="../../img/logoBook.png" alt="">
        <h2 class="container__title">INICIAR SESION</h2>
        <div class="container__form">
            <form method="POST" action="{{url('session')}}">
                @csrf
                <div class="input-group">
                    <input  required type="text" name="email" autocomplete="off" class="input">
                    <label class="user-label">Email</label>
                    @error('email')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                  </div>
                  <div class="input-group">
                    <input required type="password" name="password" autocomplete="off" class="input">
                    <label class="user-label">Password</label>
                    @error('password')
                        <small class="text-danger">{{$message}}</small>
                    @enderror
                  </div>
                  <button id="login-button" type="submit" class="button">
                    <svg class="svgIcon" viewBox="0 0 384 512">
                      <path d="M214.6 41.4c-12.5-12.5-32.8-12.5-45.3 0l-160 160c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L160 141.2V448c0 17.7 14.3 32 32 32s32-14.3 32-32V141.2L329.4 246.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3l-160-160z"/>
                    </svg>
                  </button>
            </form>
        </div>
    </div>
    @include('components.alerts')
</body>
</html>
