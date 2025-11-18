function summernoteUploadImage(summer,carpeta,image) {
    var data = new FormData();
    data.append("file", image);
    data.append("carpeta", carpeta);
    $.ajax({
        url: base_url + "archivos/summernote/subir",
        cache: false,
        contentType: false,
        processData: false,
        data: data,
        type: "post",
        success: function(url) {
            var image = $('<img>').attr('src', base_url + url);
            summer.summernote("insertNode", image[0]);
        },
        error: function(data) {
            console.log(data);
        }
    });
}

function summernoteDeleteFile(src) {
    $.ajax({
        data: {
            src: src
        },
        type: "POST",
        url: base_url + "archivos/summernote/eliminar", // replace with your url 
        cache: false,
        success: function(resp) {
            console.log(resp);
        }
    });
}