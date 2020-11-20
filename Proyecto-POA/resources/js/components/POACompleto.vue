<template>
<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">POAs Completos</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Tablero</a></li>
                        <li class="breadcrumb-item active">Listado de POAs Completos</li>
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
                                Listado de POAs Completos
                            </h3>
                            <div class="card-tools">
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Denominación</th>
                                        <th>Objetivo</th>
                                        <th>Denom. del indicador</th>
                                        <th>Fórm. del indicador</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="datos in arrayDatos" :key="datos.id">
                                        <td v-text="datos.denoproceso"></td>
                                        <td v-text="datos.objetivoproceso"></td>
                                        <td v-text="datos.denoindicador"></td>
                                        <td v-text="datos.formindicador"></td>
                                        <td>
                                            <button @click="descargarPdf(datos.id)"
                                                title="Descargar reporte PDF" type="button" 
                                                class="btn btn-info btn-sm">
                                                <i class="fas fa-file-pdf"></i>
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
</div>
</template>

<script>
    export default {
        data(){
            return{
                //Declaración de variables para trabajar crud
                datobasico_id: 0,
                denoproceso: '',
                objetivoproceso: '',
                denoindicador: '',
                formindicador: '',
                arrayDatos: [],//Variable tipo array para insertar datos
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
                var url = '/selectGeneral?page=' + page;
                axios.get(url).then(function(response) {
                    var respuesta = response.data;
                    me.arrayDatos = respuesta.dato_basicos.data;
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
            descargarPdf(id){
                window.open('http://127.0.0.1:8000/selectGeneral/descargarPdf/'+ id + ',' + '_blank');
            }
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