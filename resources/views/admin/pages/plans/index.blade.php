@extends('adminlte::page')

@section('title', 'Planos')

@section('content_header')    
        <h1>Planos <a href="#" data-toggle="modal" data-target="#modal-add" class="btn btn-primary float-right"><i class="fa fa-plus"></i> Novo plano</a></h1>   
@stop

@section('content')
    <div class="card ">
        <div class="card-header">
            <form action="{{ route('plans.search') }}" method="post">
                @csrf
                <div class="input-group ">
                    <input name="search" type="text" class="form-control" value="{{$filters['search'] ?? ''}}" placeholder="Pesquisar" aria-label="Pesquisar" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Pesquisar</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed table-hover shadow">
                <thead class="thead-dark">
                    <tr>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Preço</th>
                        <th width="100"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($plans as $plan)
                        <tr>
                        <td>{{$plan->id}}</td>
                            <td>{{$plan->name}}</td>
                            <td>{{$plan->description}}</td>
                            <td>{{$plan->price}}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('plans.show', ['plan' => $plan->url]) }}" class="btn btn-warning">Ver</a>
                                    <button type="button" class="btn btn-warning dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
                                      <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#" onclick="setId({{$plan->id}})" data-toggle="modal" data-target="#modal-edit"> Editar</a></li>
                                        <li><a href="#" data-toggle="modal" data-target="#modal-delete{{$plan->url}}"><i class="fa fa-remove"></i> Excluir</a></li>
                                    </ul>
                                    <!-- Modal  de deletar item-->
                                <form action="{{ route('plans.destroy', ['plan'=>$plan->url]) }}" method="post">
                                    @method('delete')
                                    @csrf
                                <div class="modal fade" id="modal-delete{{$plan->url}}" style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Adicionar plano</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <h3>Confirma a exclusão dos dados?</h3>
                                                        <span class="text-danger">* A ação não poderá ser desfeita!</span>
                                                              
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-danger">Excluir dados</button>
                                                    </div>
                                                </div>
                                                <!-- /.modal-content -->
                                            </div>
                                            <!-- /.modal-dialog -->
                                    </div>
                                    </form>
                                  </div>
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $plans->appends($filters)->links() !!}
            @else
                {{ $plans->links() }}                
            @endif
        </div>
    </div>

    

<!-- Modal  de adicionar item-->
    <div class="modal fade" id="modal-add" style="display: none;" aria-hidden="true">
        <form action="{{ route('plans.store') }}" method="POST">
            @csrf
            <div class="modal-dialog modal-xl modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Adicionar plano</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-3">
                        <label for="">Nome:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3">
                        <label for="">Descrição:</label>
                        <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{old('description')}}">
                        @error('description')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3">
                        <label for="">Preço:</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{old('price')}}" pattern="[0-9]+([,\.][0-9]+)?" min="0" step="any">
                        @error('price')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-sm-3">
                        <label for="">Url:</label>
                        <input type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{old('url')}}">
                        @error('url')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>                  
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Salvar dados</button>
            </div>
        </form>
        </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <!-- Modal  de Editar item-->
    <div class="modal fade" id="modal-edit" style="display: none;" aria-hidden="true">        
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Editar plano</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
            </div>
            <div class="modal-body" id="modal-edit-body">
                
            </div>            
        </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
@stop

@section('css')
   
@stop
@section('js')
    <script>    
    function setId(plan_id) {        
        var url = "{{route('plans.index')}}/"+plan_id+"/edit" ;
        console.log(url);
        $('#modal-edit').on('show.bs.modal', function () {
            $('#modal-edit-body').load(url);
        });
    }
    </script>    
@if (Session::has('error'))    
    <script> 
        Swal.fire({
            title: 'Error!',
            text: "{{ Session::get('error') }}",
            icon: 'error',
            confirmButtonText: 'Ok'
          }) </script>    
@endif
@if (Session::has('message'))    
    <script> 
        Swal.fire({
            title: 'Perfeito!',
            text: "{{ Session::get('message') }}",
            icon: 'success',
            confirmButtonText: 'Ok'
          }) 
        </script>    
@endif
@if ($errors->any())

    <script> 
        $('#modal-add').modal('show');
    </script>
    

@endif
@endsection
