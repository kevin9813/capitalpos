function abrirReporte() {
    document.getElementById('modalReporte').classList.remove('hidden');
}

function cerrarReporte() {
    document.getElementById('modalReporte').classList.add('hidden');
}

document.addEventListener("print-ticket", function(event) {

    const ticketHtml = event.detail.html;

    // Abrimos una ventana pequeña solo para imprimir la térmica
    const printWindow = window.open('', '_blank', 'width=300,height=600');

    printWindow.document.write(ticketHtml);
    printWindow.document.close();

    // Espera un poco para cargar estilos y contenido
    printWindow.onload = function() {
        printWindow.print();
        printWindow.close();
    };

});

