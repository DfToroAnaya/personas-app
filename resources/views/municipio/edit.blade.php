<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Add Municipio</title>
  </head>
  <body>
    <div>
        <h1>Add Municipio</h1>
        <form method="POST" action="{{route('municipios.update', ['municipio' => $municipio->muni_codi])}}">
            @method('put')
            @csrf
            <div class="mb-3">
              <label for="codigo" class="form-label">Id</label>
              <input type="text" class="form-control" id="id" aria-describedby="codigoHelp" name="id"
              disabled="disabled" value="{{ $municipio->muni_codi}}">
              <div id="codigoHelp" class="form-text">Municipality Id</div>
            </div>
            <div class="mb-3">
              <label for="name" class="form-label">Municipality</label>
              <input type="text" class="form-control" id="name" aria-describedby="Municipality Name"
              name="name" value="{{ $municipio->muni_codi}}">
            </div>
            
              <label class="departament">Departament</label>
              <select class="form-select" name="code" id="departament" required>
                <option selected disabled value="">Choose one...</option>
                @foreach ($departamentos as $departamento)
                @if ($departamento->depa_codi  == $municipio->depa_codi)
                <option selected value="{{$departamento->depa_codi}}">{{$departamento->depa_nomb}}</option>  
                @else
                <option value="{{ $departamento->depa_codi}}">{{ $departamento->depa_codi}}</option>
                @endif                  
                @endforeach
              </select>
              <div class="mt-3">
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('municipios.index')}}" class="btn btn-warning">Cancel</a>
              </div>
          </form>
        </div> 
      </body>
</html>