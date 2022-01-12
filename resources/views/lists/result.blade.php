@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Resultado </div>
                    <div class="d-flex justify-content-center mt-3">
                        <span class="card-title fw-bolder">STATUS:&nbsp;</span>
                        <span class="card-title fw-bolder @if($response['result'] !== 'SINTOMAS INSUFICIENTES') text-danger @else text-info @endif" for="">{{ $response['result'] }}</span>
                    </div>

                    <div class="d-flex justify-content-center">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="fw-bold text-center">Sintomas</th>
                                </tr>
                            </thead>
                            
                           
                            
                            <tbody>
                                @foreach ($response['symptoms'] as $symptom)
                                <tr>
                                    <th scope="row" class="">{{ $symptom }}</th>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center m-4">
                        <span class="bg-primary text-light fw-bold w-100 p-1 text-center">Percentual: {{ $response['percent'] }}%</span>
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
