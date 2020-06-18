@extends('layouts.app')

@section('body-class','product-page')

@section('content')
<div class="header header-filter" style="background-image: url('{{ asset('img/portada.jpg') }}');">
           
</div>

        <div class="main main-raised">
            <div class="container">

                <div class="section">
                    <h2 class="title text-center">Registrar nuevos productos</h2>

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach    
                            </ul>
                        </div>
                    @endif

                    <form method="post" action="{{ url('/admin/products') }}">
                        {{ csrf_field() }}

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Nombre del producto</label>
                                    <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group label-floating">
                                    <label class="control-label">Precio del producto</label>
                                    <input type="number" class="form-control" name="price" value="{{ old('price') }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group label-floating">
                            <label class="control-label">Descripción</label>
                            <input type="text" class="form-control" name="description" value="{{ old('description') }}">
                        </div>
                        
                        
                        <textarea class="form-control" placeholder="Descripción extensa del producto" rows="5" name="long_description">{{ old('long_description') }}</textarea>

                        <button class="btn btn-primary">Registrar producto</button>

                    </form>

                </div>

            </div>

        </div>

        @include('includes.footer')
@endsection
