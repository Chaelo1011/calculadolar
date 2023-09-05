@extends('layouts.app')

@section('title')
    Calculadolar | Editar Negocio
@endsection
    
@section('content')
    <div class="container off">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('includes.message')
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-4">
                            <header class="col-md-12 pl-4" style="margin-top: -2px;">
                                <h1>Datos de mi negocio</h1>
                            </header>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <form action="{{route('business.update', $business->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')

                                    @if($business->logo_path)
                                        <div class="row">
                                            <div class="col-md-8 offset-md-3">
                                                <img src="{{ route('business.logo', ['filename' => $business->logo_path]) }}" class="d-block mb-1 logo-preview">
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group row">
                                        <label for="logo" class="col-md-3 col-form-label text-md-right">{{ __('Logo') }}</label>
                                        <div class="col-md-8">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="logo" name="logo">
                                                <label class="custom-file-label" for="logo">Subir imagen</label>
                                            </div>
                                            @error('logo')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="rif" class="col-md-3 col-form-label text-md-right">{{ __('RIF') }}</label>
                                        <div class="col-md-8">
                                            <input id="rif" type="text" class="form-control @error('rif') is-invalid @enderror" name="rif" value="{{ $business->rif }}" required autocomplete="off" placeholder="RIF o Número de Identificación de tu negocio">
                                            @error('rif')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="name" class="col-md-3 col-form-label text-md-right">{{ __('Nombre') }}</label>
                                        <div class="col-md-8">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $business->name }}" required autocomplete="off" autofocus placeholder="Nombre de tu negocio">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="state" class="col-md-3 col-form-label text-md-right">{{ __('Ubicación') }}</label>
                                        <div class="col-md-4">
                                            <input id="state" type="text" class="form-control @error('state') is-invalid @enderror" name="state" value="{{ $business->state }}" required autocomplete="off" placeholder="Estado">
                                            @error('state')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <input id="city" type="text" class="form-control @error('city') is-invalid @enderror" name="city" value="{{ $business->city }}" required autocomplete="off" placeholder="Ciudad">
                                            @error('city')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="address" class="col-md-3 col-form-label text-md-right"></label>
                                        <div class="col-md-8">
                                            <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $business->address }}" required autocomplete="off"  placeholder="Dirección exacta">
                                            @error('address')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description" class="col-md-3 col-form-label text-md-right">{{ __('Descripción') }}</label>
                                        <div class="col-md-8">
                                            <textarea id="description" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="off" placeholder="Describe brevemente tu negocio">{{ $business->description }}</textarea>
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row mt-5 mb-4">
                                        <div class="col-md-8 offset-md-3 text-right">
                                            <button type="reset" class="btn btn-danger">Borrar campos</button>
                                            <button type="submit" class="btn button-green">Registrar</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bs-custom-file-input/dist/bs-custom-file-input.min.js"></script>
@endsection