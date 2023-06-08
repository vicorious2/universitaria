<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <!-- Custom styles for this template -->
    <link href="{{ asset('asset/css/simple-sidebar.css') }}" rel="stylesheet">

    <title>IUDC</title>
  </head>
  <body>
    {{-- header --}}
    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="bg-light border-right" id="sidebar-wrapper">
          <div class="sidebar-heading" style="text-align: center;"> 
            <a href="{{ url('/') }}" style="text-decoration:none;">
              <img src="{{ asset('asset/img/logo.png') }}" style="cursor: pointer; width: 120px;" >
            </a>
          </div>
          @auth
          <div class="list-group">
            <!-- Parametrizacion -->
            @if (Auth::user()->id_tipo_usuario == 1)  <a href="{{ url('usuario') }}" class="list-group-item list-group-item-action list-group-item">GESTION USUARIOS</a> @endif
            <a href="{{ url('curso') }}" class="list-group-item list-group-item-action list-group-item">GESTION CURSOS</a>
            <a href="{{ url('clase') }}" class="list-group-item list-group-item-action list-group-item">GESTION CLASES</a>
          </div>

          @if (Auth::user()->id_tipo_usuario == 1)              
          <div class="accordion" id="accordionExample" style="width: 15rem;">
            <div class="card">
              <div class="card-header" id="headingOne">
                <h2 class="mb-0">
                  <button class="btn btn-link btn-block text-left font-weight-bold" type="button" data-toggle="collapse" 
                   data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                    PARAMETROS
                  </button>
                </h2>
              </div>

              <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                <div class="">
                  <!-- Parametrizacion -->
                  <a href="{{ url('estado') }}" class="list-group-item list-group-item-action list-group-item">ESTADO</a>
                  <a href="{{ url('categoria') }}" class="list-group-item list-group-item-action list-group-item">CATEGORIA</a>
                  <a href="{{ url('facultad') }}" class="list-group-item list-group-item-action list-group-item">FACULTAD</a>
                  <a href="{{ url('nivel') }}" class="list-group-item list-group-item-action list-group-item">NIVEL</a>
                  <a href="{{ url('tipoDoc') }}" class="list-group-item list-group-item-action list-group-item">TIPO DOCUMENTO</a>
                  <a href="{{ url('tipoRecurso') }}" class="list-group-item list-group-item-action list-group-item">TIPO RECURSO</a>
                  <a href="{{ url('tipoUsuario') }}" class="list-group-item list-group-item-action list-group-item">TIPOS USUARIO</a>
                </div>
              </div>
            </div>
          </div>
          @endif
        @endauth

        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

          <nav class="navbar navbar-light bg-light justify-content-between border-bottom">
            @guest
            <br>
            @endguest
            @auth   
            <a class="btn btn-primary" id="menu-toggle">Menu</a>
            <form class="form-inline " method="post" action="/logoutAdmin">
              @csrf
                <span class="navbar-text mr-3 font-weight-bold text-capitalize">
                  {{ Auth::user()->nombre }}
                </span>
                <button class="btn btn-outline-danger my-2 my-sm-0" type="submit">Cerrar Sesión</button>
              
            </form>
          @endauth
          </nav>


          <div class="container-fluid">
            @auth
              <h1 class="mt-4"> @yield('title') </h1>
            @endauth
            @if(Session::has('Mensaje'))
            <div id="divMensajes" role="alert" class="alert alert-info">
                {{ Session::get('Mensaje') }}
            </div>
            @endif

            @if (count($errors) > 0)
              @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
              @endforeach           
            @endif

            @if(isset($home))
             @include('welcome')
            @endif
            @auth
              @yield('content')
            @endauth
          </div>

        <!-- Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">@yield('titleModal')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    @yield('contentModal')
                </div>
                <div class="modal-footer">
                </div>
            </div>
            </div>
        </div>
        {{-- Info --}}
        <div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="exampleModalLabelInfo" aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered modal-lg" >
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabelInfo">@yield('titleModalInfo')</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body">
                    @yield('contentModalInfo')
                </div>
                <div class="modal-footer">
                </div>
            </div>
            </div>
        </div>
        <!-- Modal -->


        </div>
        <!-- /#page-content-wrapper -->

      </div>
      <!-- /#wrapper -->


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    @stack('scripts')
      <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
    $(document).ready( function () {
        setTimeout(function() {
            $("#divMensajes").alert('close');
        },3000);
    });
  </script>

  </body>
</html>
