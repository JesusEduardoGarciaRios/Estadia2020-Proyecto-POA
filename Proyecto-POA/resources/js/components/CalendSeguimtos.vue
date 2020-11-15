<template>
<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Calendarización y Seguimiento de Actividades POA</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Tablero</a></li>
                        <li class="breadcrumb-item active">Listado de Calendarización y Seguimiento de Actividades POA</li>
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
                                Listado de Calendarización y Seguimiento de Actividades POA
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
                                        <th>Denom. indicador</th>
                                        <th>Actividades</th>
                                        <th>Unidad de medida</th>
                                        <th>Meta anual</th>
                                        <th>Prog 1</th>
                                        <th>Alc 1</th>
                                        <th>Prog 2</th>
                                        <th>Alc 2</th>
                                        <th>Prog 3</th>
                                        <th>Alc 3</th>
                                        <th>Justificación</th>
                                        <th>Área Oper.</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="datos in arrayDatos" :key="datos.id">
                                        <td v-text="datos.nombre_denoindicador"></td>
                                        <td v-text="datos.actividad"></td>
                                        <td v-text="datos.unidadmedida"></td>
                                        <td v-text="datos.metaanual"></td>
                                        <td v-text="datos.prog1"></td>
                                        <td v-text="datos.alc1"></td>
                                        <td v-text="datos.prog2"></td>
                                        <td v-text="datos.alc2"></td>
                                        <td v-text="datos.prog3"></td>
                                        <td v-text="datos.alc3"></td>
                                        <td v-text="datos.justificacion"></td>
                                        <td v-text="datos.areaoperadora"></td>
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
                            <!-- Denominación del indicador -->
                            <div class="form-group row" :class="{ 'form-group row--error': $v.datoespecificos_id.$error }">
                                <label for="text-input" class="col-md-3 form-control-label">Denom. indicador</label>
                                <div class="col-md-9">
                                    <select v-model.trim="$v.datoespecificos_id.$model" class="form-control">
                                        <option disabled value="">Seleccione una opción</option>
                                        <option v-for="datoespecificos in arrayDatoespecificos" :key="datoespecificos.id" :value="datoespecificos.id" v-text="datoespecificos.denoindicador"></option>
                                    </select>
                                    <!-- Mostrar validaciones de campo Denominación del indicador -->
                                    <div class="error" v-if="!$v.datoespecificos_id.required"><p class="text-danger">Este campo debe tener una opción.</p></div>
                                </div>
                            </div>

                            <!-- Actividad -->
                            <div class="form-group row" :class="{ 'form-group row--error': $v.actividad.$error }">
                                <label for="text-input" class="col-md-3 form-control-label">Actividad</label>
                                <div class="col-md-9">
                                    <input v-model.trim="$v.actividad.$model" type="text" class="form-control" placeholder="ej: Participación en congresos">
                                    <!-- Mostrar validaciones de campo Actividad -->
                                    <div class="error" v-if="!$v.actividad.required"><p class="text-danger">Este campo es requerido.</p></div>
                                    <div class="error" v-if="!$v.actividad.maxLength"><p class="text-danger">Este campo tiene un máximo de 240 caracteres.</p></div>
                                </div>
                            </div>

                            <!-- Unidad de medida -->
                            <div class="form-group row" :class="{ 'form-group row--error': $v.unidadmedida.$error }">
                                <label for="text-input" class="col-md-3 form-control-label">Unidad de medida</label>
                                <div class="col-md-9">
                                    <input v-model.trim="$v.unidadmedida.$model" type="text" class="form-control" placeholder="ej: Congreso">
                                    <!-- Mostrar validaciones de campo Unidad de medida -->
                                    <div class="error" v-if="!$v.unidadmedida.required"><p class="text-danger">Este campo es requerido.</p></div>
                                    <div class="error" v-if="!$v.unidadmedida.maxLength"><p class="text-danger">Este campo tiene un máximo de 240 caracteres.</p></div>
                                </div>
                            </div>

                            <!-- Meta anual -->
                            <div class="form-group row" :class="{ 'form-group row--error': $v.metaanual.$error }">
                                <label for="text-input" class="col-md-3 form-control-label">Meta anual</label>
                                <div class="col-md-9">
                                    <input v-model.trim="$v.metaanual.$model" type="number" class="form-control">
                                    <!-- Mostrar validaciones de campo Meta anual -->
                                    <div class="error" v-if="!$v.metaanual.required"><p class="text-danger">Este campo es requerido.</p></div>
                                    <div class="error" v-if="!$v.metaanual.maxValue"><p class="text-danger">Este campo tiene un valor máximo de 32767.</p></div>
                                </div>
                            </div>

                            <!-- Progreso 1 -->
                            <div class="form-group row" :class="{ 'form-group row--error': $v.prog1.$error }">
                                <label for="text-input" class="col-md-3 form-control-label">Progreso 1(Núm)</label>
                                <div class="col-md-9">
                                    <input v-model.trim="$v.prog1.$model" type="number" class="form-control">
                                    <!-- Mostrar validaciones de campo Progreso 1 -->
                                    <div class="error" v-if="!$v.prog1.maxValue"><p class="text-danger">Este campo tiene un valor máximo de 32767.</p></div>
                                </div>
                            </div>

                            <!-- Alcance 1 -->
                            <div class="form-group row" :class="{ 'form-group row--error': $v.alc1.$error }">
                                <label for="text-input" class="col-md-3 form-control-label">Alcance 1(Núm)</label>
                                <div class="col-md-9">
                                    <input v-model.trim="$v.alc1.$model" type="number" class="form-control">
                                    <!-- Mostrar validaciones de campo Alcance 1 -->
                                    <div class="error" v-if="!$v.alc1.maxValue"><p class="text-danger">Este campo tiene un valor máximo de 32767.</p></div>
                                </div>
                            </div>

                            <!-- Progreso 2 -->
                            <div class="form-group row" :class="{ 'form-group row--error': $v.prog2.$error }">
                                <label for="text-input" class="col-md-3 form-control-label">Progreso 2(Núm)</label>
                                <div class="col-md-9">
                                    <input v-model.trim="$v.prog2.$model" type="number" class="form-control">
                                    <!-- Mostrar validaciones de campo Progreso 2 -->
                                    <div class="error" v-if="!$v.prog2.maxValue"><p class="text-danger">Este campo tiene un valor máximo de 32767.</p></div>
                                </div>
                            </div>

                            <!-- Alcance 2 -->
                            <div class="form-group row" :class="{ 'form-group row--error': $v.alc2.$error }">
                                <label for="text-input" class="col-md-3 form-control-label">Alcance 2(Núm)</label>
                                <div class="col-md-9">
                                    <input v-model.trim="$v.alc2.$model" type="number" class="form-control">
                                    <!-- Mostrar validaciones de campo Alcance 2 -->
                                    <div class="error" v-if="!$v.alc2.maxValue"><p class="text-danger">Este campo tiene un valor máximo de 32767.</p></div>
                                </div>
                            </div>

                            <!-- Progreso 3 -->
                            <div class="form-group row" :class="{ 'form-group row--error': $v.prog3.$error }">
                                <label for="text-input" class="col-md-3 form-control-label">Progreso 3(Núm)</label>
                                <div class="col-md-9">
                                    <input v-model.trim="$v.prog3.$model" type="number" class="form-control">
                                    <!-- Mostrar validaciones de campo Progreso 2 -->
                                    <div class="error" v-if="!$v.prog3.maxValue"><p class="text-danger">Este campo tiene un valor máximo de 32767.</p></div>
                                </div>
                            </div>

                            <!-- Alcance 3 -->
                            <div class="form-group row" :class="{ 'form-group row--error': $v.alc3.$error }">
                                <label for="text-input" class="col-md-3 form-control-label">Alcance 3(Núm)</label>
                                <div class="col-md-9">
                                    <input v-model.trim="$v.alc3.$model" type="number" class="form-control">
                                    <!-- Mostrar validaciones de campo Alcance 2 -->
                                    <div class="error" v-if="!$v.alc3.maxValue"><p class="text-danger">Este campo tiene un valor máximo de 32767.</p></div>
                                </div>
                            </div>

                             <!-- Justificación -->
                            <div class="form-group row" :class="{ 'form-group row--error': $v.justificacion.$error }">
                                <label for="text-input" class="col-md-3 form-control-label">Justificación</label>
                                <div class="col-md-9">
                                    <textarea v-model.trim="$v.justificacion.$model" class="form-control"></textarea>
                                    <!-- Mostrar validaciones de campo Justificación -->
                                    <div class="error" v-if="!$v.justificacion.maxLength"><p class="text-danger">Este campo tiene un máximo de 600 caracteres.</p></div>
                                </div>
                            </div>

                            <!-- Área operadora -->
                            <div class="form-group row" :class="{ 'form-group row--error': $v.areaoperadora.$error }">
                                <label for="text-input" class="col-md-3 form-control-label">Área operadora</label>
                                <div class="col-md-9">
                                    <input v-model.trim="$v.areaoperadora.$model" type="text" class="form-control" placeholder="ej: Titular del PE">
                                    <!-- Mostrar validaciones de campo Área operadora -->
                                    <div class="error" v-if="!$v.areaoperadora.required"><p class="text-danger">Este campo es requerido.</p></div>
                                    <div class="error" v-if="!$v.areaoperadora.maxLength"><p class="text-danger">Este campo tiene un máximo de 240 caracteres.</p></div>
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
                calendseguimto_id: 0,
                datoespecificos_id: 0,
                actividad: '',
                unidadmedida: '',
                metaanual: 0,
                prog1: 0,
                alc1: 0,
                prog2: 0,
                alc2: 0,
                prog3: 0,
                alc3: 0,
                justificacion: '',
                areaoperadora: '',
                arrayDatos: [],//Variable tipo array para insertar datos
                arrayDatoespecificos: [],//Variable tipo array en el que se guarda el denondicador(de la tabla dato_especificos) para llenar el select
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
            datoespecificos_id: {
                required
            },
            actividad: {
                required,
                maxLength: maxLength(240)
            },
            unidadmedida: {
                required,
                maxLength: maxLength(240)
            },
            metaanual: {
                required,
                maxValue: maxValue(32767)
            },
            prog1: {
                maxValue: maxValue(32767)
            },
            alc1: {
                maxValue: maxValue(32767)
            },
            prog2: {
                maxValue: maxValue(32767)
            },
            alc2: {
                maxValue: maxValue(32767)
            },
            prog3: {
                maxValue: maxValue(32767)
            },
            alc3: {
                maxValue: maxValue(32767)
            },
            justificacion: {
                maxLength: maxLength(600)
            },
            areaoperadora: {
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
                var url = '/calendSeguimtos?page=' + page;
                axios.get(url).then(function(response) {
                    var respuesta = response.data;
                    me.arrayDatos = respuesta.calend_seguimtos.data;
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
                                this.tituloModal = 'Registrar Seguimiento de Actividad';
                                this.tipoAccion = 1;
                                this.datoespecificos_id = '';
                                this.actividad = '';
                                this.unidadmedida = '';
                                this.metaanual = '';
                                this.prog1 = 0;
                                this.alc1 = 0;
                                this.prog2 = 0;
                                this.alc2 = 0;
                                this.prog3 = 0;
                                this.alc3 = 0;
                                this.justificacion = '';
                                this.areaoperadora = '';
                                break;
                            }
                            case "actualizar":{
                                this.modal = 1;
                                this.tituloModal = 'Actualizar Seguimiento de Actividad';
                                this.tipoAccion = 2;
                                this.calendseguimto_id = data['id'];
                                this.datoespecificos_id = data['datoespecificos_id'];
                                this.actividad = data['actividad'];
                                this.unidadmedida = data['unidadmedida'];
                                this.metaanual = data['metaanual'];
                                this.prog1 = data['prog1'];
                                this.alc1 = data['alc1'];
                                this.prog2 = data['prog2'];
                                this.alc2 = data['alc2'];
                                this.prog3 = data['prog3'];
                                this.alc3 = data['alc3'];
                                this.justificacion = data['justificacion'];
                                this.areaoperadora = data['areaoperadora'];
                                break;
                            }
                        }
                    }
                }
                this.selectDatosespecificos();
            },
            /*Método encargado de cerrar un modal, se establecen las variables de registro
            vacias(string) o en ceros las que esperan valores numéricos*/
            cerrarModal(){
                this.modal = 0;
                this.tituloModal = '';
                this.datoespecificos_id = 0;
                this.actividad = '';
                this.unidadmedida = '';
                this.metaanual = 0;
                this.prog1 = 0;
                this.alc1 = 0;
                this.prog2 = 0;
                this.alc2 = 0;
                this.prog3 = 0;
                this.alc3 = 0;
                this.justificacion = '';
                this.areaoperadora = '';
            },  
            /*Método que contiene la logica para registrar desde la ventana modal*/
            registrarDatos(){
                let me = this;
                axios.post('/calendSeguimtos/registrar',{
                    /*se hace referencia al contenido que tienen los campos en ese momento*/
                    'datoespecificos_id': this.datoespecificos_id,
                    'actividad': this.actividad,
                    'unidadmedida': this.unidadmedida,
                    'metaanual': this.metaanual,
                    'prog1': this.prog1,
                    'alc1': this.alc1,
                    'prog2': this.prog2,
                    'alc2': this.alc2,
                    'prog3': this.prog3,
                    'alc3': this.alc3,
                    'justificacion': this.justificacion,
                    'areaoperadora': this.areaoperadora
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
                axios.put('/calendSeguimtos/actualizar',{
                    /*se hace referencia al id de la fila en la que se hizo clic en el botón 
                    editar y al contenido que tienen los campos en ese momento*/
                    'id': this.calendseguimto_id,
                    'datoespecificos_id': this.datoespecificos_id,
                    'actividad': this.actividad,
                    'unidadmedida': this.unidadmedida,
                    'metaanual': this.metaanual,
                    'prog1': this.prog1,
                    'alc1': this.alc1,
                    'prog2': this.prog2,
                    'alc2': this.alc2,
                    'prog3': this.prog3,
                    'alc3': this.alc3,
                    'justificacion': this.justificacion,
                    'areaoperadora': this.areaoperadora
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
                        axios.delete('/calendSeguimtos/eliminar/'+id,{
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
            selectDatosespecificos(){
                let me = this;
                axios.get('/selectDatosespecificos').then(function(response) {
                    var respuesta = response.data;
                    me.arrayDatoespecificos = respuesta.dato_especificos;
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