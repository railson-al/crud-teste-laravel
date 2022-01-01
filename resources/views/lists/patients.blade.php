@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    Lista de Pacientes 
                    <a class="btn btn-success" href="{{ route('form.patient') }}">Novo Paciente</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <table class="table">
                            <thead>
                                <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nome</th>
                                <th scope="col">Telefone</th>
                                <th scope="col"></th>
                                <th scope="col"></th>
                                </tr>
                            </thead>

                    <h2>Usuários</h2>
                    @foreach($patients as $patient)
                     
                            <tbody>
                                <tr id="patient-container-{{ $patient->id }}">
                                <th scope="row">{{$patient->id}}</th>
                                <td>{{ $patient->name}}</td>
                                <td>{{$patient->phone}}</td>
                                <td><a href="patients/{{$patient->id}}/edit" class="btn btn-warning">Editar</a></td>
                                <td>
                                    <meta name="csrf-token" content="{{ csrf_token() }}">
                                    <a href="#" 
                                        data-id="{{$patient->id}}"
                                        class="btn btn-danger"
                                        data-action="#">
                                        Excluir
                                    </a>
                                </td>
                                </tr>
                              
                            
                    @endforeach

                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
