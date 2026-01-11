// ======================
// VARIABLE GLOBAL
// ======================
var carritoVisible = false;

// ======================
// ESPERAR A QUE CARGUE EL DOM
// ======================
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', ready);
} else {
    ready();
}

function ready() {

    // Eliminar items
    document.addEventListener('click', function (e) {
        if (e.target.closest('.btn-eliminar')) {
            eliminarItemCarrito(e);
        }
    });

    // Sumar / Restar cantidad
    document.addEventListener('click', function (e) {
        if (e.target.classList.contains('sumar-cantidad')) {
            sumarCantidad(e);
        }
        if (e.target.classList.contains('restar-cantidad')) {
            restarCantidad(e);
        }
    });

    // Agregar al carrito
    var botonesAgregarAlCarrito = document.getElementsByClassName('boton-item');
    for (var i = 0; i < botonesAgregarAlCarrito.length; i++) {
        botonesAgregarAlCarrito[i].addEventListener('click', agregarAlCarritoClicked);
    }

    // Botón pagar
    var btnPagar = document.querySelector('.btn-pagar');
    if (btnPagar) {
        btnPagar.addEventListener('click', pagarClicked);
    }
}

// ======================
// FUNCIÓN PAGAR (GUARDA EN BD)
// ======================
function pagarClicked(e) {
    e.preventDefault();

    var items = document.getElementsByClassName('carrito-item');
    if (items.length === 0) {
        alert("El carrito está vacío");
        return;
    }

    var metodoPago = document.querySelector('input[name="metodoPago"]:checked');
    if (!metodoPago) {
        alert("Selecciona un método de pago");
        return;
    }

    var productos = [];

    for (var i = 0; i < items.length; i++) {
        productos.push({
            nombre: items[i].querySelector('.carrito-item-titulo').innerText,
            precio: items[i].querySelector('.carrito-item-precio').innerText.replace('$', '').replace(/\./g, ''),
            cantidad: items[i].querySelector('.carrito-item-cantidad').value,
            imagen: items[i].querySelector('img').getAttribute('src').split('/').pop()
        });
    }

    fetch('php/guardar_compra.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            metodo_pago: metodoPago.value,
            productos: productos
        })
    })
    .then(res => res.json())
    .then(data => {
        if (data.success) {
            document.getElementById("modalPago").style.display = "flex";
            vaciarCarrito();
        } else {
            alert("Error al guardar la compra");
        }
    })
    .catch(err => {
        console.error(err);
        alert("Error de conexión");
    });
}

// ======================
// AGREGAR AL CARRITO
// ======================
function agregarAlCarritoClicked(event) {
    var item = event.target.parentElement;

    var titulo = item.querySelector('.titulo-item').innerText;
    var precio = item.querySelector('.precio-item').innerText;
    var imagenSrc = item.querySelector('.img-item').src;

    agregarItemAlCarrito(titulo, precio, imagenSrc);
    hacerVisibleCarrito();
}

function hacerVisibleCarrito() {
    carritoVisible = true;
    document.querySelector('.carrito').style.marginRight = '0';
    document.querySelector('.carrito').style.opacity = '1';
    document.querySelector('.contenedor-items').style.width = '60%';
}

function agregarItemAlCarrito(titulo, precio, imagenSrc) {
    var itemsCarrito = document.querySelector('.carrito-items');
    var nombresItems = itemsCarrito.getElementsByClassName('carrito-item-titulo');

    for (var i = 0; i < nombresItems.length; i++) {
        if (nombresItems[i].innerText === titulo) {
            alert("El producto ya está en el carrito");
            return;
        }
    }

    var item = document.createElement('div');
    item.classList.add('carrito-item');
    item.innerHTML = `
        <img src="${imagenSrc}" width="80px">
        <div class="carrito-item-detalles">
            <span class="carrito-item-titulo">${titulo}</span>
            <div class="selector-cantidad">
                <i class="fa-solid fa-minus restar-cantidad"></i>
                <input type="text" value="1" class="carrito-item-cantidad" disabled>
                <i class="fa-solid fa-plus sumar-cantidad"></i>
            </div>
            <span class="carrito-item-precio">${precio}</span>
        </div>
        <button type="button" class="btn-eliminar">
            <i class="fa-solid fa-trash"></i>
        </button>
    `;

    itemsCarrito.appendChild(item);
    actualizarTotalCarrito();
}

// ======================
// CANTIDADES
// ======================
function sumarCantidad(e) {
    var input = e.target.parentElement.querySelector('.carrito-item-cantidad');
    input.value = parseInt(input.value) + 1;
    actualizarTotalCarrito();
}

function restarCantidad(e) {
    var input = e.target.parentElement.querySelector('.carrito-item-cantidad');
    if (input.value > 1) {
        input.value = parseInt(input.value) - 1;
        actualizarTotalCarrito();
    }
}

// ======================
// ELIMINAR ITEM
// ======================
function eliminarItemCarrito(e) {
    e.target.closest('.carrito-item').remove();
    actualizarTotalCarrito();
    ocultarCarrito();
}

// ======================
// OCULTAR CARRITO
// ======================
function ocultarCarrito() {
    var carritoItems = document.querySelector('.carrito-items');
    if (carritoItems.childElementCount === 0) {
        document.querySelector('.carrito').style.marginRight = '-100%';
        document.querySelector('.carrito').style.opacity = '0';
        document.querySelector('.contenedor-items').style.width = '100%';
        carritoVisible = false;
    }
}

// ======================
// TOTAL
// ======================
function actualizarTotalCarrito() {
    var total = 0;
    var items = document.getElementsByClassName('carrito-item');

    for (var i = 0; i < items.length; i++) {
        var precio = parseFloat(
            items[i].querySelector('.carrito-item-precio').innerText.replace('$', '').replace(/\./g, '')
        );
        var cantidad = parseInt(items[i].querySelector('.carrito-item-cantidad').value);
        total += precio * cantidad;
    }

    document.querySelector('.carrito-precio-total').innerText =
        '$' + total.toLocaleString('es-MX');
}

// ======================
// VACIAR CARRITO
// ======================
function vaciarCarrito() {
    document.querySelector('.carrito-items').innerHTML = '';
    actualizarTotalCarrito();
    ocultarCarrito();
}

// ======================
// CERRAR MODAL
// ======================
document.addEventListener('click', function (e) {
    if (e.target.id === 'cerrarModal') {
        document.getElementById('modalPago').style.display = 'none';
    }
});
