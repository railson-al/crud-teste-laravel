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
    </div>
@endsection
