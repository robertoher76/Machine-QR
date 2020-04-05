<div class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-delay="8500" style="position: absolute; top: 15%; right: 5%;">
    <div class="toast-header bg-danger text-white">
        <span class="fas fa-exclamation"></span>
        <strong class="mr-auto">&nbsp; {{ $title }}</strong>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
            <span class="text-white" aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="toast-body">
        {{ $error }}
    </div>
</div>
