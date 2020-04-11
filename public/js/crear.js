$(document).ready(function () {

    $('#foto').fileinput({
        language: 'es',
        allowedFileExtensions: ['jpg', 'jpeg', 'png'],
        maxFileSize: 4000,
        showUpload: false,
        showClose: false,
        initialPreviewAsDate: true,
        dropZoneEnabled: true,

        maxFileCount: 1,
        theme: 'fas',
    });
});
