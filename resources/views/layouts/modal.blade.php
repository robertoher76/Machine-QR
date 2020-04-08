
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="exampleModalCenterTitle">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <a id="imgOrden" href="" class="btn btn-default text-center">
                    <div style="width:100%;">
                        <span style="font-size: 75px;" class="{{ $icon1 }}"></span>
                    </div>
                    <p class="mt-2">{{ $title2 }}</p>
                </a>

                <a id="imgEdit" href="" class="btn btn-default text-center">
                    <div style="width:100%;">
                        <span style="font-size: 75px;" class="{{ $icon2 }}"></span>
                    </div>
                    <p class="mt-2 text-center">{{ $title3 }}</p>
                </a>
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
