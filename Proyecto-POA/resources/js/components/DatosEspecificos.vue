<template>
<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Datos Específicos POA</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Tablero</a></li>
                        <li class="breadcrumb-item active">Listado de Datos Específicos POA</li>
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
                                Listado de Datos Específicos POA
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
                                        <th>Denominación</th>
                                        <th>Denom. del indicador</th>
                                        <th>Fórm. del indicador</th>
                                        <th>Fecha cumplimiento</th>
                                        <th>Meta actual</th>
                                        <th>Meta a alcanzar</th>
                                        <th>1.er avance</th>
                                        <th>2.do avance</th>
                                        <th>3.er avance</th>
                                        <th>Estrategia</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="datos in arrayDatos" :key="datos.id">
                                        <td v-text="datos.nombre_denoproceso"></td>
                                        <td v-text="datos.denoindicador"></td>
                                        <td v-text="datos.formindicador"></td>
                                        <td v-text="datos.fechacumpli"></td>
                                        <td v-text="datos.nivelactual"></td>
                                        <td v-text="datos.metaalcanzar"></td>
                                        <td v-text="datos.primeroavance"></td>
                                        <td v-text="datos.segundoavance"></td>
                                        <td v-text="datos.terceroavance"></td>
                                        <td v-text="datos.estrategia"></td>
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
                            <!-- Denominación del proceso -->
                            <div class="form-group row" :class="{ 'form-group row--error': $v.datobasicos_id.$error }">
                                <label for="text-input" class="col-md-3 form-control-label">Denominación</label>
                                <div class="col-md-9">
                                    <select v-model.trim="$v.datobasicos_id.$model" class="form-control">
                                        <option disabled>Seleccione una opción</option>
                                        <option v-for="datobasicos in arrayDatobasicos" :key="datobasicos.id" :value="datobasicos.id" v-text="datobasicos.denoproceso"></option>
                                    </select>
                                    <!-- Mostrar validaciones de campo Denominación del indicador -->
                                    <div class="error" v-if="!$v.datobasicos_id.required"><p class="text-danger">Este campo debe tener una opción.</p></div>
                                </div>
                            </div>

                            <!-- Denominación del indicador -->
                            <div class="form-group row" :class="{ 'form-group row--error': $v.denoindicador.$error }">
                                <label for="text-input" class="col-md-3 form-control-label">Denominación del indicador</label>
                                <div class="col-md-9">
                                    <input v-model.trim="$v.denoindicador.$model" type="text" class="form-control" placeholder="ej: Cursos y congresos">
                                    <!-- Mostrar validaciones de campo Denominación del indicador -->
                                    <div class="error" v-if="!$v.denoindicador.required"><p class="text-danger">Este campo es requerido.</p></div>
                                    <div class="error" v-if="!$v.denoindicador.maxLength"><p class="text-danger">Este campo tiene un máximo de 240 caracteres.</p></div>
                                </div>
                            </div>

                            <!-- Fórmula del indicador -->
                            <div class="form-group row" :class="{ 'form-group row--error': $v.formindicador.$error }">
                                <label for="text-input" class="col-md-3 form-control-label">Fórmula del indicador</label>
                                <div class="col-md-9">
                                    <input v-model.trim="$v.formindicador.$model" type="text" class="form-control" placeholder="ej: Número de cursos y congresos a los que se asistió">
                                    <!-- Mostrar validaciones de campo Fórmula del indicador -->
                                    <div class="error" v-if="!$v.formindicador.required"><p class="text-danger">Este campo es requerido.</p></div>
                                    <div class="error" v-if="!$v.formindicador.maxLength"><p class="text-danger">Este campo tiene un máximo de 240 caracteres.</p></div>
                                </div>
                            </div>

                            <!-- Fecha cumplimiento -->
                            <div class="form-group row" :class="{ 'form-group row--error': $v.fechacumpli.$error }">
                                <label for="text-input" class="col-md-3 form-control-label">Fecha Cumplimto</label>
                                <div class="col-md-9">
                                    <input v-model.trim="$v.fechacumpli.$model" type="date" class="form-control">
                                    <!-- Mostrar validaciones de campo Fecha cumplimiento -->
                                    <div class="error" v-if="!$v.fechacumpli.required"><p class="text-danger">Este campo es requerido.</p></div>
                                </div>
                            </div>

                            <!-- Nivel actual -->
                            <div class="form-group row" :class="{ 'form-group row--error': $v.nivelactual.$error }">
                                <label for="text-input" class="col-md-3 form-control-label">Nivel actual(Núm)</label>
                                <div class="col-md-9">
                                    <input v-model.trim="$v.nivelactual.$model" type="number" class="form-control">
                                    <!-- Mostrar validaciones de campo Nivel actual -->
                                    <div class="error" v-if="!$v.nivelactual.maxValue"><p class="text-danger">Este campo tiene un valor máximo de 32767.</p></div>
                                </div>
                            </div>

                            <!-- Meta a alcanzar -->
                            <div class="form-group row" :class="{ 'form-group row--error': $v.metaalcanzar.$error }">
                                <label for="text-input" class="col-md-3 form-control-label">Meta a alcanzar(Núm)</label>
                                <div class="col-md-9">
                                    <input v-model.trim="$v.metaalcanzar.$model" type="number" class="form-control">
                                    <!-- Mostrar validaciones de campo Meta a alcanzar -->
                                    <div class="error" v-if="!$v.metaalcanzar.required"><p class="text-danger">Este campo es requerido.</p></div>
                                    <div class="error" v-if="!$v.metaalcanzar.maxValue"><p class="text-danger">Este campo tiene un valor máximo de 32767.</p></div>
                                </div>
                            </div>

                            <!-- Primer avance -->
                            <div class="form-group row" :class="{ 'form-group row--error': $v.primeroavance.$error }">
                                <label for="text-input" class="col-md-3 form-control-label">1er avance(Núm)</label>
                                <div class="col-md-9">
                                    <input v-model.trim="$v.primeroavance.$model" type="number" class="form-control">
                                    <!-- Mostrar validaciones de campo Primer avance -->
                                    <div class="error" v-if="!$v.primeroavance.maxValue"><p class="text-danger">Este campo tiene un valor máximo de 32767.</p></div>
                                </div>
                            </div>

                            <!-- Segundo avance -->
                            <div class="form-group row" :class="{ 'form-group row--error': $v.segundoavance.$error }">
                                <label for="text-input" class="col-md-3 form-control-label">2do avance(Núm)</label>
                                <div class="col-md-9">
                                    <input v-model.trim="$v.segundoavance.$model" type="number" class="form-control">
                                    <!-- Mostrar validaciones de campo Segundo avance -->
                                    <div class="error" v-if="!$v.segundoavance.maxValue"><p class="text-danger">Este campo tiene un valor máximo de 32767.</p></div>
                                </div>
                            </div>

                            <!-- Tercer avance -->
                            <div class="form-group row" :class="{ 'form-group row--error': $v.terceroavance.$error }">
                                <label for="text-input" class="col-md-3 form-control-label">3er avance(Núm)</label>
                                <div class="col-md-9">
                                    <input v-model.trim="$v.terceroavance.$model" type="number" class="form-control">
                                    <!-- Mostrar validaciones de campo Segundo avance -->
                                    <div class="error" v-if="!$v.terceroavance.maxValue"><p class="text-danger">Este campo tiene un valor máximo de 32767.</p></div>
                                </div>
                            </div>

                             <!-- Estrategia -->
                            <div class="form-group row" :class="{ 'form-group row--error': $v.estrategia.$error }">
                                <label for="text-input" class="col-md-3 form-control-label">Estrategia(s)</label>
                                <div class="col-md-9">
                                    <textarea v-model.trim="$v.estrategia.$model" class="form-control"></textarea>
                                    <!-- Mostrar validaciones de campo Estrategia -->
                                    <div class="error" v-if="!$v.estrategia.required"><p class="text-danger">Este campo es requerido.</p></div>
                                    <div class="error" v-if="!$v.estrategia.maxLength"><p class="text-danger">Este campo tiene un máximo de 600 caracteres.</p></div>
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
                datoespecifico_id: 0,
                datobasicos_id: 0,
                denoindicador: '',
                formindicador: '',
                fechacumpli: '',
                nivelactual: 0,
                metaalcanzar: 0,
                primeroavance: 0,
                segundoavance: 0,
                terceroavance: 0,
                estrategia: '',
                arrayDatos: [],//Variable tipo array para insertar datos
                arrayDatobasicos: [],//Variable tipo array en el que se guarda el denoproceso(de la tabla dato_basicos) para llenar el select
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
            datobasicos_id: {
                required
            },
            denoindicador: {
                required,
                maxLength: maxLength(240)
            },
            formindicador: {
                required,
                maxLength: maxLength(240)
            },
            fechacumpli: {
                required
            },
            nivelactual: {
                maxValue: maxValue(32767)
            },
            metaalcanzar: {
                required,
                maxValue: maxValue(32767)
            },
            primeroavance: {
                maxValue: maxValue(32767)
            },
            segundoavance: {
                maxValue: maxValue(32767)
            },
            terceroavance: {
                maxValue: maxValue(32767)
            },
            estrategia: {
                required,
                maxLength: maxLength(600)
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
                var url = '/datosEspecificos?page=' + page;
                axios.get(url).then(function(response) {
                    var respuesta = response.data;
                    me.arrayDatos = respuesta.dato_especificos.data;
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
                                this.tituloModal = 'Registrar Datos Específicos';
                                this.tipoAccion = 1;
                                this.datobasicos_id = '';
                                this.denoindicador = '';
                                this.formindicador = '';
                                this.fechacumpli = '';
                                this.nivelactual = 0;
                                this.metaalcanzar = '';
                                this.primeroavance = 0;
                                this.segundoavance = 0;
                                this.terceroavance = 0;
                                this.estrategia = '';
                                break;
                            }
                            case "actualizar":{
                                this.modal = 1;
                                this.tituloModal = 'Actualizar Datos Específicos';
                                this.tipoAccion = 2;
                                this.datoespecifico_id = data['id'];
                                this.datobasicos_id = data['datobasicos_id'];
                                this.denoindicador = data['denoindicador'];
                                this.formindicador = data['formindicador'];
                                this.fechacumpli = data['fechacumpli'];
                                this.nivelactual = data['nivelactual'];
                                this.metaalcanzar = data['metaalcanzar'];
                                this.primeroavance = data['primeroavance'];
                                this.segundoavance = data['segundoavance'];
                                this.terceroavance = data['terceroavance'];
                                this.estrategia = data['estrategia'];
                                break;
                            }
                        }
                    }
                }
                this.selectDatosbasicos();
            },
            /*Método encargado de cerrar un modal, se establecen las variables de registro
            vacias(string) o en ceros las que esperan valores numéricos*/
            cerrarModal(){
                this.modal = 0;
                this.tituloModal = '';
                this.datobasicos_id = 0;
                this.denoindicador = '';
                this.formindicador = '';
                this.fechacumpli = '';
                this.nivelactual = 0;
                this.metaalcanzar = 0;
                this.primeroavance = 0;
                this.segundoavance = 0;
                this.terceroavance = 0;
                this.estrategia = '';
            },  
            /*Método que contiene la logica para registrar desde la ventana modal*/
            registrarDatos(){
                let me = this;
                axios.post('/datosEspecificos/registrar',{
                    /*se hace referencia al contenido que tienen los campos en ese momento*/
                    'datobasicos_id': this.datobasicos_id,
                    'denoindicador': this.denoindicador,
                    'formindicador': this.formindicador,
                    'fechacumpli': this.fechacumpli,
                    'nivelactual': this.nivelactual,
                    'metaalcanzar': this.metaalcanzar,
                    'primeroavance': this.primeroavance,
                    'segundoavance': this.segundoavance,
                    'terceroavance': this.terceroavance,
                    'estrategia': this.estrategia
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
                axios.put('/datosEspecificos/actualizar',{
                    /*se hace referencia al id de la fila en la que se hizo clic en el botón 
                    editar y al contenido que tienen los campos en ese momento*/
                    'id': this.datoespecifico_id,
                    'datobasicos_id': this.datobasicos_id,
                    'denoindicador': this.denoindicador,
                    'formindicador': this.formindicador,
                    'fechacumpli': this.fechacumpli,
                    'nivelactual': this.nivelactual,
                    'metaalcanzar': this.metaalcanzar,
                    'primeroavance': this.primeroavance,
                    'segundoavance': this.segundoavance,
                    'terceroavance': this.terceroavance,
                    'estrategia': this.estrategia
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
                        axios.delete('/datosEspecificos/eliminar/'+id,{
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
             /*Método encargado de seleccionar una sociedad emisora en el select del formulario*/
            selectDatosbasicos(){
                let me = this;
                axios.get('/selectDatosbasicos').then(function(response) {
                    var respuesta = response.data;
                    me.arrayDatobasicos = respuesta.dato_basicos;
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