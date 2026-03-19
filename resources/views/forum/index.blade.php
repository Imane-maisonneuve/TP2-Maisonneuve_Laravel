@extends('layouts.app')
@section('title', 'Forums List')
@section('content')
<h1 class="mt-5 mb-4">Liste des Articles </h1>
<div class="row">
    @forelse($forums as $forum)
    <div class="col-12 mb-4">
        <div class="card h-100">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{ $forum->title }}</h5>
                <p class="card-text">{{ $forum->article }}</p>
                <p class="card-text">Écrit par <span class="fw-bold">{{ $forum->name }}</span> le : {{ $forum->createDate->format('Y-m-d') }}</p>
            </div>
        </div>
    </div>
    @empty
    <div class="alert alert-danger">Liste des articles vide!</div>
    @endforelse
</div>
@endsection