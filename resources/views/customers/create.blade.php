{{-- Respuesta a la modal de crear cliente. Esto llena la modal con el formulario --}}
<div class="modal-header">
    <h2 class="modal-title" id="modalNewCustomerLabel">Registrar cliente</h2>
    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body mt-3">
    <form id="customer-create" action="{{ route('customers.store') }}" method="POST">
        @csrf
        <div class="form-group row">
            <label for="ci" class="col-md-2 col-form-label text-md-right offset-md-1">Cédula</label>
            <div class="col-md-8">
                <input type="text" id="ci" name="ci" class="form-control @error('ci') is-invalid  @enderror" pattern="[0-9]+" value="{{old('ci')}}" required="required" autocomplete="off">
                <small id="ci_help" class="form-text text-muted">Ingresa la cedula sin letras ni puntos. Ej. 00000000</small>
                @error('ci')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-md-2 col-form-label text-md-right offset-md-1">Nombre</label>
            <div class="col-md-8">
                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+" value="{{ old('name') }}" required autocomplete="off">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="surname" class="col-md-2 col-form-label text-md-right offset-md-1">Apellido</label>
            <div class="col-md-8">
                <input type="text" id="surname" name="surname" class="form-control @error('surname') is-invalid @enderror" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]+" value="{{ old('surname') }}" required autocomplete="off">
                @error('surname')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="phone_number" class="col-md-2 col-form-label text-md-right offset-md-1">Teléfono</label>
            <div class="col-md-8">
                <input type="text" id="phone_number" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" pattern="[0-9]+" value="{{ old('phone_number') }}" autocomplete="off">
                <small id="tel_help" class="form-text text-muted">Ej. 04000000000</small>
            </div>
            @error('phone_number')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="form-group row mb-5 ">
            <label for="address" class="col-md-2 col-form-label text-md-right offset-md-1">Dirección</label>
            <div class="col-md-8">
                <input type="text" id="address" name="address" class="form-control @error('address') is-invalid @enderror" value="{{ old('address') }}">
                @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <hr>

        <div class="form-group row">
            <div class="col-md-12 text-md-right">
                <button type="reset" class="btn btn-danger">Borrar campos</button>
                <button type="submit" class="btn button-green">Registrar</button>
            </div>
        </div>
    </form>
</div>


