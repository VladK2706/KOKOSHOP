document.addEventListener('DOMContentLoaded', function () {
    const productoSelect = document.getElementById('producto');
    const tallaSelect = document.getElementById('talla');

    productoSelect.addEventListener('change', function () {
        // Limpiar las opciones de talla
        tallaSelect.innerHTML = '<option value="" disabled selected>Seleccionar Talla</option>';

        const selectedOption = productoSelect.options[productoSelect.selectedIndex];
        const tallas = selectedOption.getAttribute('data-tallas');

        if (tallas) {
            const tallasArray = JSON.parse(tallas);
            tallasArray.forEach(talla => {
                const option = document.createElement('option');
                option.value = talla;
                option.textContent = talla;
                tallaSelect.appendChild(option);
            });
        }
    });
});
