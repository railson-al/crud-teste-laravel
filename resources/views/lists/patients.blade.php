@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    Lista de Pacientes
                    <a class="btn btn-success" href="#" data-bs-toggle="modal" data-bs-target="#createPatientModal">Novo Paciente</a>
                </div>


                <!-- Modal -->
                <div class="modal fade" id="createPatientModal" tabindex="-1" aria-labelledby="createPatientModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createPatientModal">Novo Paciente</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" id="patients-form" action="{{ route('create.patient') }}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="row mb-3">
                                        <label for="name" class="col-md-4 col-form-label text-md-end">Nome Completo</label>

                                        <div class="col-md-6">
                                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                            @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="phone" class="col-md-4 col-form-label text-md-end">Telefone</label>

                                        <div class="col-md-6">
                                            <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                                            @error('phone')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="age" class="col-md-4 col-form-label text-md-end">Idade</label>

                                        <div class="col-md-6">
                                            <input id="age" type="text" class="form-control @error('age') is-invalid @enderror" name="age" required autocomplete="new-password">

                                            @error('age')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="cpf" class="col-md-4 col-form-label text-md-end">CPF</label>

                                        <div class="col-md-6">
                                            <input id="cpf" type="text" class="form-control" name="cpf" required autocomplete="cpf" maxlength="11">
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <label for="file_path" class="col-md-4 col-form-label text-md-end">Foto 3x4</label>

                                        <div class="col-md-6">
                                            <input id="file_path" type="file" class="form-control-file" name="file_path" required autocomplete="file_path">
                                        </div>
                                    </div>


                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-primary"> Registrar </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal Fim -->

                <!-- Listagem de Pacientes -->

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
                                <th scope="row">{{ $patient->name}}</th>
                                <th scope="row">{{$patient->phone}}</th>
                                <th scope="row">
                                    <a href="javascript:void(0)" class="btn btn-warning waves-effect" data-bs-toggle="modal" data-bs-target="#EditPatientModal" onclick='getPatient( {{$patient->id}} )'>Editar</a>
                                </th>
                                <th scope="row">
                                    <a href="#" data-id="{{$patient->id}}" class="btn btn-danger" data-action="#">
                                        Excluir
                                    </a>
                                </th>
                            </tr>

                            @endforeach

                        </tbody>
                    </table>
                    <!-- Fim da Listagem de Pacientes -->
                    <!-- Edit Modal -->
                    <div class="modal fade" id="EditPatientModal" tabindex="-1" aria-labelledby="EditPatientModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="EditPatientModalLabel">Editar Paciente</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form id="patients-form-edit" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('POST')
                                        <input type="hidden" name="patient-id" id="patient-id">

                                        <div class="row mb-3">
                                            <label for="name" class="col-md-4 col-form-label text-md-end">Nome Completo</label>

                                            <div class="col-md-6">
                                                <input id="name-edit" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus>

                                                @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="phone" class="col-md-4 col-form-label text-md-end">Telefone</label>

                                            <div class="col-md-6">
                                                <input id="phone-edit" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" required autocomplete="phone">

                                                @error('phone')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="age" class="col-md-4 col-form-label text-md-end">Idade</label>

                                            <div class="col-md-6">
                                                <input id="age-edit" type="text" class="form-control @error('age') is-invalid @enderror" name="age" required autocomplete="new-password">

                                                @error('age')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="cpf" class="col-md-4 col-form-label text-md-end">CPF</label>

                                            <div class="col-md-6">
                                                <input id="cpf-edit" type="text" class="form-control" name="cpf" required autocomplete="cpf" maxlength="11">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="file_path" class="col-md-4 col-form-label text-md-end">Foto 3x4</label>

                                            <div class="col-md-6">
                                                <input id="file_path-edit" type="file" class="form-control-file" name="file_path" autocomplete="file_path">
                                            </div>
                                        </div>


                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Salvar</button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    <!-- Edit Modal Fim -->

                </div>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
        function getPatient(id) {
            
            $.get('/patients/' + id + '/edit', function(patient) {
    
                if (typeof patient === 'undefined') {
                    alert(response);
                    return; 
                    
                };
    
                $('#name-edit').val(patient.name);
                $('#phone-edit').val(patient.phone);
                $('#age-edit').val(patient.age);
                $('#cpf-edit').val(patient.cpf);
                $('#patient-id').val(patient.id);
    
                return;
            });    
        }
 
    </script>

@endsection


