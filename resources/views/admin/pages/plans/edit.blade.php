
        <form action="{{ route('plans.update', ['plan' => $plan->id]) }}" method="POST">
            <div class="container-fluid">
                @csrf     
                @method('put')       
                        <div class="row">
                            <div class="col-sm-3">
                                <label for="">Nome:</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$plan->name}}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label for="">Descrição:</label>
                                <input type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{$plan->description}}">
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label for="">Preço:</label>
                                <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{$plan->price}}" min="0" step="any">
                                @error('price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label for="">Url:</label>
                                <input type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{$plan->url}}">
                                @error('url')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div> 
                    
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-primary">Salvar dados</button>
                        </div>                    
            </div>
                                            
        </form>
       