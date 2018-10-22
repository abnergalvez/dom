<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 20px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    <img src="/img/munilogo.png" alt="" style="height: 140px;"><br>
                    <small>Plan Regulador Comunal</small>
                </div>
                
                <div class="links">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="input-group">
                      <form action="{{ route('seachmap') }}" method="POST">
                       {{ csrf_field() }}
                          <span class="input-group-btn">
                            <button class="btn btn-default" type="submit" title="Buscar por Dirección">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                          </span>
                          <input type="text" class="form-control" placeholder="Ingresa Dirección..." title="Buscar por Dirección">
                        </form>
                    </div><!-- /input-group -->
                  </div><!-- /.col-lg-6 -->
                </div><!-- /.row -->
                </div>
            </div>
        </div>
    </body>
</html>
