@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Menu</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div>
                    <a class="btn btn-primary mb-3" href="{{ route('lists.patients') }}">Pacientes</a>
                    </div>


                    <div>
                    <a class="btn btn-danger mb-3" href="{{ route('form.covid') }}">Formulário de Consulta</a>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
