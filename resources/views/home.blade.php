@extends('layouts.app')

@section('title')
    Calculadolar | Inicio
@endsection

@section('content')
<div class="container">
    @include('includes.header')
    
    <div class="row mt-4">
        <div class="col-md-12 pl-4">
            @include('includes.message')
            <h1>Mi negocio</h1>
        </div>
    </div>
    @if (count(Auth::user()->business)>0)
        <section class="row mb-3 justify-content-center px-2 mt-3">
            <div class="col-md-4 mb-2">
                <form action="{{route('dollarUser.save')}}" method="POST" class="brdr-gray p-4">
                    @csrf
                    <label for="dollar_user">Ingrese su tasa dolar del dia</label>
                    <input type="text" class="num form-control form-control-sm @error('dollar_user') is-invalid @enderror" name="dollar_user" id="dollar_user" autocomplete="off" placeholder="Tasa del día Electrónico" value="{{old('dollar_user')}}" autofocus required>
                    @error('dollar_user')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <input type="text" class="num form-control form-control-sm @error('dollar_user_cash') is-invalid @enderror" name="dollar_user_cash" id="dollar_user_cash" placeholder="Tasa del día Efectivo (Opcional)" value="{{old('dollar_user_cash')}}" autocomplete="off">
                    @error('dollar_user_cash')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    <button class="btn btn-sm btn-block button-green" type="submit">Calcular</button>
                </form>
            </div>
            <div class="col-md-4 text-md-center mb-2">
                <div class="bg-gray tasaDia">
                    <h4 class="mt-3">Tu tasa dolar del día</h4>    
                    
                        @if(is_object($dollar_user))
                        <span><b>
                            {{$dollar_user->dolar_user_transference}} Bs/$ <br>
                            @if($dollar_user->dollar_user_cash>0)
                                {{$dollar_user->dollar_user_cash." Bs Eft/$"}}
                            @endif
                        </b></span>
                        @else
                        <span class=""><b>
                            Tasa dia de hoy no ingresada
                        </b></span>
                        @endif
                    
                </div>
            </div>
            <div class="col-md-4 text-md-center mb-2">
                <div class="brdr-gray">
                    <h4 class="mt-3">Cantidad de ventas hoy</h4>
                    <span><b>000</b></span>
                </div>
            </div>
        </section>  
        <section class="row mb-5 px-2">
            <div class="col-md-4 mb-2">
                <div class="brdr-gray">
                    <h4 class="text-md-center">Mejores clientes</h4>
                    <div class="table-responsive overflow-y">
                    <table class="table table-sm">
                        <thead>
                            <tr>
                                <th>Nombre y apellido</th>
                                <th>Numero de compras</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>--</td>
                                <td>--</td>
                            </tr>
                            <tr>
                                <td>--</td>
                                <td>--</td>
                            </tr>
                            <tr>
                                <td>--</td>
                                <td>--</td>
                            </tr>
                            <tr>
                                <td>--</td>
                                <td>--</td>
                            </tr>
                            <tr>
                                <td>--</td>
                                <td>--</td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-2">
            <div class="brdr-gray">
                <h4 class="text-md-center">Productos más vendidos</h4>
                <div class="table-responsive overflow-y">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Numero de ventas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>--</td>
                            <td>--</td>
                        </tr>
                        <tr>
                            <td>--</td>
                            <td>--</td>
                        </tr>
                        <tr>
                            <td>--</td>
                            <td>--</td>
                        </tr>
                    </tbody>
                </table>
                </div>
                </div>
            </div>
            <div class="col-md-4 text-md-center mb-2">
                <div class="bg-gray">
                    <h4 class="mt-3">Ganancias de hoy</h4>
                    <span><b>000</b></span>
                </div>
            </div>
        </section>    
    @else
        <div class="row px-2 justify-content-center">
            <header class="col-md-5 mb-5 py-5 text-center">
                    <h4>No tienes un negocio registrado</h4>
                    <a href="{{route('business.create')}}" class="btn button-green">Registrar negocio</a>          
            </header>
        </div>
        
    @endif
</div>
@endsection

