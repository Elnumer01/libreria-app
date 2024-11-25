<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Prestamo</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{url('loans')}}">
                @csrf
                <label for="">Clientes</label>
                <select class="form-select" name="user_id" id="">
                    <option selected="true" disabled="disabled" value="">Selecciona un cliente...</option>
                    @foreach ($clients as $client)
                        <option value="{{$client->id}}">{{$client->name}}</option>
                    @endforeach
                </select><br>
                @error('user_id')
                        <small class="text-danger">{{$message}}</small><br>
                @enderror
                <label for="">Roles</label>
                <select class="form-select" name="book_id" id="">
                    <option selected="true" disabled="disabled" value="">Selecciona un libro...</option>
                    @foreach ($books as $book)
                        <option value="{{$book->id}}">{{$book->title}}</option>
                    @endforeach
                </select><br>
                @error('book_id')
                        <small class="text-danger">{{$message}}</small><br>
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
