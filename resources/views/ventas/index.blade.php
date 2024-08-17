@extends('layouts.app')
@section('content')
    <div class="section-form py-4 flex-fill">
        <div class="container">
            <h2>Ventas</h2>
            <div class="title-crud">
                <a href="{{ route('ventas.create') }}" class="btn btn-primary">Realizar Venta</a>
            </div>


        </div>
    </div>
@endsection
