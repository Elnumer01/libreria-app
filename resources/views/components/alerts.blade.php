@if (session('msg') == 'create')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
        Swal.fire({
        position: 'center',
        icon: 'success',
        title:'Añadido correctamente',
        showConfirmButton: false,
        timer: 1500
    })
</script>
@endif

@if (session('msg') == 'update')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
        Swal.fire({
        position: 'center',
        icon: 'success',
        title:'Actualizado correctamente',
        showConfirmButton: false,
        timer: 1500
    })
</script>
@endif

@if (session('msg') == 'delete')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
        Swal.fire({
        position: 'center',
        icon: 'success',
        title:'eliminado correctamente',
        showConfirmButton: false,
        timer: 1500
    })
</script>
@endif

@if (session('msg') == 'error')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">
    Swal.fire({
    icon: 'error',
    title: 'Oops...',
    text: 'ocurrio un error',
    })
</script>
@endif
