const selectElement = document.getElementById('tipo_producto');

selectElement.addEventListener('change', function () {

    const selectedValue = selectElement.value;

    const textTalla1 = document.getElementById('textTalla1');
    const textTalla2 = document.getElementById('textTalla2');
    const textTalla3 = document.getElementById('textTalla3');
    const textTalla4 = document.getElementById('textTalla4');
    const textTalla5 = document.getElementById('textTalla5');
    const textError = document.getElementById('error');

    // Limpiar el mensaje de error
    textError.textContent = '';

    switch (selectedValue) {
        case 'Superior':
        case 'Cuerpo_completo':
            textTalla1.textContent = 'Talla XS';
            textTalla2.textContent = 'Talla S';
            textTalla3.textContent = 'Talla M';
            textTalla4.textContent = 'Talla L';
            textTalla5.textContent = 'Talla XL';
            break;

        case 'Inferior':
            textTalla1.textContent = 'Talla 26';
            textTalla2.textContent = 'Talla 28';
            textTalla3.textContent = 'Talla 30';
            textTalla4.textContent = 'Talla 32';
            textTalla5.textContent = 'Talla 34';
            break;

        case 'Calzado':
            textTalla1.textContent = 'Talla 35';
            textTalla2.textContent = 'Talla 36';
            textTalla3.textContent = 'Talla 37';
            textTalla4.textContent = 'Talla 38';
            textTalla5.textContent = 'Talla 39';
            break;

        default:
            textError.textContent = 'Selecciona una opción válida.';
            // Limpiar textos de talla
            textTalla1.textContent = 'Talla 1';
            textTalla2.textContent = 'Talla 2';
            textTalla3.textContent = 'Talla 3';
            textTalla4.textContent = 'Talla 4';
            textTalla5.textContent = 'Talla 5';
            break;
    }
});
