@extends('layouts.app')

@section('title')
Calculadolar | Clientes
@endsection

@section('content')
<div class="container">
    @include('includes.header')

    <div class="row mt-4">
        <div class="col-md-8 pl-4">
            <h1>Clientes</h1>
        </div>
        <div class="col-md-4 text-md-right">
            <button type="button" class="btn button-green" data-toggle="modal" data-target="#modalNewCustomer">Registrar cliente</button>
        </div>
    </div>
    <article class="row mt-2 overflow mx-1">
        <div class="col-md-12 p-0">
            <table id="tabla" class="table display">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>CI</th>
                        <th>Nombre</th>
                        <th>Número de teléfono</th>
                        <th>Dirección</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
        </div>
    </article>
</div>

<div class="modal fade" id="modalNewCustomer" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            
        </div>
    </div>
</div>

<div class="modal fade" id="modalShowCustomer" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    
    @include('includes.datatablesTemplate', [
        'url' => 'clientes/get',
        'columns' => "{data: 'id'},
                    {data: 'idn'},
                    {data: 'name'},
                    {data: 'phone_number'},
                    {data: 'address'},
                    {data: 'btn'}
                    "
        ])

    <script> //Request the empty form to create the new customer
        function showSpinner () {
            $('#app').prepend(`<div class="wait row justify-content-center">
                <div class="col-md-12">
                    <div class="spinner"></div>
                </div>
            </div>`);
        }

        $(document).on('click', 'button[data-target="#modalNewCustomer"]', function(){
            showSpinner();
            $.ajax({
                url: 'clientes/registrar',
                success: function(response){
                    $('#modalNewCustomer').find('.modal-content').html(response);
                    $('.wait').remove();
                },
                error: function(){
                    $('.wait').remove();
                    $('#modalNewCustomer').find('.modal-content').html('Error en la consulta');
                    setTimeout(function(){
                        $('#modalNewCustomer').modal('hide');
                    }, 500)
                    
                }
            })
        });

        $(document).on('click', 'button[data-target="#modalShowCustomer"]', function(){
            showSpinner();
            id = $(this).val();
            $.ajax({
                url: 'clientes/ver/'+id,
                success: function(response) {
                    $('#modalShowCustomer').find('.modal-content').html(response);
                    $('.wait').remove();
                },
                error: function() {
                    $('.wait').remove();
                    $('#modalShowCustomer').find('.modal-content').html('Error en la consulta');
                    setTimeout(function(){
                        $('#modalShowCustomer').modal('hide');
                    }, 500)
                }
            })
        });

        $(document).on('click', '.edit', function(){
            showSpinner();
            
            id = $(this).val();
            $.ajax({
                url: 'clientes/editar/'+id,
                success: function(response) {
                    $('#modalShowCustomer').modal();
                    $('#modalShowCustomer').find('.modal-content').html(response);
                    $('.wait').remove();
                },
                error: function() {
                    $('.wait').remove();
                    $('#modalShowCustomer').find('.modal-content').html('Error en la consulta');
                    setTimeout(function(){
                        $('#modalShowCustomer').modal('hide');
                    }, 500)
                }
            })
        });

        $(document).on('submit', '.form-delete', function(){
            return confirm('¿Desea eliminar el registro?');
        });
    
    
    </script>
@endsection