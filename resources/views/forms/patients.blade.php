@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Novo Paciente</div>

                <div class="card-body">
                    @if( Request::is('*/edit'))
                    <form method="POST" id="patients-form-edit" action="/patients/{{ $patient->id }}/update" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="patient-id" id="patient-id" value="{{ $patient->id }}">

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">Nome Completo</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $patient->name }}" required autocomplete="name" autofocus>

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
                                <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $patient->phone }}" required autocomplete="phone">

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
                                <input id="age" type="text" class="form-control @error('age') is-invalid @enderror" name="age" required autocomplete="new-password" value="{{$patient->age}}">

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
                                <input id="cpf" type="text" class="form-control" name="cpf" required autocomplete="cpf" maxlength="11" value="{{ $patient->cpf }}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="file_path" class="col-md-4 col-form-label text-md-end">Foto 3x4</label>

                            <div class="col-md-6">
                                <input id="file_path" type="file" class="form-control-file" name="file_path" required autocomplete="file_path" value="{{ $patient->file_path }}">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrar
                                </button>
                            </div>
                        </div>
                    </form>   
                     
                    @else
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

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrar
                                </button>
                            </div>
                        </div>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
