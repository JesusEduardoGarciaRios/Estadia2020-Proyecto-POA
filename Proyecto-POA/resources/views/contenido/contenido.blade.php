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
        <datos-especificos></datos-especificos>
    </template>
    <!-- Menu 3 - Parte 3 POA -->
    <template v-if="menu==3">
        <calend-seguimtos></calend-seguimtos>
    </template>
    <!-- Menu 4 - Parte 4 POA -->
    <template v-if="menu==4">
        <recursos-requeridos></recursos-requeridos>
    </template>
     <!-- Menu 4.3 - POAs Completos -->
     <template v-if="menu==4.3">
        <poa-completo></poa-completo>
    </template>
    <!-- Menu 4.4 - Partida Presupuestal POA -->
    <template v-if="menu==4.4">
        <partidas-presupuestales></partidas-presupuestales>
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