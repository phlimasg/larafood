@extends('adminlte::page')

@section('title', "Plano: {$plan->name}")

@section('content_header')    
        <h1>Detalhes do plano <b>{{$plan->name}}</b></h1>   
@stop

@section('content')
  
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="/">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
      <li class="breadcrumb-item active" aria-current="page">Detalhes</li>
    </ol>
  </nav>

    <div class="card ">
        <div class="card-header">
            {{$plan->name}}
        </div>
        <div class="card-body">
            <ul>
                <li>
                    <b>Nome do plano:</b> {{$plan->name}}
                </li>
                <li>
                    <b>Url do plano:</b> {{$plan->url}}
                </li>
                <li>
                    <b>Descrição do plano:</b> {{$plan->description}}
                </li>
                <li>
                    <b>Preço:</b> R$: {{number_format($plan->price, 2, ',','.')}}
                </li>
            </ul>
        </div>
    </div>
@endsection