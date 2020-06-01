@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card text-center">
                <div class="card-header">--------------</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (Auth::user()->type == 'enseignant')
                    <div class="alert alert-danger">
                        <h1>ENSEIGNANT</h1>
                    </div>
                    @else
                        <div class="alert alert-danger">
                            <h1>ETUDIANT</h1>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
