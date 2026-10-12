@extends('layouts.app')

@section('title', 'Comisiones de vendedores')

@section('content')
    <div id="app"></div>

    <script>
        window.datosIniciales = {{ Illuminate\Support\Js::from([
            'vendedores' => $vendedores,
            'reglas' => $reglas,
        ]) }};
    </script>
@endsection
