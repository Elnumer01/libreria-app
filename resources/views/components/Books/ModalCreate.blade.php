<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Libro</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{url('books')}}">
                @csrf
                <input type="text" class="form-control" name="title" placeholder="titulo" aria-label="Username"><br>
                @error('title')
                    <small class="text-danger">{{$message}}</small>
                @enderror
                <textarea placeholder="descripción" name="description" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea><br>
                @error('description')
                    <small class="text-danger">{{$message}}</small>
                @enderror
                <input type="text" class="form-control" name="isbn" placeholder="ISBN" aria-label="Username"><br>
                @error('isbn')
                    <small class="text-danger">{{$message}}</small>
                @enderror
                <input type="text" class="form-control" name="gender" placeholder="Genero" aria-label="Username"><br>
                @error('gender')
                    <small class="text-danger">{{$message}}</small><br>
                @enderror
                <label for="">Autores</label>
                <select class="form-select" name="author_id" id="">
                    <option value="">Selecciona un autor...</option>
                    @foreach ($authors as $author)
                        <option value="{{$author->id}}">{{$author->name}} {{$author->lastname}}</option>
                    @endforeach
                </select><br>
                @error('author_id')
                        <small class="text-danger">{{$message}}</small>
                @enderror
                <div class="d-grid col-6 mx-auto">
                    <button class="btn btn-secondary"><i class="fa-solid fa-floppy-disk" type="submit"></i> Guardar</button>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>
