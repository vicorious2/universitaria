<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>IUDC</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 70vh;
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
                font-size: 50px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
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
            <div class="content">
                <div class="title m-b-md">
                    IUDC CURSOS ADMIN
                </div>
                
                <div>
                @guest
                    <form action="/loginAdmin" method="post" >
                    @csrf
                        <div class="form-group row">
                            <label for="correo" class="col-sm-2 col-form-label font-weight-bold">Correo</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="correo" id="correo" placeholder="ejemplo@example.com" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-sm-2 col-form-label font-weight-bold">Contraseña</label>
                            <div class="col-sm-10">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Contraseña" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-success btn-sm btn-block" >Ingresar</button>
                    </form>
                @endguest
                </div>
            </div>
        </div>
    </body>
</html>
