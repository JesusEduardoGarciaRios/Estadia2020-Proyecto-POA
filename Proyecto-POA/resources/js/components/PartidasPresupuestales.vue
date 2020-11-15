<template>
<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Partidas Presupuestales</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Tablero</a></li>
                        <li class="breadcrumb-item active">Listado de Partidas Presupuestales</li>
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
                                Listado de Partidas Presupuestales
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
                                        <th>Partida Presupuestal</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="datos in arrayDatos" :key="datos.id">
                                        <td v-text="datos.partidapresu"></td>
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
                            <!-- Partida presupuestal -->
                            <div class="form-group row" :class="{ 'form-group row--error': $v.partidapresu.$error }">
                                <label for="text-input" class="col-md-3 form-control-label">Núm. y nombre partida</label>
                                <div class="col-md-9">
                                    <input v-model.trim="$v.partidapresu.$model" type="text" class="form-control" placeholder="ej: 383 - Congresos y convenciones">
                                    <!-- Mostrar validaciones de campo Partida presupuestal -->
                                    <div class="error" v-if="!$v.partidapresu.required"><p class="text-danger">Este campo es requerido.</p></div>
                                    <div class="error" v-if="!$v.partidapresu.maxLength"><p class="text-danger">Este campo tiene un máximo de 240 caracteres.</p></div>
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
                partidapresu_id: 0,
                partidapresu: '',
                arrayDatos: [],//Variable tipo array para insertar datos
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
            partidapresu: {
                required,
                maxLength: maxLength(240)
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
                var url = '/partidasPresupuestales?page=' + page;
                axios.get(url).then(function(response) {
                    var respuesta = response.data;
                    me.arrayDatos = respuesta.partida_presupuestales.data;
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
                                this.tituloModal = 'Registrar Partida Presupuestal';
                                this.tipoAccion = 1;
                                this.partidapresu = '';
                                break;
                            }
                            case "actualizar":{
                                this.modal = 1;
                                this.tituloModal = 'Actualizar Partida Presupuestal';
                                this.tipoAccion = 2;
                                this.partidapresu_id = data['id'];
                                this.partidapresu = data['partidapresu'];
                                break;
                            }
                        }
                    }
                }
            },
            /*Método encargado de cerrar un modal, se establecen las variables de registro
            vacias(string) o en ceros las que esperan valores numéricos*/
            cerrarModal(){
                this.modal = 0;
                this.tituloModal = '';
                this.partidapresu = '';
            },  
            /*Método que contiene la logica para registrar desde la ventana modal*/
            registrarDatos(){
                let me = this;
                axios.post('/partidasPresupuestales/registrar',{
                    /*se hace referencia al contenido que tienen los campos en ese momento*/
                    'partidapresu': this.partidapresu,
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
                axios.put('/partidasPresupuestales/actualizar',{
                    /*se hace referencia al id de la fila en la que se hizo clic en el botón 
                    editar y al contenido que tienen los campos en ese momento*/
                    'id': this.partidapresu_id,
                    'partidapresu': this.partidapresu,
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
                        axios.delete('/partidasPresupuestales/eliminar/'+id,{
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