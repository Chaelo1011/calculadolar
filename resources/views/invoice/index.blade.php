@extends('layouts.app')

@section('title')
Calculadolar | Ventas
@endsection

@section('content')
<div class="container">
    @include('includes.header')

    <div class="row mt-4">
        <div class="col-md-8 pl-4">
            <h1>Ventas</h1>
        </div>
        <div class="col-md-4 text-md-right">
            <a href="{{--route('sales.create')--}}" class="btn button-green">Registrar una venta</a>
        </div>
    </div>
    <article class="row mt-2 mx-1">
        <div class="col-md-12 table-responsive p-0">
            <table id="tabla" class="table display">
                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Fecha</th>
                        <th>Productos</th>
                        <th>Total en $</th>
                        <th>Total en Bs</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($invoices)>0)
                        @foreach ($invoices as $invoice)
                        <tr>
                            <td>{{$invoice->id}}</td>
                            <td>{{$invoice->created_at}}</td>
                            <td>{{$invoice->total_quantity}}</td>
                            <td>{{$invoice->total_price}}</td>
                            <td>000</td>
                            <td><button class="btn">A</button><button class="btn">B</button></td>
                        </tr>
                        
                        @endforeach
                    @else
                    <tr>
                        <td colspan="7" class="text-md-center">No hay ventas registradas</td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </article>
</div>
@endsection