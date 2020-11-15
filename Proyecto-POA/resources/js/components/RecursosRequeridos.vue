<template>
<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Recursos Requeridos POA</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Tablero</a></li>
                        <li class="breadcrumb-item active">Listado de Recursos Requeridos POA</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content | Inicio tabla -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-list-alt"></i>&nbsp;
                                Listado de Recursos Requeridos POA
                            </h3>
                            <div class="card-tools">
                                <button @click="abrirModal('datos','registrar')" title="Agregar nuevo registro" type="button" 
                                class="btn btn-success btn-sm">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Actividad</th>
                                        <th>Concepto</th>
                                        <th>Partida presupuestal</th>
                                        <th>Unidad de medida</th>
                                        <th>Cantidad</th>
                                        <th>Costo aprox.</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="datos in arrayDatos" :key="datos.id">
                                        <td v-text="datos.nombre_actividad"></td>
                                        <td v-text="datos.concepto"></td>
                                        <td v-text="datos.nombre_partidapresu"></td>
                                        <td v-text="datos.unidadmedida"></td>
                                        <td v-text="datos.cantidad"></td>
                                        <td v-text="datos.costoaprox"></td>
                                        <td>
                                            <button @click="abrirModal('datos','actualizar',datos)" 
                                                title="Editar" type="button" 
                                                class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </button>&nbsp;
                                            <button @click="eliminarDatos(datos.id)"
                                                title="Eliminar" type="button" 
                                                class="btn btn-danger btn-sm">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            <ul class="pagination pagination-sm m-0 float-right">
                                <li class="page-item" v-if="pagination.current_page > 1">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1)">&laquo;</a>
                                </li>
                                <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(page)" v-text="page"></a>
                                </li>
                                <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                    <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1)">&raquo;</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content | Fin tabla -->

    <!-- Inicio modales agregar/editar -->
    <div class="modal fade" tabindex="-1" role="dialog" :class="{'mostrar' : modal}">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" v-text="tituloModal"></h4>
                    <button type="button" class="close" @click="cerrarModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                        <div class="card-body">
                            <!-- Actividad REVISAR-->
                            <div class="form-group row" :class="{ 'form-group row--error': $v.calendseguimtos_id.$error }">
                                <label for="text-input" class="col-md-3 form-control-label">Actividad</label>
                                <div class="col-md-9">
                                    <select v-model.trim="$v.calendseguimtos_id.$model" class="form-control">
                                        <option disabled value="">Seleccione una opción</option>
                                        <option v-for="calendseguimto in arrayActividades" :key="calendseguimto.id" :value="calendseguimto.id" v-text="calendseguimto.actividad"></option>
                                    </select>
                                    <!-- Mostrar validaciones de campo Actividad -->
                                    <div class="error" v-if="!$v.calendseguimtos_id.required"><p class="text-danger">Este campo debe tener una opción.</p></div>
                                </div>
                            </div>

                            <!-- Concepto -->
                            <div class="form-group row" :class="{ 'form-group row--error': $v.concepto.$error }">
                                <label for="text-input" class="col-md-3 form-control-label">Concepto</label>
                                <div class="col-md-9">
                                    <input v-model.trim="$v.concepto.$model" type="text" class="form-control" placeholder="ej: Pago de inscripción de congreso">
                                    <!-- Mostrar validaciones de campo Concepto -->
                                    <div class="error" v-if="!$v.concepto.required"><p class="text-danger">Este campo es requerido.</p></div>
                                    <div class="error" v-if="!$v.concepto.maxLength"><p class="text-danger">Este campo tiene un máximo de 240 caracteres.</p></div>
                                </div>
                            </div>

                            <!-- Partida presupuestal REVISAR-->
                            <div class="form-group row" :class="{ 'form-group row--error': $v.partidapresu_id.$error }">
                                <label for="text-input" class="col-md-3 form-control-label">Partida presupuestal</label>
                                <div class="col-md-9">
                                    <select v-model.trim="$v.partidapresu_id.$model" class="form-control">
                                        <option disabled value="">Seleccione una opción</option>
                                        <option v-for="partidaspresupuestal in arrayPartidas" :key="partidaspresupuestal.id" :value="partidaspresupuestal.id" v-text="partidaspresupuestal.partidapresu"></option>
                                    </select>
                                    <!-- Mostrar validaciones de campo Partida presupuestal -->
                                    <div class="error" v-if="!$v.partidapresu_id.required"><p class="text-danger">Este campo debe tener una opción.</p></div>
                                </div>
                            </div>

                            <!-- Unidad de Medida -->
                            <div class="form-group row" :class="{ 'form-group row--error': $v.unidadmedida.$error }">
                                <label for="text-input" class="col-md-3 form-control-label">Unidad de Medida</label>
                                <div class="col-md-9">
                                    <input v-model.trim="$v.unidadmedida.$model" type="text" class="form-control" placeholder="ej: Servicio">
                                    <!-- Mostrar validaciones de campo Unidad de Medida -->
                                    <div class="error" v-if="!$v.unidadmedida.required"><p class="text-danger">Este campo es requerido.</p></div>
                                    <div class="error" v-if="!$v.unidadmedida.maxLength"><p class="text-danger">Este campo tiene un máximo de 240 caracteres.</p></div>
                                </div>
                            </div>

                            <!-- Cantidad -->
                            <div class="form-group row" :class="{ 'form-group row--error': $v.cantidad.$error }">
                                <label for="text-input" class="col-md-3 form-control-label">Cantidad</label>
                                <div class="col-md-9">
                                    <input v-model.trim="$v.cantidad.$model" type="number" class="form-control">
                                    <!-- Mostrar validaciones de campo Cantidad -->
                                    <div class="error" v-if="!$v.cantidad.maxValue"><p class="text-danger">Este campo tiene un valor máximo de 32767.</p></div>
                                    <div class="error" v-if="!$v.cantidad.required"><p class="text-danger">Este campo es requerido.</p></div>
                                </div>
                            </div>

                            <!-- Costo aprox -->
                            <div class="form-group row" :class="{ 'form-group row--error': $v.costoaprox.$error }">
                                <label for="text-input" class="col-md-3 form-control-label">Costo aprox</label>
                                <div class="col-md-9">
                                    <input v-model.trim="$v.costoaprox.$model" type="number" class="form-control">
                                    <!-- Mostrar validaciones de campo Costo aprox -->
                                    <div class="error" v-if="!$v.costoaprox.maxValue"><p class="text-danger">Este campo tiene un valor máximo de 999999999.</p></div>
                                    <div class="error" v-if="!$v.costoaprox.required"><p class="text-danger">Este campo es requerido.</p></div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-secondary" @click="cerrarModal()">Cerrar</button>
                    <button type="button" v-if="tipoAccion==1" class="btn btn-success" :disabled="$v.$invalid" @click="registrarDatos()">Guardar</button>
                    <button type="button" v-if="tipoAccion==2" class="btn btn-primary" :disabled="$v.$invalid" @click="actualizarDatos()">Editar</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.Fin del modales agregar/editar -->
</div>
</template>

<script>
    import { required, maxValue, maxLength } from 'vuelidate/lib/validators';
    export default {
        data(){
            return{
                //Declaración de variables para trabajar crud
                recursorequerido_id: 0,
                calendseguimtos_id: 0,
                concepto: '',
                partidapresu_id: 0,
                unidadmedida: '',
                cantidad: 0,
                costoaprox: 0,
                arrayDatos: [],//Variable tipo array para insertar datos
                arrayActividades: [],//Variable tipo array en el que se guarda la actividad(de la tabla calend_seguimtos) para llenar el select
                arrayPartidas: [],//Variable tipo array en el que se guarda la partida preu(de la tabla partida_presupuestales) para llenar el select
                modal: 0,
                tituloModal: '',
                tipoAccion: 0,
                //Variables de paginación
                pagination: {
                    'total': 0,
                    'current_page': 0, 
                    'per_page': 0,
                    'last_page': 0, 
                    'from': 0,
                    'to': 0
                },
                offset: 3
            }
        },
        validations: {
            calendseguimtos_id: {
                required
            },
            concepto: {
                required,
                maxLength: maxLength(240)
            },
            partidapresu_id: {
                required
            },
            unidadmedida: {
                required,
                maxLength: maxLength(240)
            },
            cantidad: {
                required,
                maxValue: maxValue(32767)
            },
            costoaprox: {
                required,
                 maxValue: maxValue(999999999)
            },
        },
        computed:{
            //página actual
            isActived: function(){
                return this.pagination.current_page;
            },
            //Calcula los elementos de la paginacion
            pagesNumber: function(){
                if(!this.pagination.to){
                    return [];
                }
                var from = this.pagination.current_page - this.offset; 
                if(from < 1) {
                    from = 1;
                }
                var to = from + (this.offset * 2); 
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }  
                var pagesArray = [];
                while(from <= to) {
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            }
        },
        methods:{
            /*Método encargado de listar el contenido del datatable, se envía
            como parámetro la variable page que contiene el número de paginas*/
            listarDatos(page){
                let me = this;
                //Se concatena a la url el número de página(page)
                var url = '/recursosRequeridos?page=' + page;
                axios.get(url).then(function(response) {
                    var respuesta = response.data;
                    me.arrayDatos = respuesta.recurso_requeridos.data;
                    me.pagination = respuesta.pagination;
                })
                .catch(function(error) {
                    console.log(error);
                });
            },
            /*Métdo encargado de cambiar de página con los botones que se encuentran debajo del datatable,
            se envía como parámetro la variable page que contiene el número de la página*/
            cambiarPagina(page){
                let me = this;
                //Actualiza la pagina actual
                me.pagination.current_page = page;
                //Envia la petición para visualizar el contenido de esa página
                me.listarDatos(page);
            },
            /*Método encargado de abrir el modal de registrar y actualizar, se utiliza el
            mismo modal para ambas acciones, cuando se va a registrar trae las variables 
            vacias y cuando se va a actualizar se traen las variables con los campos llenos
            según la fila donde se haya hecho clic en el datatable*/
            abrirModal(modelo, accion, data = []){
                switch(modelo){
                    case "datos":{
                        switch(accion){
                            case "registrar":{
                                this.modal = 1;
                                this.tituloModal = 'Registrar Recursos Requeridos';
                                this.tipoAccion = 1;
                                this.calendseguimtos_id = '';
                                this.concepto = '';
                                this.partidapresu_id = '';
                                this.unidadmedida = '';
                                this.cantidad = '';
                                this.costoaprox = '';
                                break;
                            }
                            case "actualizar":{
                                this.modal = 1;
                                this.tituloModal = 'Actualizar Recursos Requeridos';
                                this.tipoAccion = 2;
                                this.recursorequerido_id = data['id'];
                                this.calendseguimtos_id = data['calendseguimtos_id'];
                                this.concepto = data['concepto'];
                                this.partidapresu_id = data['partidapresu_id'];
                                this.unidadmedida = data['unidadmedida'];
                                this.cantidad = data['cantidad'];
                                this.costoaprox = data['costoaprox'];
                                break;
                            }
                        }
                    }
                }
                this.selectActividad();
                this.selectPartidapresupuestal();
            },
            /*Método encargado de cerrar un modal, se establecen las variables de registro
            vacias(string) o en ceros las que esperan valores numéricos*/
            cerrarModal(){
                this.modal = 0;
                this.tituloModal = '';
                this.calendseguimtos_id = 0;
                this.concepto = '';
                this.partidapresu_id = 0;
                this.unidadmedida = '';
                this.cantidad = 0;
                this.costoaprox = 0;
            },  
            /*Método que contiene la logica para registrar desde la ventana modal*/
            registrarDatos(){
                let me = this;
                axios.post('/recursosRequeridos/registrar',{
                    /*se hace referencia al contenido que tienen los campos en ese momento*/
                    'calendseguimtos_id': this.calendseguimtos_id,
                    'concepto': this.concepto,
                    'partidapresu_id': this.partidapresu_id,
                    'unidadmedida': this.unidadmedida,
                    'cantidad': this.cantidad,
                    'costoaprox': this.costoaprox
                }).then(function(response) {
                    //Referencia a la función cerrar modal
                    me.cerrarModal();
                    //Referencia a la función listar
                    me.listarDatos();
                    //Sweet Alert notifica acción exitosa
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        onOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    Toast.fire({
                        icon: 'success',
                        title: 'Elemento agregado con éxito.'
                    })
                })
                //Mostrar errores en consola
                .catch(function(error) {
                    console.log(error);
                });
            },
            /*Método que contiene la logica para actualizar desde la ventana modal*/
            actualizarDatos(){
                let me = this;
                axios.put('/recursosRequeridos/actualizar',{
                    /*se hace referencia al id de la fila en la que se hizo clic en el botón 
                    editar y al contenido que tienen los campos en ese momento*/
                    'id': this.recursorequerido_id,
                    'calendseguimtos_id': this.calendseguimtos_id,
                    'concepto': this.concepto,
                    'partidapresu_id': this.partidapresu_id,
                    'unidadmedida': this.unidadmedida,
                    'cantidad': this.cantidad,
                    'costoaprox': this.costoaprox,
                }).then(function(response) {
                    //Referencia a la función cerrar modal
                    me.cerrarModal();
                    //Referencia a la función listar
                    me.listarDatos();
                    //Sweet Alert notifica acción exitosa
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 4000,
                        timerProgressBar: true,
                        onOpen: (toast) => {
                            toast.addEventListener('mouseenter', Swal.stopTimer)
                            toast.addEventListener('mouseleave', Swal.resumeTimer)
                        }
                    })
                    Toast.fire({
                        icon: 'success',
                        title: 'Elemento editado con éxito.'
                    })
                })
                //Mostrar errores en consola
                .catch(function(error) {
                    console.log(error);
                });
            },
            /*Método que contiene la logica para eliminar una fila del datatable, se 
            envia como parámetro el id según la fila del datatable*/
            eliminarDatos(id){
                //Sweet Alert pregunta antes de eliminar
                const swalWithBootstrapButtons = Swal.mixin({
                    customClass: {
                        confirmButton: 'btn btn-danger',
                        cancelButton: 'btn btn-secondary'
                    },
                    buttonsStyling: false
                    })
                    swalWithBootstrapButtons.fire({
                    title: '¿Estas seguro?',
                    text: "No podrás revertir esta acción!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Eliminar',
                    cancelButtonText: 'Cancelar',
                    reverseButtons: true
                    }).then((result) => {
                    if (result.value) {
                        let me = this;
                        /*se hace referencia al id de la fila en la que se hizo clic en el botón 
                        eliminar y se especifíca en la ruta el id a eliminar*/
                        axios.delete('/recursosRequeridos/eliminar/'+id,{
                            'id': id
                        }).then(function(response) {
                            //Referencia a la función listar
                            me.listarDatos();
                            //Sweet Alert notifica acción exitosa
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 4000,
                                timerProgressBar: true,
                                onOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })
                            Toast.fire({
                                icon: 'success',
                                title: 'Elemento eliminado con éxito.'
                            })
                        })
                        //Mostrar errores en consola
                        .catch(function(error) {
                            console.log(error);
                        });
                    }
                })
            },
            /*Método encargado de seleccionar una actividad en el select del formulario*/
            selectActividad(){
                let me = this;
                axios.get('/selectActividad').then(function(response) {
                    var respuesta = response.data;
                    me.arrayActividades = respuesta.calend_seguimtos;
                })
                .catch(function(error) {
                    console.log(error);
                });
            },
            /*Método encargado de seleccionar una partida presupuestal en el select del formulario*/
            selectPartidapresupuestal(){
                let me = this;
                axios.get('/selectPartidapresupuestal').then(function(response) {
                    var respuesta = response.data;
                    me.arrayPartidas = respuesta.partida_presupuestales;
                })
                .catch(function(error) {
                    console.log(error);
                });
            },
        },
        /*Se mandan a llamar en ese apartado el método listar para
        que esté de manera global*/
        mounted() {
            this.listarDatos();
        }
    }
</script>
<style>
    .modal-content{
        width: 100% !important;
        position: absolute !important;
    }
    .mostrar{
        display: inline-block !important;
        opacity: 1 !important;
        position: absolute !important;
        background-color: #0e0d0db9 !important;
    }
    .modal-dialog {
        top: 10% !important;
    } 
    .div-error{
        display: flex;
        justify-content: center;
    }
    .text-error{
        color: red !important;
        font-weight: bold;
    }
    /* table{
        table-layout: fixed; 
    } */
    /* table td{
        width: 20px;
        height: 10px;
        overflow-y: scroll;
        overscroll-behavior-x: auto;
    } */
</style>