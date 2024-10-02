<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Listado Departamentos</title>
  </head>
  <body>
    <div class="container">
      <h1>Listado Departamentos</h1>
      
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Departament Code</th>
                <th scope="col">Departament</th>
                <th scope="col">Pais</th>
                <th scope="col">Actions</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($departamentos as $departamento)
                <tr>
                    <th scope="row">{{ $departamento->depa_codi }}</th>
                    <td>{{ $departamento->depa_nomb }}</td>
                    <td>{{ $departamento ->depa_nomb }}</td>
                    <td><span> Actions </span></td>
                  </tr> 
                @endforeach
            </tbody>
          </table>
    </div>
    

  </body>
</html>