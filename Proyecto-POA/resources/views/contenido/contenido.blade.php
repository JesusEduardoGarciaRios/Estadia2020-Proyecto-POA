@extends('principal')
@section('contenido')
    <!-- Menu 0 - Tablero -->
    <template v-if="menu==0">
        <tablero></tablero>
    </template>
    <!-- Menu 1 - Parte 1 POA -->
    <template v-if="menu==1">
        <datos-basicos></datos-basicos>
    </template>
    <!-- Menu 2 - Parte 2 POA -->
    <template v-if="menu==2">
        <h1>Parte 2</h1>
    </template>
    <!-- Menu 3 - Parte 3 POA -->
    <template v-if="menu==3">
        <h1>Parte 3</h1>
    </template>
    <!-- Menu 4 - Parte 4 POA -->
    <template v-if="menu==4">
        <h1>Parte 4</h1>
    </template>
    <!-- Menu 4.5 - Usuarios -->
    <template v-if="menu==4.5">
    <usuarios></usuarios>
    </template>
    <!-- Menu 5 - Ayuda -->
    <template v-if="menu==5">
        <h1>Ayuda</h1>
    </template>
    
@endsection