<!DOCTYPE html>
<html lang="es">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Agenda</title>


    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


    <style media="screen">
        @import url('https://fonts.googleapis.com/css?family=Montserrat');
        body {
            background-color: #eee;
            font-family: "Montserrat", sans-serif;
        }

        #profile {
            background-color: #333;
            color: #fff;
            height: 100vh;
            width: 25vw;
            position: fixed;
        }

        #profile img {
            max-width: 150px;
            margin: 20px auto;
        }

        #profile h3 {
            text-align: center;
            padding: 15px;
        }

        #profile li.active{
          background-color: #eee;
        }

        #main {
            width: 73vw;
            padding: 2% 3%;
            margin-left: 24vw;
        }

        .space{padding-top:2%;}
        #buscar,#add,#borrar{
          margin-bottom: 20px;
        }

        .hr{
          border:3px solid #333;
          border-radius: 5px
        }
    </style>
</head>


<body>


    <div id="profile">
        <img src="https://avatars3.githubusercontent.com/u/17091490?v=3&s=466" alt="" class="img-responsive img-circle">
        <h3 class="text-center">Ulises Santana Suárez <br><small>2º DAW</small></h3>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="nav">
            </ul>
        </div>
    </div>


    <div id="main">
      <a class="pull-right lead" href="{{ url('/agenda/logout') }}">Logout</a>
      <h2 class="text-center">Agenda de contactos</h2>
      <form class="form-horizontal" action="/agenda" method="post">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="name" class="col-sm-2 control-label">Nombre: </label>
          <div class="col-sm-5">
            <input type="text" class="form-control"
            id="name" name="name" value="{{ $nombre }}"
            placeholder="Introduce el nombre de tu contacto">
          </div>
        </div>
        <div class="form-group">
          <label for="tlf" class="col-sm-2 control-label">Teléfono: </label>
          <div class="col-sm-5">
            <input type="text" class="form-control"
            id="name" name="tlf" value="{{ $telefono }}"
            placeholder="Introduce el nombre de tu contacto">
          </div>
        </div>
        .<div class="form-group">
          <div class="col-sm-2"></div>
          <div class="col-sm-3">
            <input id="buscar" class="btn btn-info" type="submit" name="buscar" value="BUSCAR">
          </div>
          <div class="col-sm-3">
            <input id="add" class="btn btn-success" type="submit" name="add" value="AÑADIR">
          </div>
        </div>
      </form>
      <div class="hr"></div>
      <p class="space">{{ $mensaje }}</p>
      <table class="table">
        <thead>
          <th>Nombre</th>
          <th>Teléfono</th>
        </thead>
        <tbody>
          @foreach($resultado as $contacto)
           <tr id="{{$contacto->id}}">
             <td>{{$contacto->nombre}}</td>
             <td>{{$contacto->telefono}}</td>
             <td>
               <div class="editar btn btn-warning btn-xs">EDITAR</div>
             </td>
             <td>
               <form action="/agenda" method="post">
                 {{ csrf_field() }}
                 <input type="hidden" name="id"
                        value="{{ $contacto->id }}">
                 <input type="submit" class="btn btn-danger btn-xs"
                        name="borrar" value="BORRAR">
               </form>
             </td>
           </tr>
          @endforeach
        </tbody>
      </table>

      <!-- Modal -->
      <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Editar </h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" action="/agenda" method="post">
                {{ csrf_field() }}
                <div class="form-group">
                  <label for="name" class="col-sm-2 control-label">Nombre: </label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control"
                    id="edit-name" name="name" required
                    placeholder="Introduce el nombre de tu contacto">
                  </div>
                </div>
                <div class="form-group">
                  <label for="tlf" class="col-sm-2 control-label">Teléfono: </label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control"
                    id="edit-tlf" name="tlf" required
                    placeholder="Introduce el nombre de tu contacto">
                  </div>
                  <input id="edit-id" type="hidden" name="id">
                </div>
                <div class="form-group">
                  <div class="col-sm-5"></div>
                  <div class="col-sm-3">
                    <input id="editar" class="btn btn-success" type="submit" name="editar" value="ACTUALIZAR">
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            </div>
          </div>
        </div>
      </div>
    </div><!-- /MAIN -->


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <script type="text/javascript">
      $('.editar').click(function(e){
        var row = e.target.parentNode.parentNode;
        var name = row.childNodes[1].innerHTML;
        var tlf = row.childNodes[3].innerHTML;
        var id = row.id;
        console.log(id);
        $('#edit-name').val(name);
        $('#edit-tlf').val(tlf);
        $('#edit-id').val(id);
        $('#edit-modal').modal();
      });
    </script>
</body>


</html>
