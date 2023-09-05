<div class="modal-header">
    <h2 class="modal-title" id="modalShowCustomerLabel">Mostrar Cliente</h2>
    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body mt-3">
    <div class="row">
        <div class="col-md-12 text-center">
            <img src="{{asset('img/usuario.png')}}" alt="" class="img customer_icon">
            <h2 class="mt-2">
                {{$customer->name.' '.$customer->surname}}<br>
                <small class="h4">{{$customer->idn}}</small>
            </h2>
            
        </div>
    </div>
    <div class="brdr-gray mt-4">
        <div class="row">
            <div class="col-md-5 ml-md-3 row">
                <div class="col-md-6 text-md-right">
                    <strong>Número de Teléfono</strong>
                </div>
                <div class="col-md-6">
                    <span>{{$customer->phone_number}}</span>
                </div>
            </div>

            <div class="col-md-5 offset-md-1 row">
                <div class="col-md-6 text-md-right">
                    <strong>Dirección</strong>
                </div>
                <div class="col-md-6">
                    <span>{{$customer->address}}</span>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-12">
            <h4>Historial de compras</h4>
            <table class="table table-striped">
                <thead>
                    <th>Fecha</th>
                    <th>Código</th>
                    <th>Artículos</th>
                </thead>
                <tbody>
                    <tr>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                    </tr>
                    <tr>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                    </tr>
                    <tr>
                        <td>--</td>
                        <td>--</td>
                        <td>--</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>