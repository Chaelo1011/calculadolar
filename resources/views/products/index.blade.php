@extends('layouts.app')

@section('title')
Calculadolar | Productos
@endsection

@section('content')
<div class="container">
    @include('includes.header')
    @include('includes.message')
    <div class="row mt-4">
        <div class="col-md-auto pl-4">
            <h1>Productos</h1>
        </div>
        <div class="col-md-auto ml-auto text-md-right">
            <!-- <a href="{{route('products.create')}}" class="btn button-green">Registrar producto</a> -->
            <button type="button" class="btn button-green create" data-toggle="modal" data-target="#modalNewProduct">
                Registrar producto
            </button>
        </div>
    </div>
    <article class="row mt-2 table-responsive mx-1">
        <div class="col-md-12 p-0">
            <table id="tabla" class="table display">

                <thead>
                    <tr>
                        <th>Codigo</th>
                        <th>Producto</th>
                        <th style="width: 100px !important">Fecha</th>
                        <th>Precio en $</th>
                        <th>Precio en Bs</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                
                </tbody>
                
            </table>
        </div>
    </article>
</div>

<div class="modal fade" id="modalNewProduct" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="modalNewProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable empty_form">
        <div class="modal-content">
            
        </div>
    </div>
</div>
<!-- Modal view product -->
<div class="modal fade" id="modalViewProduct" aria-labelledby="modalViewProductLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="modalViewProductLabel">Detalles del producto</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" value="" class="btn button-green">Editar</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">
</script>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
@include('includes.datatablesTemplate', [
    'url' => 'productos/get',
    'columns' => "{data: 'id'},
                {data: 'name'},
                {data: 'updated_at'},
                {data: 'dollar_sale_price'},
                {data: 'bs_sale_price'},
                {data: 'btn'}
                "
    ])
<script>
    $(document).ready(function(){
        function showSpinner () {
            $('#app').prepend(`<div class="wait row justify-content-center">
                <div class="col-md-12">
                    <div class="spinner"></div>
                </div>
            </div>`);
        }
        $(document).on('click', 'button.show', function(){
            showSpinner();
            
            id = $(this).val();
            $.ajax({
                url: '/productos/ver/'+id,
                success: function(response) {
                    $('#modalViewProduct .modal-body').html(response);
                    $('.wait').remove();
                    $('#modalViewProduct').modal();
                },
                error: function() {
                    alert('Error');
                }
            });
            
        });

        $(document).on('click', 'button.create', function() {
            //Esto esta mal, la modal con el form vacio debe venir con jquery, no estar en la pagina
            //Tanto la modal vacia como la llena la traigo y la muestro con html, no con append
            showSpinner();

            $.ajax({
                url: '/productos/registrar',
                success: function(response) {
                    
                    $('#modalNewProduct .modal-content').html(response);
                    $('.wait').remove();
                    $('#modalNewProduct').modal();
                },
                error: function() {
                    alert('Error en la funcion edit');
                }
            });
        });

        

        $(document).on('click', 'button.edit', function() {
            //Esto esta mal, la modal con el form vacio debe venir con jquery, no estar en la pagina
            //Tanto la modal vacia como la llena la traigo y la muestro con html, no con append
            showSpinner();

            id = $(this).val();
            $.ajax({
                url: '/productos/editar/'+id,
                success: function(response) {
                    /* $('#modalNewProduct .empty_form').hide();
                    $('#modalNewProduct .full_form').remove();
                    $('#modalNewProduct').append(response); */
                    $('#modalNewProduct .modal-content').html(response);
                    $('.wait').remove();
                    $('#modalNewProduct').modal();
                },
                error: function() {
                    alert('Error en la funcion edit');
                }
            });
        });

        $(document).on('click', 'button.create', function() {
            $('#modalNewProduct .empty_form').show();
            $('#modalNewProduct .full_form').remove();
        });

    })
</script>
@endsection
