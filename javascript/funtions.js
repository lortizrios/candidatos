
//Muestra alert de confirmacon cuando se guarda los datos
function salert_update(){
    swal({
    title: "Guardado",
    text: "¡Candidato actualizado exitosamente!",
    icon: "success",
    buttons: false,
    timer: 3000,
    });    
}

//Muestra alert que confirma error del sistema al guardar los datos
function salert_error(){
    swal({
        title: "Error",
        text: "No se pudo actualizar los datos. Intente nuevamente.",
        icon: "error",
        buttons: true,
        dangerMode: true,
        closeOnClickOutside: false,
      })
      .then((clickOk) => {
        if (clickOk) {
            window.history.back(-1);
        }
      });
}

//regresa a la pagina anterior del historial
function goBack(){
    window.history.back(-1);
}

//Muestra alert de error al no poder guardar foto del candidato
function salert_error_foto(){
    swal({
        title: "Error",
        text: "No se guardo la foto del candidato. Intente nuevamente.",
        icon: "error",
        buttons: true,
        dangerMode: true,
        closeOnClickOutside: false,
      })
      .then((clickOk) => {
        if (clickOk) {
            window.history.back(-1);
        }
    });
}

//Muestra alert cuando el formato de imagen no es valido
function img_format_val(){
    swal({
        title: "Error",
        text: "Elija una imagen en el formato JPG o JPEG.",
        icon: "warning",
        buttons: true,
        dangerMode: true,
        closeOnClickOutside: false,
    }).then((clickOk) => {
        if(clickOk){
            window.history.back(-1);
        }
    });   
}

//Muestra alert cuando se oprime borrar candidato

function archiveFunction() {
    event.preventDefault(); // prevent form submit
    var form = event.target.form; // storing the form
    swal({
        title: "Are you sure?",
        text: "But you will still be able to retrieve this file.",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, archive it!",
        cancelButtonText: "No, cancel please!",
        closeOnConfirm: false,
        closeOnCancel: false},

    function(isConfirm){
        if (isConfirm) {
            form.submit();          // submitting the form when user press yes
        } else {
            swal("Cancelled", "Your imaginary file is safe :)", "error");
        }
    });

    function delError(){
        swal({
            title: "Error",
            text: ". Intente nuevamente.",
            icon: "error",
            buttons: true,
            dangerMode: true,
            closeOnClickOutside: false,
        })    
    }

    function delCompleted(){
        swal({
            title: "Borrado",
            text: "¡Candidato borrado exitosamente!",
            icon: "success",
            buttons: false,
            timer: 3000,
        });
    }
}