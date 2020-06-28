 @extends('layouts.app')

@section('body-class','product-page')

@section('content')
  <div class="header header-filter" style="background-image: url('{{ asset('img/portada.jpg') }}');">
            
  </div>

        <div class="main main-raised">
            <div class="container">
            
                <div class="section text-center">
                    <h2 class="title">Listado de categorías</h2>

                    <div class="team">
                        <div class="row">
                            <a href="{{ url('/admin/categories/create') }}"  class="btn btn-primary btn-round">Nueva categoría</a>

                            <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Orden</th>
                                            <th class="col-md-2 text-center">Nombre</th>
                                            <th class="col-md-5 text-center">Descripción</th>
                                            <th class="text-center">Opciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($categories as $key => $category)
                                        <tr>
                                            <td class="text-center">{{ ($key+1) }}</td>
                                            <td class="text-center">{{ $category->name }}</td>
                                            <td class="text-center">{{ $category->description }}</td>
                                            <td class="td-actions text-center">
                                                
                                                <form method="post" action="{{ url('/admin/categories/'.$category->id) }}">
                                                    {{ csrf_field() }}
                                                    {{ method_field('DELETE') }}

                                                    <a type="button" rel="tooltip" title="Ver categoría" class="btn btn-info btn-simple btn-xs">
                                                       <i class="fa fa-info"></i>
                                                    </a>

                                                    <a href="{{ url('/admin/categories/'.$category->id.'/edit') }}" rel="tooltip" title="Editar categoría" class="btn btn-success btn-simple btn-xs">
                                                        <i class="fa fa-edit"></i>
                                                    </a>

                                                    <button type="submit" rel="tooltip" title="Eliminar" class="btn btn-danger btn-simple btn-xs">
                                                        <i class="fa fa-times"></i>
                                                    </button>    
                                                </form>
                                                
                                            </td>
                                        </tr>
                                     @endforeach 
                                    </tbody>
                            </table>
                            {{ $categories->links() }}
                        </div>
                    </div>

                </div>

            </div>

        </div>

        @include('includes.footer')
@endsection
