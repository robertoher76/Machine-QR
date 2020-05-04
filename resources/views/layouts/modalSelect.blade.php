
<!-- Modal -->
<div class="modal fade bg-white" id="exampleModalCenter{{ $id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-bottom-0">
                <h5 class="modal-title text-center" id="exampleModalCenterTitle">Seleccionar Como Imagen de Perfil</h5>                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <img class="w-50 rounded mt-2 mb-2" src="{{ asset('storage/imagenes/galeria/' . $imagen) }}"/>                
                <form action="{{ route('maquina.select', $maquina) }}" method="POST">
                    @csrf
                    <input type="hidden" name="id" value="{{ $id }}"/>                    
                    <button type="submit" class="btn btn-success btn-sm mt-2">Aceptar</button>
                </form>                
            </div>
        </div>
    </div>
</div>
