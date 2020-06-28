@extends('layouts.app')

@section('body-class','profile-page') 

@section('styles')
    <style>
        .team {
            padding-bottom: 50px;
        }  
    </style>
@endsection

@section('content')
    
      <div class="header header-filter" style="background-image: url('{{ asset('img/portada.jpg') }}');"></div>

        <div class="main main-raised">
            <div class="profile-content">
                <div class="container">
                    <div class="row">
                        <div class="profile">
                            <div class="avatar">
                                <img src="/img/search.jpg" alt="Mostrando resultados" class="img-circle img-responsive img-raised">
                            </div>

                            <div class="name">
                                <h3 class="title">Resultado de Busqueda</h3>
                            </div>

                            @if (session('notification'))
                                <div class="alert alert-success">
                                    {{ session('notification') }}
                                </div>
                            @endif

                        </div>
                    </div>
                    <div class="description text-center">
                        <p>Se encontraron {{ $products->count() }} resultados para el término {{ $query }}.</p>
                    </div>
                    <div class="team text-center">
                        <div class="row">
                            @foreach ($products as $product)
                            <div class="col-md-4">
                                <div class="team-player">
                                    <img src="{{ $product->featured_image_url }}" alt="Thumbnail Image" class="img-raised img-circle">
                                    <h4 class="title">
                                        <a href="{{ url('/products/'.$product->id) }}">{{ $product->name }}</a>
                                    </h4>
                                    <p class="description">{{ $product->description }}</p>
                                    <!--<a href="#" class="btn btn-simple btn-just-icon"><i class="fa fa-twitter"></i></a>
                                    <a href="#" class="btn btn-simple btn-just-icon"><i class="fa fa-instagram"></i></a>
                                    <a href="#" class="btn btn-simple btn-just-icon btn-default"><i class="fa fa-facebook-square"></i></a>-->
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div class="text-center">
                            {{ $products->links() }}
                        </div>
                    </div>

                </div>
            </div>
     </div>
       

@include('includes.footer')
@endsection

