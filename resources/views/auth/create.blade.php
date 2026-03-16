@extends('layouts.app')
@section('title', 'Login')
@section('content')

@if(!$errors->isEmpty())
<div class="alert alert-danger mt-5 alert-dismissible fade show" role="alert"">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type=" button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="row justify-content-center mt-5 mb-5">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Connectez-vous!</h5>
            </div>
            <div class="card-body">
                <form method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail *</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{old('email')}}">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Mpot de passe *</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-primary mb-3">Se connecter</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection