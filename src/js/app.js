let paso = 1;
const pasoInicial = 1;
const pasoFinal = 5;

//Solicitud de permiso
const solicitudPermiso = {
    idsolicitud_permiso:'',
    fecha_solicitud: '',
    duracion_permiso: '',
    fecha_inicio: '',
    fecha_culminacion: '',
    nombre: '',
    motivos:[],
    id_usuario: ''
}

//Solicitud de Vacaciones
const solicitudVacaciones ={
    id_solicitudes_vacaciones: '',
    fecha_solicitud_vacaciones: '',
    fecha_inicio_vacaciones: '',
    fecha_fin_vacaciones: '',
    id_usuario: '',
    nombreUsuarioVacaciones: '',
}

document.addEventListener('DOMContentLoaded',function(){
    iniciarApp();
    

});

function iniciarApp(){
    mostrarSeccion();// Muestra y oculta las secciones
    tabs();//Cambia de seccion cuando presionen el menu
    botonesPaginador();//Agrega o quita los botones del paginador
    paginaSiguiente();//Para acceder a la Pagina Siguiente
    paginaAnterior();//Para acceder a la pagina anterior
    consultarApi();//Consulta la api
    //Solicitud de permiso
    nombreUsuario();//Nombre del usuario del permiso
    obtenerId();//Funcion para obtener el id del usuario que inicio sesion
    generarIdAleatorioPermiso();//Genera el id aleatorio de la solicitud
    seleccionarFechaSolicitud();//Fecha de Solicitud del permiso
    seleccionarFechaInicioPermiso();//Fecha en la que iniciaria el permiso
    seleccionarFechaFinPermiso();//Fecha en la que culmina el permiso
    diasPermiso();//Dias que durara el permiso
    //solicitudes de vacaciones
    seleccionarFechaSolicitudVacaciones();
    seleccionarFechaInicioVacaciones();
    seleccionarFechaFinVacaciones();
    generarIdAleatorioVacaciones();
}

function mostrarSeccion(){

    //Oculto las secciones
    const seccionAnterior = document.querySelector('.mostrar');
    if(seccionAnterior){
        seccionAnterior.classList.remove('mostrar');
    }
    
    //Selecciono la seccion amostrar
    const pasoSelector = `#paso-${paso}`;
    const seccion = document.querySelector(pasoSelector);
    seccion.classList.add('mostrar');

    //Quita la clase actual
    const tabAnterior = document.querySelector('.actual');
    if(tabAnterior){
        tabAnterior.classList.remove('actual');
    }

    //Resaltar la venta actual
    const tab = document.querySelector(`[data-paso="${paso}"]`);
    tab.classList.add('actual');

}

function tabs(){
    const botones = document.querySelectorAll('.tabs button');
     botones.forEach(boton => {
        boton.addEventListener('click',function(e){
            paso = parseInt(e.target.dataset.paso);
            mostrarSeccion();
            //Activo los botones del paginador
            botonesPaginador();
        });
     })
}
//Configuracion de la paginacion
function botonesPaginador(){
    const paginaSiguiente = document.querySelector('#siguiente');
    const paginaAnterior = document.querySelector('#anterior');

    if(paso === 1){
        paginaAnterior.classList.add('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }else if(paso === 5){
        mostrarResumenVacaciones();
    }else if(paso === 4){
        //llamo a la función mostrar resumen
        mostrarResumen();
    }else{
        paginaAnterior.classList.remove('ocultar');
        paginaSiguiente.classList.remove('ocultar');
    }

    mostrarSeccion();
}

function paginaAnterior(){
    const paginaAnterior = document.querySelector('#anterior');
    paginaAnterior.addEventListener('click', function(){
        if(paso <= pasoInicial) return;
        paso--;
        botonesPaginador();
    })
}


function paginaSiguiente(){
    const paginaSiguiente = document.querySelector('#siguiente');
    paginaSiguiente.addEventListener('click', function(){
        if(paso >= pasoFinal) return;
        paso++;
        botonesPaginador();
    })
}

async function consultarApi(){
    try{
        const url = 'http://localhost:3000/api/motivos';
        const resultado = await fetch(url);
        const motivos = await resultado.json();
        mostrarMotivos(motivos);
    }catch(error){
        console.log(error);
    }
}


function mostrarMotivos(motivos){
    motivos.forEach(motivos => {
        const {idmotivos,nombre} = motivos;
        const nombreMotivo = document.createElement('P');
        nombreMotivo.classList.add('nombre-motivos');
        nombreMotivo.textContent=nombre;
        
        const motivoDiv = document.createElement('DIV');
        motivoDiv.classList.add('motivos');
        motivoDiv.dataset.idMotivo = idmotivos;
        motivoDiv.onclick = function(){
            seleccionarMotivo(motivos);
        }


        motivoDiv.appendChild(nombreMotivo);
        document.querySelector('#motivos').appendChild(motivoDiv);
    });
}

function seleccionarMotivo(motivo){
    const {idmotivos} = motivo;
    const {motivos} = solicitudPermiso;

    //identifica el elemento al que se le da click
    const divMotivo = document.querySelector(`[data-id-motivo="${idmotivos}"]`);
    //Comprobar si un motivo esta tildado o quitarlo
    if(motivos.some(agregado => agregado.idmotivos === idmotivos)){
        //Si ya esta agregado , elimino la clase seleccionado del css
        solicitudPermiso.motivos = motivos.filter(agregado => agregado.idmotivos != idmotivos);
        divMotivo.classList.remove('seleccionado');
    }else{
        //Agrego la clase de css
        solicitudPermiso.motivos = [...motivos,motivo];
        divMotivo.classList.add('seleccionado');

    }
    
    //console.log(solicitudPermiso);   
}
//Obtiene el nombre usuario
function nombreUsuario(){
    solicitudPermiso.nombre = document.querySelector('#nombre').value;
    solicitudVacaciones.nombreUsuarioVacaciones = document.querySelector('#nombre').value;
}
//Obtiene el id del usuario
function obtenerId(){
    solicitudPermiso.id_usuario = document.querySelector('#miID').value;
    solicitudVacaciones.id_usuario = document.querySelector('#miID').value;
}

//Genera el id a aleatorio de las solicitudes
function generarIdAleatorioPermiso() {
    // Genera un número aleatorio entre 10000 y 99999
    solicitudPermiso.idsolicitud_permiso = Math.floor(10000 + Math.random() * 90000);
}

function generarIdAleatorioVacaciones(){
    solicitudVacaciones.id_solicitudes_vacaciones = Math.floor(10000 + Math.random() * 90000);
}

//Obtiene la fecha
function seleccionarFechaSolicitud(){
    const inputFecha = document.querySelector('#fecha_solicitud');
    inputFecha.addEventListener('input', function(e){
        const dia = new Date(e.target.value).getUTCDay();
        //6,0 son los dias sabados y domingo, esos dias no hay permisos
        if([6,0].includes(dia)){
            e.target.value='';
            mostrarAlertas('Compadre, los fines de semana no se dan permisos','error','.formulario');
        }else{
            solicitudPermiso.fecha_solicitud = e.target.value;
        }
        //solicitudPermiso.fecha_solicitud = inputFecha.value; 
    });
}

//Funcion para mostrar alertas de error
function mostrarAlertas(mensaje,tipo,elemento,desaparece=true){
    //Previene que se generen mas de una alerta
    const alertaPrevia = document.querySelector('.alerta');
    if(alertaPrevia){
        alertaPrevia.remove();
    }

    //crear el html de la aleta
    const alerta = document.createElement('DIV');
    alerta.textContent = mensaje;
    alerta.classList.add('alerta');
    alerta.classList.add(tipo);
    // selecciono donde la quiero mostrar la alerta
    const formulario = document.querySelector(elemento);
    //Muestro la alerta en pantalla
    formulario.appendChild(alerta);
    //Elimino la alerta
    if(desaparece){
        setTimeout(()=>{
            alerta.remove();
        },3000);
    }  
}

//fecha de inicio del permiso
function seleccionarFechaInicioPermiso(){
    const inputFecha = document.querySelector('#fecha_inicio');
    inputFecha.addEventListener('input', function(e){
        const dia = new Date(e.target.value).getUTCDay();
        //6,0 son los dias sabados y domingo, esos dias no hay permisos
        if([6,0].includes(dia)){
            e.target.value='';
            mostrarAlertas('Compadre, los fines de semana no se dan permisos','error','.formulario');
        }else{
            solicitudPermiso.fecha_inicio = e.target.value;
        }
    });
}

// Fecha fin del permiso
function seleccionarFechaFinPermiso(){
    const inputFecha = document.querySelector('#fecha_fin');
    inputFecha.addEventListener('input', function(e){
        const dia = new Date(e.target.value).getUTCDay();
        //6,0 son los dias sabados y domingo, esos dias no hay permisos
        if([6,0].includes(dia)){
            e.target.value='';
            mostrarAlertas('Compadre, los fines de semana no se dan permisos','error','.formulario');
        }else{
            solicitudPermiso.fecha_culminacion = e.target.value;
        }
    });
}

function diasPermiso(){
    const inputFecha = document.querySelector('#dias');
    inputFecha.addEventListener('input', function(e){
        //6,0 son los dias sabados y domingo, esos dias no hay permisos
        if(e.target.value <= 0){
            mostrarAlertas('Compadre, los dias de permiso deben ser mayor o igual a 1','error','.formulario');
        }else{
            solicitudPermiso.duracion_permiso = e.target.value;
        }
    });
}

//funcion para mostrar el resumen de las solicitudes
function mostrarResumen(){
    const resumen = document.querySelector('.contenido-resumen');
    //Limpio el contenido de resumen
    while(resumen.firstChild){
        resumen.removeChild(resumen.firstChild);
    }
    if(Object.values(solicitudPermiso).includes('') || solicitudPermiso.motivos.length === 0){
        mostrarAlertas('Compadre, te faltan datos por favor revisa','error','.contenido-resumen',false);
        return;
    }

    // Limpio el div de resumen
    const {fecha_solicitud,duracion_permiso,fecha_inicio,fecha_culminacion,nombre,motivos } = solicitudPermiso;
    
    const nombreTrabajador = document.createElement('P');
    nombreTrabajador.innerHTML = `<span>Nombre:</span>${nombre}`;
    
    const fechaSolicitud = document.createElement('P');
    fechaSolicitud.innerHTML = `<span>Fecha de la solicitud del permiso:</span>${fecha_solicitud}`;

    const duracionPermiso = document.createElement('P');
    duracionPermiso.innerHTML = `<span>Dias de duracion del permiso:</span>${duracion_permiso}`;
    
    const fechaInicio = document.createElement('P');
    fechaInicio.innerHTML = `<span>Fecha en la que inicia el permiso:</span>${fecha_inicio}`;

    const fechaCulminacion = document.createElement('P');
    fechaCulminacion.innerHTML = `<span>Fecha en la que termina el permiso: </span>${fecha_culminacion}`;

    // Heading para los motivos del resumen
    const headingMotivos = document.createElement('H3');
    headingMotivos.textContent = 'Resumen del Permiso solicitado';
    resumen.appendChild(headingMotivos);

    //mostrando los motivos
    motivos.forEach(motivo => {
        const {idmotivo,nombre} = motivo;
        const contenedorMotivo = document.createElement('DIV');
        contenedorMotivo.classList.add('contenedor-motivos');
        const textoMotivo = document.createElement('P');
        textoMotivo.textContent = nombre;
        //agrego al contenedor de motivo
        contenedorMotivo.appendChild(textoMotivo);
        //agrego al resumen
        resumen.appendChild(contenedorMotivo);
    });

    // Muestro los datos del permiso
    const datosPermiso = document.createElement('H3');
    datosPermiso.textContent = 'Datos del Permiso solicitado';
    resumen.appendChild(datosPermiso);


    //Muestro en pantalla
    resumen.appendChild(nombreTrabajador);
    resumen.appendChild(fechaSolicitud);
    resumen.appendChild(duracionPermiso);
    resumen.appendChild(fechaInicio);
    resumen.appendChild(fechaCulminacion);

    //Boton para registrar el permiso 
    const botonRegistrarPermiso = document.createElement('BUTTON');
    botonRegistrarPermiso.classList.add('boton');
    botonRegistrarPermiso.textContent='Solicitar Permiso';
    botonRegistrarPermiso.onclick = registrarPermiso;
    resumen.appendChild(botonRegistrarPermiso);
}

async function registrarPermiso(){
    const {nombre,fecha_solicitud,duracion_permiso,fecha_inicio,fecha_culminacion
        ,id_usuario,motivos,idsolicitud_permiso} = solicitudPermiso;
    const motivosID = motivos.map(motivos => motivos.idmotivos);
    const datos = new FormData();
    datos.append('nombre_usuario',nombre);
    datos.append('fecha_solicitud',fecha_solicitud);
    datos.append('duracion_permiso',duracion_permiso);
    datos.append('fecha_inicio',fecha_inicio);
    datos.append('fecha_culminacion',fecha_culminacion);
    datos.append('id_usuario',id_usuario);
    datos.append('id_motivo',motivosID);
    datos.append('idsolicitud_permiso',idsolicitud_permiso);
    //console.log([...datos]);
    const url = 'http://localhost:3000/api/permisos';

    const respuesta = await fetch(url,{
        method: 'POST',
        body:datos
    });

    const resultado = await respuesta.json();
    console.log(resultado.resultado);
    if(resultado.resultado){
        Swal.fire({
            icon: "success",
            title: "Permiso Solicitado",
            text: "Tu permiso fue creado correctamente",
            button: 'OK'
        }).then( ()=>{
            window.location.reload();
        } )
    }
}
//Solicitudes de Vacaciones
function seleccionarFechaSolicitudVacaciones(){
    const inputFecha = document.querySelector('#fecha_solicitud_vacaciones');
    inputFecha.addEventListener('input', function(e){
        const dia = new Date(e.target.value).getUTCDay();
        //6,0 son los dias sabados y domingo, esos dias no hay permisos
        if([6,0].includes(dia)){
            e.target.value='';
            mostrarAlertas('Compadre, los fines de semana no puedes solicitar vacaciones',
                            'error','.formularioV');
        }else{
            solicitudVacaciones.fecha_solicitud_vacaciones = e.target.value;
        }
        //console.log(solicitudVacaciones.fecha_solicitud_vacaciones);
        //solicitudPermiso.fecha_solicitud = inputFecha.value; 
    });
}

function seleccionarFechaInicioVacaciones(){
    const inputFecha = document.querySelector('#fecha_inicio_vacaciones');
    inputFecha.addEventListener('input', function(e){
        const dia = new Date(e.target.value).getUTCDay();
        //6,0 son los dias sabados y domingo, esos dias no hay permisos
        if([6,0].includes(dia)){
            e.target.value='';
            mostrarAlertas('Compadre, los fines de semana no puedes solicitar vacaciones',
                            'error','.formularioV');
        }else{
            solicitudVacaciones.fecha_inicio_vacaciones = e.target.value;
        }
        //console.log(solicitudVacaciones.fecha_inicio_vacaciones);
        //solicitudPermiso.fecha_solicitud = inputFecha.value; 
    });
}

function seleccionarFechaFinVacaciones(){
    const inputFecha = document.querySelector('#fecha_fin_vacaciones');
    inputFecha.addEventListener('input', function(e){
        const dia = new Date(e.target.value).getUTCDay();
        //6,0 son los dias sabados y domingo, esos dias no hay permisos
        if([6,0].includes(dia)){
            e.target.value='';
            mostrarAlertas('Compadre, los fines de semana no puedes solicitar vacaciones',
                            'error','.formularioV');
        }else{
            solicitudVacaciones.fecha_fin_vacaciones = e.target.value;
        }
        //console.log(solicitudVacaciones.fecha_fin_vacaciones);
        //solicitudPermiso.fecha_solicitud = inputFecha.value; 
    });
}

//Mostrar resumen Vacaciones
//funcion para mostrar el resumen de las solicitudes
function mostrarResumenVacaciones(){
    const resumenV = document.querySelector('.contenido-resumen-vacaciones');
    //Limpio el contenido de resumen
    while(resumenV.firstChild){
        resumenV.removeChild(resumenV.firstChild);
    }
    if(Object.values(solicitudVacaciones).includes('')){
        mostrarAlertas('Compadre, te faltan datos por favor revisa','error'
                        ,'.contenido-resumen-vacaciones',false);
        return;
    }

    // Limpio el div de resumen
    const {nombreUsuarioVacaciones,fecha_solicitud_vacaciones,fecha_inicio_vacaciones
            ,fecha_fin_vacaciones } = solicitudVacaciones;
    
    const nombreVacaciones = document.createElement('P');
    nombreVacaciones.innerHTML = `<span>Nombre:</span>${nombreUsuarioVacaciones}`;
    

    const fechaSolicitudVacaciones = document.createElement('P');
    fechaSolicitudVacaciones.innerHTML =
             `<span>Fecha de la solicitud del permiso:</span>${fecha_solicitud_vacaciones}`;

    const fechaInicioVacaciones = document.createElement('P');
    fechaInicioVacaciones.innerHTML = 
        `<span>Fecha en la que inicia el permiso:</span>${fecha_inicio_vacaciones}`;

    const fechaFinVacaciones = document.createElement('P');
    fechaFinVacaciones.innerHTML = 
        `<span>Fecha en la que termina el permiso: </span>${fecha_fin_vacaciones}`;
    
    // Heading para los motivos del resumen
    const headingMotivos = document.createElement('H3');
    headingMotivos.textContent = 'Resumen de las Vacaciones solicitadas';
    resumenV.appendChild(headingMotivos);

    //Muestro en pantalla
    resumenV.appendChild(nombreVacaciones);
    resumenV.appendChild(fechaSolicitudVacaciones);
    resumenV.appendChild(fechaInicioVacaciones);
    resumenV.appendChild(fechaFinVacaciones);

    //Boton para registrar el permiso 
    const botonRegistrarVacaciones = document.createElement('BUTTON');
    botonRegistrarVacaciones.classList.add('boton');
    botonRegistrarVacaciones.textContent='Solicitar Vacaciones';
    botonRegistrarVacaciones.onclick = registrarVacaciones;
    resumenV.appendChild(botonRegistrarVacaciones);
}

async function registrarVacaciones(){
    const {id_solicitudes_vacaciones,fecha_solicitud_vacaciones,
        fecha_inicio_vacaciones,fecha_fin_vacaciones,id_usuario} = solicitudVacaciones;

    const datosVacaciones = new FormData();
    datosVacaciones.append('id_solicitudes_vacaciones',id_solicitudes_vacaciones);
    datosVacaciones.append('fecha_solicitud_vacaciones',fecha_solicitud_vacaciones);
    datosVacaciones.append('fecha_inicio_vacaciones',fecha_inicio_vacaciones);
    datosVacaciones.append('fecha_fin_vacaciones',fecha_fin_vacaciones);
    datosVacaciones.append('id_usuario',id_usuario);
    //console.log([...datosVacaciones]);
    //Peticion hacia la API 
    const urlVacaciones = 'http://localhost:3000/api/vacaciones';
    const respuestaVacaciones = await fetch(urlVacaciones,{
        method: 'POST',
        body: datosVacaciones
    });

    const resultadoV = await respuestaVacaciones.json();

    console.log(resultadoV);
    if(resultadoV.resultado){
        Swal.fire({
            icon: "success",
            title: "Vacaciones Solicitadas",
            text: "Tus vacaciones fueron solicitadas correctamente",
            button: 'OK'
        }).then( ()=>{
            window.location.reload();
        } )
    }
}
