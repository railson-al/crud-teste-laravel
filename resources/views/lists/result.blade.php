@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Resultado</div>
                    <div class="d-flex justify-content-center m-4">
                        <span class="card-title fw-bolder" for="">{{ $response['message'] }}</span>
                    </div>

                    <div class="d-flex justify-content-around wrap">
                        <p class="fw-bold"> Sintomas: </p>
                        @foreach ($response['symptoms'] as $symptom)
                        <p class="gap-1" for="">{{ $symptom }}</p>
                        @endforeach
                    </div>

                    <div class="d-flex justify-content-center m-4">
                        <span maxlength="5" for="">Percentual: {{ $response['percent'] }}%</span>
                    </div>

                    
                <div class="card-body">

                <div class="d-flex justify-content-between m-4">
                    <a href="{{ route('form.covid') }}" class="btn btn-success">Nova Ficha</a>
                    <a href="{{ route('home') }}" class="btn btn-primary">Início</a>

                </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
