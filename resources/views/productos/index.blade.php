@extends('layouts.app')
@section('content')
    <div class="section-form py-4 flex-fill">
        <div class="container">
            <h2>Productos</h2>
            <div class="title-crud">
                <a href="{{ route('productos.create') }}" class="btn btn-primary">Agregar Producto</a>
            </div>
        </div>
    </div>
@endsection
