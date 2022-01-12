@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Nova Ficha</div>

                <div class="card-body">
                    <form method="POST" id="capture-symptoms" action="{{ route('form.covid.create') }}" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="patient-id" id="patient-id" value="{{ $patient->name }}">

                        <div class="row mb-3">
                            <label for="cpf" class="col-md-2 col-form-label text-md-end">CPF</label>

                            <div class="col-md-4">
                                <input id="cpf" type="text" class="form-control @error('name') is-invalid @enderror" name="cpf" value="{{ old('cpf') }}" required autocomplete="cpf" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <button type="submit" class="btn btn-success col-md-4 text-md-center">Nova Ficha</button>
                        </div>
                    </form>   
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <div class="col-md-8">
            <div class="card">
                <form id="capture-symptoms-send" action="{{ route('form.covid.create.result') }}" method="post">
                    @csrf

                    <input type="hidden" name="cpf" value="{{ $patient->cpf }}">
                    <input type="hidden" name="user_id" id="user_id" value="{{auth()->user()->id}}">


                    <div class="card-header">
                        <label class="form-check-label">Paciente:</label>
                        <label class="form-check-label">{{ $patient->name }}</label>
                    </div>
                    <div class="card-body" id="symtoms-container">  
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="symptoms[]" value="FEBRE">
                            <label class="form-check-label">Febre</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="symptoms[]" value="CORIZA">
                            <label class="form-check-label">Coriza</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="symptoms[]" value="NARIZ ENTUPIDO">
                            <label class="form-check-label">Nariz Entupido</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="symptoms[]" value="CANSAÇO">
                            <label class="form-check-label">Cansaço</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="symptoms[]" value="TOSSE">
                            <label class="form-check-label">Tosse</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="symptoms[]" value="DOE DE CABEÇA">
                            <label class="form-check-label">Dor de Cabeça</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="symptoms[]" value="DORES NO CORPO">
                            <label class="form-check-label">Dores no corpo</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="symptoms[]" value="MAL ESTAR">
                            <label class="form-check-label">Mal Estar Geral</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="symptoms[]" value="DOR DE GARGANTA">
                            <label class="form-check-label">Dor de Garganta</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="symptoms[]" value="DIFICULDADE DE RESPIRAR">
                            <label class="form-check-label">Dificuldade de Respirar</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="symptoms[]" value="FALTA DE PALADAR">
                            <label class="form-check-label">Falta de Paladar</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="symptoms[]" value="FALTA DE OLFATO">
                            <label class="form-check-label">Falta de Olfato</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="symptoms[]" value="DIFICULDADE DE LOCOMOÇÃO">
                            <label class="form-check-label">Dificuldade de Locomoção</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="symptoms[]" value="DIARREIA">
                            <label class="form-check-label">Diarreia</label>
                        </div>

                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-success col-md-2 text-md-center mb-2">Enviar</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
