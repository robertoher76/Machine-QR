
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body text-center">

                <form method="POST" action="{{url('/maquinas/'.$maquina->id.'/componente/'. $componente->id)}}">
                    @method('DELETE')
                    @csrf
                    <div class="container">
                    <button id="imgDrop" type="button" class="close mr-1 pt-0" style="float:none !important;" data-dismiss="modal" aria-label="Close">
                        <div style="width:100%;">
                            <span style="font-size: 40px;" class="far fa-times-circle"></span>
                        </div>
                        <p class=" text-center">Cancelar</p>
                    </button>
                    <button id="imgEdit" type="submit" class="close btn btn-default ml-1 mt-3" style="float:none !important;">
                        <div style="width:100%;">
                            <span style="font-size: 40px;" class="far fa-check-circle"></span>
                        </div>
                        <p class="">Eliminar</p>
                    </button>
                    </div>
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
