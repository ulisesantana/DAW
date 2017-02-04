<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>PALABRAS</title>
  </head>


  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

  <style media="screen">
    body {
      background-color: yellowgreen;
      padding-top: 10vh;
    }
    .center {
      display: block;
      margin: 20vh auto;
    }
  </style>


  <body class= "container">
    <div class="row">

      <div class="col-md-6">
        <form action="/convertir/mayusculas" method="get">

          <div class="form-group">
            {{ csrf_field() }}
            <label for="palabra">Palabra</label>
            <input type="text" class="form-control" name="palabra" value="">
            <br>
            <input type="submit" name="convertir" value="CONVERTIR A MAYÚSCULAS">
          </div>

        </form>
      </div>

      <div class="col-md-6">
        <form action="/convertir" method="get">

          <div class="form-group">
            {{ csrf_field() }}
            <label for="palabra">Palabra</label>
            <input type="text" class="form-control" name="palabra" value="">
            <br>
            <input type="submit" name="convertir" value="CONVERTIR A MAYÚSCULAS">
          </div>

        </form>
      </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  </body>
</html>
