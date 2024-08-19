document.addEventListener('DOMContentLoaded', function () {
    let productCount = 1;

    document.getElementById('add-producto').addEventListener('click', function () {
        const productosDiv = document.getElementById('productos');

        const newProductRow = document.createElement('div');
        newProductRow.classList.add('row', 'mb-3', 'producto-row');
        newProductRow.innerHTML = `
            <label for="productos[${productCount}][Id_producto]" class="col-md-4 col-form-label text-md-end">{{ __('Producto') }}</label>
            <div class="col-md-6">
                <select id="productos[${productCount}][Id_producto]" class="form-control" name="productos[${productCount}][Id_producto]" required>
                    <option value="" disabled selected>Seleccionar Producto</option>
                    @foreach($productos as $producto)
                        <option value="{{ $producto->Id_producto }}">{{ $producto->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <label for="productos[${productCount}][cantidad_producto]" class="col-md-4 col-form-label text-md-end">{{ __('Cantidad') }}</label>
            <div class="col-md-6">
                <input id="productos[${productCount}][cantidad_producto]" type="number" class="form-control" name="productos[${productCount}][cantidad_producto]" required>
            </div>
            <label for="productos[${productCount}][talla_producto]" class="col-md-4 col-form-label text-md-end">{{ __('Talla') }}</label>
            <div class="col-md-6">
                <input id="productos[${productCount}][talla_producto]" type="text" class="form-control" name="productos[${productCount}][talla_producto]">
            </div>
        `;

        productosDiv.appendChild(newProductRow);
        productCount++;
    });


    var inputDate = document.getElementById('fecha_venta');

    var today = new Date();
    var day = String(today.getDate()).padStart(2, '0');
    var month = String(today.getMonth() + 1).padStart(2, '0'); // Enero es 0
    var year = today.getFullYear();

    var todayFormatted = year + '-' + month + '-' + day;
    inputDate.value = todayFormatted;
});
