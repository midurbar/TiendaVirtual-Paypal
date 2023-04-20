
const tableLista = document.querySelector("#tableListaProductos tbody");

document.addEventListener('DOMContentLoaded', function() {
    if (tableLista) {
        getListaProductos();
    }

    

});

function getListaProductos() {
    const http = new XMLHttpRequest();
    const url = base_url + 'principal/ListaProductos';
    http.open('POST', url, true);
    http.send(JSON.stringify(listaCarrito));
    http.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            const res = JSON.parse(this.responseText);
            console.log(res);
            let html = '';
            res.productos.forEach(producto => {
                html += `<tr>
                    <td>
                        <img class="img-thumbnail rounded-circle" src="${producto.imagen}" alt="" width="100">
                    </td>
                    <td>${producto.nombre}</td>
                    <td><span class="badge bg-warning">${producto.precio +' '+ res.moneda}</span></td>
                    <td><span class="badge bg-primary">${producto.cantidad}</span></td>
                    <td>${producto.SubTotal}</td>
                </tr>`;
            });
            tableLista.innerHTML = html;
            document.querySelector('#totalProducto').textContent='IMPORTE TOTAL: '+res.total +' '+ res.moneda;
            botonPaypal(res.totalPaypal);
        }
    }
}

function botonPaypal(total) {
  paypal.Buttons({

    createOrder: function(data, actions) {
      // This function sets up the details of the transaction, including the amount and line item details.
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: total
          }
        }]
      });
    },

    onApprove: function(data, actions) {
      // This function captures the funds from the transaction.
      return actions.order.capture().then(function(details) {
        // This function shows a transaction success message to your buyer.
        alert('Transaction completed by ' + details.payer.name.given_name);
      }); 
    }
  }).render('#paypal-button-container');
}
