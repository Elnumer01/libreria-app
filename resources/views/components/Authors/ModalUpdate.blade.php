<!-- Modal -->
<div class="modal fade" id="exampleModal-{{$row->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Actualizar Autor</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{url('authors',[$row->id])}}">
                @method('PUT')
                @csrf
                <input id="updateautorname" value="{{$row->name}}" type="text" class="form-control" name="name" placeholder="Nombre" aria-label="Username"><br>
                @error('name')
                    <small class="text-danger">{{$message}}</small>
                @enderror
                <input id="updatelastnameauthor" value="{{$row->lastname}}" type="text" placeholder="Apellidos" name="lastname" class="form-control"><br>
                @error('lastname')
                    <small class="text-danger">{{$message}}</small>
                @enderror
                <input id="updateaddressauthor" value="{{$row->address}}" type="text" class="form-control" name="address" placeholder="Dirección" aria-label="Username"><br>
                @error('address')
                    <small class="text-danger">{{$message}}</small>
                @enderror
                <input id="updatecityauthor" value="{{$row->city}}" type="text" class="form-control" name="city" placeholder="Ciudad" aria-label="Username"><br>
                @error('city')
                    <small class="text-danger">{{$message}}</small><br>
                @enderror
                <div class="d-grid col-6 mx-auto">
                    <button id="updateauthor" class="btn btn-secondary"><i class="fa-solid fa-floppy-disk" type="submit"></i> Guardar</button>
                </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
</div>
