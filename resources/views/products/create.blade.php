<div class="modal-header">
    <h2 class="modal-title" id="modalNewProductLabel">Registrar producto</h2>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body mt-3">
    <form id="product_create" action="{{ route('products.save') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group row">
            <label for="image" class="col-md-2 col-form-label text-md-right">{{ __('Imagenes') }}</label>
            <div class="col-md-3">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image" name="image">
                    <label class="custom-file-label" for="image">Subir imagen</label>
                </div>
                @error('image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-md-3">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image1" name="image1">
                    <label class="custom-file-label" for="image1">Subir imagen</label>
                </div>
                @error('image1')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-md-3">
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="image2" name="image2">
                    <label class="custom-file-label" for="image2">Subir imagen</label>
                </div>
                @error('image2')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="name" class="col-md-2 col-form-label text-md-right">{{ __('Producto') }}</label>
            <div class="col-md-3">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="off" placeholder="Nombre">
                @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-md-2">
                <input id="brand" type="text" class="form-control @error('brand') is-invalid @enderror" name="brand" value="{{ old('brand') }}" required autocomplete="off" placeholder="Marca">
                @error('brand')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-md-2">
                <input id="measurement" type="text" class="form-control @error('measurement') is-invalid @enderror" name="measurement" value="{{ old('measurement') }}" autocomplete="off" placeholder="Medida">
                @error('measurement')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-md-2">
                <select id="unit_measurement" name="unit_measurement" class="form-control @error('unit_measurement') is-invalid @enderror">
                    <option value="">--</option>
                    <option value="Kg">Kg</option>
                    <option value="g">g</option>
                    <option value="L">L</option>
                    <option value="Ml">Ml</option>
                    <option value="Und">Unidad(es)</option>
                </select>
                @error('unit_measurement')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="dollar_buy_price" class="col-md-2 col-form-label text-md-right">{{ __('Precio de compra en $') }}</label>
            <div class="col-md-9">
                <input id="dollar_buy_price" type="text" class="form-control @error('dollar_buy_price') is-invalid @enderror" name="dollar_buy_price" value="{{ old('dollar_buy_price') }}" required autocomplete="off">
                @error('dollar_buy_price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="unit_quantity" class="col-md-2 col-form-label text-md-right">{{ __('Cantidad de unidades') }}</label>
            <div class="col-md-5">
                <input id="unit_quantity" type="text" class="form-control @error('unit_quantity') is-invalid @enderror" name="unit_quantity" value="{{ old('unit_quantity') }}" required autocomplete="off">

                <small id="unit_quantity_help" class="form-text text-muted">Unidades que contiene el paquete.</small>

                @error('unit_quantity')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-md-4">
                <input id="units_in_stock" type="text" class="form-control @error('units_in_stock') is-invalid @enderror" name="units_in_stock" value="{{ old('units_in_stock') }}" required autocomplete="off">

                <small id="unit_stock_help" class="form-text text-muted">Unidades que tienes en stock actualmente.</small>

                @error('units_in_stock')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="profit" class="col-md-2 col-form-label text-md-right">{{ __('Ganancia') }}</label>
            <div class="col-md-9">
                <input id="profit" type="text" class="form-control @error('profit') is-invalid @enderror" name="profit" value="{{ old('profit') }}" required autocomplete="off">
                @error('profit')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="dollar_sale_price" class="col-md-2 col-form-label text-md-right">{{ __('Precio de venta') }}</label>
            <div class="col-md-4">
                <input id="dollar_sale_price" type="text" class="form-control @error('dollar_sale_price') is-invalid @enderror form-control-plaintext" name="dollar_sale_price" value="{{ old('dollar_sale_price') }}" required autocomplete="off" placeholder="Precio de venta en $">
                @error('dollar_sale_price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="col-md-5">
                <input id="bs_sale_price" type="text" class="form-control @error('bs_sale_price') is-invalid @enderror form-control-plaintext" name="bs_sale_price" value="{{ old('bs_sale_price') }}" required autocomplete="off" placeholder="Precio de venta en Bs">
                @error('bs_sale_price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <label for="bsEfect_sale_price" class="col-md-2 col-form-label text-md-right"></label>
            <div class="col-md-9">
                <input id="bsEfect_sale_price" type="text" readonly class="form-control @error('bsEfect_sale_price') is-invalid @enderror form-control-plaintext" name="bsEfect_sale_price" value="{{ old('bsEfect_sale_price') }}" autocomplete="off" placeholder="Precio de venta en Bs Efectivo">
                @error('bsEfect_sale_price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        <hr style="margin-top: 20px;">
        <div class="form-group row mayor">
            <div class="col-md-10 col-form-label">
                <h3><i class="fas fa-angle-down mx-3"></i> Precios al Mayor</h3>
            </div>
        </div>
        <div class="toggle">
            <div class="form-group row">
                <label for="wholesale_profit" class="col-md-3 col-form-label text-md-right">{{ __('Ganancia al mayor') }}</label>
                <div class="col-md-8">
                    <input id="wholesale_profit" type="text" class="form-control @error('wholesale_profit') is-invalid @enderror" name="wholesale_profit" value="{{ old('wholesale_profit') }}" autocomplete="off">
                    @error('wholesale_profit')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="wholesale_dollar_sale_price" class="col-md-3 col-form-label text-md-right">{{ __('Precio de venta en $ al mayor') }}</label>
                <div class="col-md-8">
                    <input id="wholesale_dollar_sale_price" type="text" class="form-control @error('wholesale_dollar_sale_price') is-invalid @enderror" name="wholesale_dollar_sale_price" value="{{ old('wholesale_dollar_sale_price') }}" autocomplete="off">
                    @error('wholesale_dollar_sale_price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="wholesale_bs_sale_price" class="col-md-3 col-form-label text-md-right">{{ __('Precio de venta en Bs al mayor') }}</label>
                <div class="col-md-8">
                    <input id="wholesale_bs_sale_price" type="text" class="form-control @error('wholesale_bs_sale_price') is-invalid @enderror" name="wholesale_bs_sale_price" value="{{ old('wholesale_bs_sale_price') }}" autocomplete="off">
                    @error('wholesale_bs_sale_price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <label for="wholesale_bsE_sale_price" class="col-md-3 col-form-label text-md-right">{{ __('Precio de venta en Bs Efectivo al mayor') }}</label>
                <div class="col-md-8">
                    <input id="wholesale_bsE_sale_price" type="text" class="form-control @error('wholesale_bsE_sale_price') is-invalid @enderror" name="wholesale_bsE_sale_price" value="{{ old('wholesale_bsE_sale_price') }}" autocomplete="off">
                    @error('wholesale_bsE_sale_price')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
            </div>
        </div>
        <div class="form-group row mb-4">
            <div class="col-md-12 text-right">
                <button type="reset" class="btn btn-danger">Borrar campos</button>
                <button type="submit" class="btn button-green">Registrar</button>
            </div>
        </div>
    </form>
</div>