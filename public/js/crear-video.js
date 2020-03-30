$(document).ready(function () {

    $('#foto').fileinput({
        language: 'es',
        allowedFileExtensions: ['mp4'],
        maxFileSize: 100000,
        showUpload: false,
        showClose: false,
        initialPreviewAsDate: true,
        dropZoneEnabled: true,        
        maxFileCount: 1,
        theme: 'fas', 
    });   
});