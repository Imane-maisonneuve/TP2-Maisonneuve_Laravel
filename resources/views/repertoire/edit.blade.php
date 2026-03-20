@extends('layouts.app')
@section('title', 'Modifier document')
@section('content')

<h1 class="mt-5 mb-4">Modifier le document</h1>

<div class="row justify-content-center">
    <div class="col-md-8">

        <div class="card">
            <div class="card-body">

                <form action="{{ route('repertoire.update', $repertoire->id) }}" method="POST">
                    @csrf
                    @method('PUT')


                    <div class="mb-3">
                        <label class="form-label">Titre</label>
                        <input type="text" name="title" class="form-control"
                            value="{{ old('title', $repertoire->title) }}">

                        @error('title')
                        <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="mb-3">
                        <label class="form-label">Langue</label>
                        <select name="language" class="form-control">

                            <option value="fr" {{ old('language', $repertoire->language) == 'fr' ? 'selected' : '' }}>
                                Français
                            </option>

                            <option value="en" {{ old('language', $repertoire->language) == 'en' ? 'selected' : '' }}>
                                English
                            </option>

                        </select>

                        @error('language')
                        <div class="text-danger mt-2">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary">
                            Mettre à jour
                        </button>
                    </div>

                </form>

            </div>
        </div>

    </div>
</div>

@endsection