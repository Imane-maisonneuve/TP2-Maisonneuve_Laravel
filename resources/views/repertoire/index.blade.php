@extends('layouts.app')

@section('title', 'Répertoire')

@section('content')
<h1 class="mb-4">Répertoire</h1>

<table class="table table-bordered table-striped align-middle">
    <thead>
        <tr>
            <th>Titre</th>
            <th>Langue</th>
            <th>Fichier</th>
            <th>Utilisateur</th>
            <th>Date</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($repertoires as $repertoire)
        <tr>
            <td>{{ $repertoire->title }}</td>
            <td>{{ strtoupper($repertoire->language) }}</td>
            <td>{{ basename($repertoire->file) }}</td>
            <td>{{ $repertoire->name }}</td>
            <td>{{ \Carbon\Carbon::parse($repertoire->createDate)->format('Y-m-d') }}</td>
            <td>
                <a href="{{ route('repertoire.download', $repertoire->id) }}" class="btn btn-sm btn-success">
                    Télécharger
                </a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">Aucun document disponible.</td>
        </tr>
        @endforelse
    </tbody>
</table>

<div class="mt-3">
    {{ $repertoires->links('pagination::simple-bootstrap-5') }}
</div>
@endsection