document.getElementById('form').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevenir el envío del formulario por defecto
    var valid = true;
    // Validar nombre
    var nombre = document.getElementById('name').value.trim();
    var warningsNombre = document.getElementById('warnings_nombre');
    if (nombre.length < 3 || nombre.length > 50) {
        warningsNombre.textContent = "El nombre debe tener entre 3 y 50 caracteres.";
        valid = false;
    } else {
        warningsNombre.textContent = "";
    }

    // Validar apellido
    var apellido = document.getElementById('apellido').value.trim();
    var warningsApellido = document.getElementById('warnings_apellido');
    if (apellido.length < 3 || apellido.length > 50) {
        warningsApellido.textContent = "El apellido debe tener entre 3 y 50 caracteres.";
        valid = false;
    } else {
        warningsApellido.textContent = "";
    }

    // Validar tipo de documento
    var tipoDoc = document.getElementById('tipo_doc').value;
    var warningsTipoDoc = document.getElementById('warnings_tipo_doc');
    if (tipoDoc === "null") {
        warningsTipoDoc.textContent = "Debe seleccionar un tipo de documento.";
        valid = false;
    } else {
        warningsTipoDoc.textContent = "";
    }

    var numDoc = document.getElementById('num_doc').value.trim();
    var warningsNumDoc = document.getElementById('warnings_num_doc');
    var valid = true;
    
    if (numDoc.length < 5 || numDoc.length > 10 || isNaN(numDoc)) {
        warningsNumDoc.textContent = "El número de documento debe tener entre 5 y 10 dígitos.";
        valid = false;
    } else {
        warningsNumDoc.textContent = "";
    }

      // Validar contraseña
    var contraseña = document.getElementById('contraseña').value.trim();
    var warningsContraseña = document.getElementById('warnings_contraseña');
    var contraseñaRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,50}$/;
    
    if (!contraseñaRegex.test(contraseña)) {
        warningsContraseña.textContent = "La contraseña debe tener entre 8 y 50 caracteres, incluir al menos una mayúscula, una minúscula, un número y un carácter especial.";
        valid = false;
    } else if (contraseña.includes(usuario) || contraseña.includes(nombre) || contraseña.includes(apellido)) {
        warningsContraseña.textContent = "La contraseña no debe contener su nombre, apellido o nombre de usuario.";
        valid = false;
    } else if (/(.)\1{2,}/.test(contraseña)) {
        warningsContraseña.textContent = "La contraseña no debe contener caracteres repetidos más de dos veces seguidas.";
        valid = false;
    } else {
        warningsContraseña.textContent = "";
    }
 
     // Validar repetición de contraseña
     var repetirContraseña = document.getElementById('repetir_contraseña').value.trim();
     var warningsRepetirContraseña = document.getElementById('warnings_repetir_contraseña');
     if (contraseña !== repetirContraseña) {
         warningsRepetirContraseña.textContent = "Las contraseñas no coinciden.";
         valid = false;
     } else {
         warningsRepetirContraseña.textContent = "";
     }


   

    // Validar correo electrónico
    var correo = document.getElementById('correo').value.trim();
    var warningsCorreo = document.getElementById('warnings_correo');
    var correoRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!correoRegex.test(correo)) {
        warningsCorreo.textContent = "El correo electrónico debe ser válido.";
        valid = false;
    } else {
        warningsCorreo.textContent = "";
    }

    // Validar ciudad
    var ciudad = document.getElementById('ciudad').value;
    var warningsCiudad = document.getElementById('warnings_ciudad');
    if (ciudad === "null") {
        warningsCiudad.textContent = "Debe seleccionar una ciudad.";
        valid = false;
    } else {
        warningsCiudad.textContent = "";
    }

    // Validar teléfono
    var telefono = document.getElementById('telefono').value.trim();
    var warningsTelefono = document.getElementById('warnings_telefono');
    if (telefono.length !== 10 || isNaN(telefono)) {
        warningsTelefono.textContent = "El número de teléfono debe tener 10 dígitos.";
        valid = false;
    } else {
        warningsTelefono.textContent = "";
    }

    //Validar fecha de nacimiento
    var fecha_nacimiento = document.getElementById('fecha_nacimiento').value.trim();
    var warningsFecha = document.getElementById('warnings_fecha');
    if (!fecha_nacimiento) {
        warningsFecha.textContent = "Debe poner una fecha de nacimiento válida.";
        valid = false;
    } else {
        warningsFecha.textContent = "";
    }
 // Validar términos y condiciones
 var checkboxTerminos = document.getElementById('terminos');
 var warningsTerminos = document.getElementById('warnings_terminos');
 if (!checkboxTerminos.checked) {
     warningsTerminos.textContent = "Debe aceptar los Términos y Condiciones.";
     valid = false;
 } else {
     warningsTerminos.textContent = "";
 }
// Al final de todas las validaciones:
if (valid) {
    // Si el formulario es válido, envía los datos mediante AJAX
    var formData = new FormData(document.getElementById('form'));
    fetch('registrarse.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            Swal.fire({
                title: "¡Registro exitoso!",
                text: "Tu cuenta ha sido creada correctamente.",
                icon: "success"
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirige a la página de inicio del cliente
                    window.location.href = 'index_cliente.php';
                }
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
} else {
    // Si el formulario no es válido, no hace nada (los mensajes de error ya se muestran)
}
});

// Obtener el modal
var modal = document.getElementById("termsModal");

// Obtener el enlace que abre el modal
var btn = document.getElementById("openModal");

// Obtener el elemento <span> que cierra el modal
var span = document.getElementsByClassName("close")[0];

// Cuando el usuario hace clic en el enlace, abre el modal 
btn.onclick = function(event) {
  event.preventDefault(); // Previene la navegación
  modal.style.display = "block";
}

// Cuando el usuario hace clic en <span> (x), cierra el modal
span.onclick = function() {
  modal.style.display = "none";
}

// Cuando el usuario hace clic fuera del modal, lo cierra
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
