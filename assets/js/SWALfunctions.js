function confirmarEliminacion(e) {
    e.preventDefault();
    var url = e.currentTarget.getAttribute('href');
    Swal.fire({
        title: 'Confirmar eliminación',
        text: '¿Estás seguro de que quieres eliminar este registro?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, eliminar',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = url;
        }
    });

    return false; // Evita que el enlace se siga ejecutando automáticamente
}

function confirmarEdicion(e) {
    e.preventDefault();
    var name = e.currentTarget.getAttribute('name');
    Swal.fire({
        title: "¿Estás seguro?",
        text: "Se guardarán los cambios",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Sí, guardar",
        cancelButtonText: "Cancelar",
        closeOnConfirm: false
    }).then((result) => {
        if (result.isConfirmed) {
            document.forms[name].submit();
        }
    });

    return false;
}

