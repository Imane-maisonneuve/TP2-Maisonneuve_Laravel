@extends('layouts.app')
@section('title', 'Mon espace')
@section('content')

<!-- Mes articles -->
<h2 class="mb-4">Mes articles</h2>

<div class="row">
    @forelse($forums as $forum)
    <div class="col-12 mb-4">
        <div class="card h-100">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{ $forum->title }}</h5>
                <p class="card-text">{{ $forum->article }}</p>
                <p class="card-text">
                    Écrit le : {{ $forum->createDate->format('Y-m-d') }}
                </p>
            </div>
            <div class="d-flex justify-content-end gap-2 mt-auto pb-3 pe-3">
                <a href="{{ route('forum.edit', $forum->id) }}" class="btn btn-secondary">
                    Modifier
                </a>

                <form action="{{ route('forum.destroy', $forum->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" class="btn btn-danger" value="Supprimer">
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="alert alert-danger">Aucun article</div>
    @endforelse
</div>

<!-- Formulaire pour ajouter un article -->
<div class="row justify-content-center mt-5 mb-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Ajouter un article</h5>
            </div>
            <div class="card-body">
                <form action="{{ route('forum.store') }}" method="post">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Titre</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Article</label>
                        <textarea class="form-control" name="article" rows="5">{{ old('article') }}</textarea>
                    </div>

                    <button class="btn btn-primary">Ajouter</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Mes documents -->
<h2 class="mb-4">Mes documents</h2>

<div class="row">
    @forelse($repertoires as $repertoire)
    <div class="col-12 mb-4">
        <div class="card h-100">
            <div class="card-body d-flex flex-column">
                <h5 class="card-title">{{ $repertoire->title }}</h5>

                <p class="card-text">
                    Langue : {{ strtoupper($repertoire->language) }}
                </p>

                <p class="card-text">
                    Date : {{ $repertoire->createDate->format('Y-m-d') }}
                </p>

                <p class="card-text">
                    Fichier : {{ basename($repertoire->file) }}
                </p>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-auto pb-3 pe-3">
                <a href="{{ route('repertoire.edit', $repertoire->id) }}" class="btn btn-secondary">
                    Modifier
                </a>
                <form action="{{ route('repertoire.destroy', $repertoire->id) }}" method="post">
                    @csrf
                    @method('delete')
                    <input type="submit" class="btn btn-danger" value="Supprimer">
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="alert alert-danger">Aucun document</div>
    @endforelse
</div>

<!-- Formulaire pour ajouter un document -->
<div class="row justify-content-center mt-5 mb-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Ajouter un document</h5>
            </div>
            <div class="card-body">

                <form action="{{ route('repertoire.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Titre</label>
                        <input type="text" class="form-control" name="title">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Langue</label>
                        <select name="language" class="form-control">
                            <option value="fr">Français</option>
                            <option value="en">English</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Fichier</label>
                        <input type="file" class="form-control" name="file">

                        @error('file')
                        <div class="text-danger mt-2">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>

                    <button class="btn btn-primary">Ajouter document</button>
                </form>


            </div>
        </div>
    </div>
</div>

@endsection