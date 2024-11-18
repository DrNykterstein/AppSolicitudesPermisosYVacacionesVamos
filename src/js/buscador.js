document.addEventListener('DOMContentLoaded',function(){
    iniciarApp();
})

function iniciarApp(){
    buscarPorFecha();
    buscarPorFechaI();
}

function buscarPorFecha(){
    const fechaInput = document.querySelector('#fecha');
    fechaInput.addEventListener('input', function(e){
        const fechaSeleccionada = e.target.value;
        window.location =`?fecha=${fechaSeleccionada}`;

    });
}

function buscarPorFechaI(){
    const fechaInput = document.querySelector('#fechaInicio');
    fechaInput.addEventListener('input', function(e){
        const fechaSeleccionada = e.target.value;
        window.location =`?fecha=${fechaSeleccionada}`;

    });
}