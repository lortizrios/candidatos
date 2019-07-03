
//Muestra alert de confirmacon cuando se guarda los datos
function salert_update(){
    swal({
    title: "Guardado",
    text: "¡Candidato guardado exitosamente!",
    icon: "success",
    buttons: false,
    timer: 3000,
    });    
}

//Muestra alert que confirma error del sistema al guardar los datos
function errorActualizar(){
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
        text: "No se pudo guardar la foto del candidato. Intente nuevamente.",
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
        title: "Advertencia",
        text: "La imagen elejida no esta en el formato correcto. Elija una imagen en el formato JPG o JPEG.",
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

//Muestra alert que confirma error del sistema al guardar los datos
function estDuplicado(){
    swal({
        title: "Error",
        text: "Numero de estudiante duplicado. Ingrese un numero de estudiante distinto.",
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

function candRegistrado(){
    swal({
    title: "Registrado",
    text: "¡Candidato registrado exitosamente!",
    icon: "success",
    buttons: false,
    timer: 3000,
    });    
}

function errorRegistrar(){
    swal({ 
        title: "Error",
        text: "Se produjo un error al registrar el candidato. Intente nuevamente.",
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