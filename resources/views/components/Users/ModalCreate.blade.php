<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Nuevo Usuario</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{url('users')}}">
                @csrf
                <input type="text" class="form-control" name="name" placeholder="nombre de usuario" aria-label="Username"><br>
                @error('name')
                    <small class="text-danger">{{$message}}</small>
                @enderror
                <input type="text" class="form-control" name="email" placeholder="correo" aria-label="Username"><br>
                @error('email')
                    <small class="text-danger">{{$message}}</small><br>
                @enderror
                <label for="">Roles</label>
                <select class="form-select" name="rol_id" id="">
                    <option selected="true" disabled="disabled" value="">Selecciona un rol...</option>
                    @foreach ($roles as $rol)
                        <option value="{{$rol->id}}">{{$rol->rol}}</option>
                    @endforeach
                </select><br>
                @error('rol_id')
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
