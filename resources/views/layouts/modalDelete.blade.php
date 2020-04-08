
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-body text-center">
                <h5 class="modal-title text-center" id="exampleModalCenterTitle">¿Está seguro que desea eliminarlo?</h5>
                <br/>
                <form method="POST" action="{{url('/maquinas/'.$maquina->id.'/componente/'. $componente->id)}}">
                    @method('DELETE')
                    @csrf
                    <button id="imgDrop" type="button" class="close mr-4" style="float:none !important;" data-dismiss="modal" aria-label="Close">
                        <div style="width:100%;">
                            <span style="font-size: 75px;" class="far fa-times-circle"></span>
                        </div>
                        <p class="mt-2 text-center">Cancelar</p>
                    </button>
                    <button id="imgEdit" type="submit" class="close btn btn-default ml-4" style="float:none !important;">
                        <div style="width:100%;">
                            <span style="font-size: 75px;" class="far fa-check-circle"></span>
                        </div>
                        <p class="mt-2">Eliminar</p>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    #imgDrop:hover{
        color: red;
    }

    #imgDrop:focus{
        border: 0 !important;
        box-shadow: 0 !important;
    }

    #imgEdit:hover, #imgOrden:hover{
        color: #28a745;
    }
</style>
