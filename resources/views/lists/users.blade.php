@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

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
                                <th scope="col">Email</th>
                                <th scope="col"></th>
                                </tr>
                            </thead>

                    <h2>Usuários</h2>
                    @foreach($users as $user)
                     
                            <tbody>
                                <tr>
                                <th scope="row">{{$user->id}}</th>
                                <td>{{ $user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>Deletar</td>
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
