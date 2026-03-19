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
    <div class="alert alert-danger">Liste des articles vide!</div>
    @endforelse
    <div class="row justify-content-center mt-5 mb-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Ajouter un article</h5>
                </div>
                <div class="card-body">
                    <Form action="{{route('forum.store')}}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="title" class="form-label">Titre de l’article</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{old('title') }}">
                            @if($errors->has('title'))
                            <div class="text-danger mt-2">
                                {{$errors->first('title')}}
                            </div>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="article" class="form-label">Article</label>
                            <textarea class="form-control" id="article" name="article" rows="5">{{old('article')}}</textarea>
                            @if($errors->has('article'))
                            <div class="text-danger mt-2">
                                {{$errors->first('article')}}
                            </div>
                            @endif
                        </div>

                        @if(!$errors->isEmpty())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection