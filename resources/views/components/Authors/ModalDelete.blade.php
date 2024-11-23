 <div class="modal fade" id="deleteModal-{{$row->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{url('authors',[$row->id])}}">
                @method('delete')
                @csrf
                <div>
                    <h5>¿Estas seguro de eliminar el siguiente registro?</h5>
                </div><br>
                <div class="d-grid col-6 mx-auto">
                    <button class="btn btn-danger"><i class="fa-solid fa-floppy-disk" type="submit"></i>Eliminar</button>
                </div>
            </form>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
        </div>
    </div>
    </div>
</div>
