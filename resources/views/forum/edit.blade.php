@extends('layouts.app')
@section('title', 'Edit forum')
@section('content')

<div class="row justify-content-center mt-5 mb-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Mettre à jour l'article</h5>
            </div>
            <div class="card-body">
                <form method="post">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label for="title" class="form-label">Titre de l’article</label>
                        <input type="text" class="form-control" id="title" name="title" value="{{old('title', $forum->title) }}">
                        @if($errors->has('title'))
                        <div class="text-danger mt-2">
                            {{$errors->first('title')}}
                        </div>
                        @endif
                    </div>

                    <div class="mb-3">
                        <label for="article" class="form-label">Article</label>
                        <textarea class="form-control" id="article" name="article" rows="5">{{old('article', $forum->article)}}</textarea>
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

@endsection