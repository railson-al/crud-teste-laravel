@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Nova Ficha </div>

                <div class="card-body">
                    <form method="POST" id="capture-symptoms" action="{{ route('form.covid.create') }}" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="patient-id" id="patient-id" value="{{ old('patient-id') }}">

                        <div class="row mb-3">
                            <label for="cpf" class="col-md-2 col-form-label text-md-end">CPF</label>

                            <div class="col-md-4">
                                <input id="cpf" type="text" class="form-control @error('cpf') is-invalid @enderror" name="cpf" value="{{ old('cpf') }}" required autocomplete="cpf" autofocus>

                            </div>
                            <button type="submit" class="btn btn-success col-md-4 text-md-center">Nova Ficha</button>
                        </div>
                    </form>   
                </div>
            </div>
        </div>

        <div class="col-md-8 mt-2">
            <div class="card">
                <div class="card-header"> Consultas Anteriores </div>

                <div class="card-body">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Resultado</th>
                            <th scope="col"></th>
                            </tr>
                        </thead>

                @foreach($forms as $form)
                 
                        <tbody>
                            <tr>
                            <th scope="row">{{$form->id}}</th>
                            <th scope="row">{{ $form->patient->name}}</th>
                            <th scope="row">{{$form->result}}</th>
                            <th scope="row"> <a href="javascript:void(0)" class="btn btn-warning waves-effect" data-bs-toggle="modal" data-bs-target="#EditPatientModal" onclick='getForm( {{$form->id}} )'>Ver</a></th>
                            </tr>
                          
                        
                @endforeach

                </tbody>
                </table>
                </div>

                    {{-- View form modal --}}
                    <div class="modal fade" id="EditPatientModal" tabindex="-1" aria-labelledby="EditPatientModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="EditPatientModalLabel">Editar Paciente</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="card-body" id="patient">
                                        <span id="">Paciente de ID: </span>
                                        
                                    </div>
                                    
                                    <div class="card-body d-flex wrap" id="symptoms">
                                        <span class="">Sintomas:</span>
                                        <ul class="list-group">

                                        </ul>
                                    </div>

                                    <div class="card-body" id="result">
                                        <span id="">Resultado: </span>
                                        
                                    </div>
                                    
                                   

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" onclick="removeAppends()" data-bs-dismiss="modal">Fechar</button>

                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- View form modal end --}}
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function getForm(id) {
            
           $.get('covid-form/'+id, function(response) {

            $('#patient').append("<span class='list-group-item'>"+response.patient_id+"</span>" );

            var symptoms = response.symptoms.toString();
            var array_symptoms = symptoms.split(',');
            
            array_symptoms.forEach(symptom => {
                console.log(symptom);
                $('.list-group').append("<li class='list-group-item'>"+symptom+"</li>");
            });

            $('#result').append("<span class='list-group-item'>"+response.result+"</span>" );
         

           });
        }

        function removeAppends() {
            $('.list-group .list-group-item').remove();
            $('#patient .list-group-item').remove();
            $('#result .list-group-item').remove();
        }
 
    </script>
@endsection
