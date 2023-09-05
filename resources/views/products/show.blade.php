<div class="container-fluid">
    <div class="row mt-1 text-center justify-content-center">
        <div class="col-md-4 row">
        
            @if( count($product[0]->product_catalogs)>0 )
            {{-- Mostrar la primera imagen --}}
                <div class="rounded_container mx-auto">
                    <a href="#" id="gallery_open" data-target="#gallery">
                    <img src="{{ route('products.image', ['filename' => $product[0]->product_catalogs[0]->image_path]) }}" class="business_logo" alt="imagen del producto">
                    @if( count($product[0]->product_catalogs)>1 )
                        <div class="more">{{ count($product[0]->product_catalogs)-1 }}+</div>
                    @endif
                    </a>
                </div>
                
            @endif
        
        </div>
        <div class="col-md-12 mt-4">
            <h3 class="text-success">{{$product[0]->name.' '.$product[0]->brand.' '.$product[0]->measurement.' '.$product[0]->unit_of_measurement}}</h3>
            @if($product[0]->unit_stock<11)
                <span class="text-danger">
                <i class="fas fa-triangle-exclamation"></i> Quedan {{$product[0]->unit_stock}} unidades en stock
                </span>
            @else
                <h5>
                {{$product[0]->unit_stock}} unidades en stock
                </h5>
            @endif
        </div>
    </div>
    
    <div class="brdr-gray mt-3">
        <div class="row mt-2">
            <div class="col-md-12">
                <h4>Resumen general</h4>
            </div>
        </div>
        <hr>
        <div class="row justify-content-between mt-3">
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-7"><strong>Precio de compra en $</strong></div>
                    <div class="col-md-auto"><span>{{$product[0]->dollar_buy_price.'$'}}</span></div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-7"><strong>Cantidad de unidades</strong></div>
                    <div class="col-md-auto"><span>{{$product[0]->unit_quantity}}</span></div>
                </div>
            </div>
        </div>

        <div class="row justify-content-between mt-2">
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-7"><strong>Ganancia</strong></div>
                    <div class="col-md-auto"><span>{{$product[0]->profit.'%'}}</span></div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-7"><strong>Precio de compra en $</strong></div>
                    <div class="col-md-auto"><span>{{$product[0]->dollar_sale_price.'$'}}</span></div>
                </div>
            </div>
        </div>

        <div class="row justify-content-between mt-2">
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-7"><strong>Precio de venta en Bs</strong></div>
                    <div class="col-md-5"><span>@if($bsDay) {{$bsDay[0]->dolar_user_transference*$product[0]->dollar_sale_price}} @else Ingresa la tasa del dia @endif</span></div>
                </div>
            </div>
            @if($bsDay && $bsDay[0]->dollar_user_cash>0)
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-7"><strong>Precio de compra en Bs Efect</strong></div>
                    <div class="col-md-auto"><span>{{$bsDay[0]->dollar_user_cash*$product[0]->dollar_sale_price}}</span></div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <div class="brdr-gray mt-3">
        <div class="row mt-2">
            <div class="col-md-12">
                <h4>Resumen al mayor</h4>
            </div>
        </div>
        <hr>
        <div class="row justify-content-between mt-3">
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-7"><strong>Precio de compra en $</strong></div>
                    <div class="col-md-auto"><span>{{$product[0]->dollar_buy_price.'$'}}</span></div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-7"><strong>Cantidad de unidades</strong></div>
                    <div class="col-md-auto"><span>{{$product[0]->unit_quantity}}</span></div>
                </div>
            </div>
        </div>

        <div class="row justify-content-between mt-2">
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-7"><strong>Ganancia</strong></div>
                    <div class="col-md-auto"><span>{{$product[0]->profit.'%'}}</span></div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-7"><strong>Precio de compra en $</strong></div>
                    <div class="col-md-auto"><span>{{$product[0]->dollar_sale_price.'$'}}</span></div>
                </div>
            </div>
        </div>

        <div class="row justify-content-between mt-2">
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-7"><strong>Precio de venta en Bs</strong></div>
                    <div class="col-md-5"><span>@if($bsDay) {{$bsDay[0]->dolar_user_transference*$product[0]->dollar_sale_price}} @else Ingresa la tasa del dia @endif</span></div>
                </div>
            </div>
            @if($bsDay && $bsDay[0]->dollar_user_cash>0)
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-7"><strong>Precio de compra en Bs Efect</strong></div>
                    <div class="col-md-auto"><span>{{$bsDay[0]->dollar_user_cash*$product[0]->dollar_sale_price}}</span></div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@if( count($product[0]->product_catalogs)>0 )
<div class="gallery_full">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <button type="button" class="close close_gallery"><span aria-hidden="true">X</span></button>
            <div class="carousel-item active">
            <img src="{{route('products.image', ['filename' => $product[0]->product_catalogs[0]->image_path])}}" class="d-block w-100" alt="...">
            </div>
            @if( count($product[0]->product_catalogs)>1 )
            <div class="carousel-item">
            <img src="{{route('products.image', ['filename' => $product[0]->product_catalogs[1]->image_path])}}" class="d-block w-100" alt="...">
            </div>
            @if( count($product[0]->product_catalogs)>2 )
            <div class="carousel-item">
            <img src="{{route('products.image', ['filename' => $product[0]->product_catalogs[2]->image_path])}}" class="d-block w-100" alt="...">
            </div>
            @endif
            @endif
        </div>
        <button class="carousel-control-prev" type="button" data-target="#carouselExampleIndicators" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-target="#carouselExampleIndicators" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Siguiente</span>
        </button>
    </div>
</div>
@endif