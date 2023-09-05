<header class="row justify-content-center">
        <div class="col-md-8">
            
            @if (count(Auth::user()->business)>0)
            <div class="row">
                <div class="col-md-3 col-sm-4">
                    <div class="rounded_container">
                        <img class="business_logo" src="{{ route('business.logo', ['filename' => Auth::user()->business[0]->logo_path]) }}" alt="">
                    </div>
                </div>
                <div class="col-md-9 col-sm-8">
                    <h1 class="title">
                        {{Auth::user()->business[0]->name}}
                        <small>RIF: {{Auth::user()->business[0]->rif}}</small>
                    </h1>
                    <span>Bienvenido {{Auth::user()->username}}</span>
                    <span>Hoy es <b><?=date('d-m-Y')?></b></span>
                </div>
            </div> 
            @else
                <h1 class="title">Calculadolar</h1>
                <span>Bienvenido {{Auth::user()->username}}</span>
                <span>Hoy es <b><?=date('d-m-Y')?></b></span>
            @endif
            
                        
            
                        
        </div>
        <div id="getdolar" class="col-md-4 text-md-center mt-2">
            Obteniendo tasa del día...<div class="spinner"></div>
        </div>
</header>
