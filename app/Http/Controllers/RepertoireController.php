<?php

namespace App\Http\Controllers;

use App\Models\Repertoire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class RepertoireController extends Controller
{
    /**
     * Afficher tous les documents
     */
    public function index()
    {
        $repertoires = Repertoire::select('repertoires.*', 'users.name')
            ->join('users', 'repertoires.user_id', '=', 'users.id')
            ->orderBy('createDate', 'DESC')
            ->paginate(5);

        return view('repertoire.index', ['repertoires' => $repertoires]);
    }

    /**
     * Afficher les documents de l'utilisateur connecté
     */
    public function user()
    {
        $repertoires = Repertoire::select('repertoires.*', 'users.name')
            ->join('users', 'repertoires.user_id', '=', 'users.id')
            ->where('repertoires.user_id', '=', Auth::user()->id)
            ->orderBy('createDate', 'DESC')
            ->paginate(5);

        return view('user.index', ['repertoires' => $repertoires]);
    }

    /**
     * Enregistrer un nouveau document
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:3|max:100',
            'language' => 'required|in:fr,en',
            'file' => 'required|file|mimes:pdf,zip,doc,docx|max:10240',
        ]);

        $file = $request->file('file');

        $filename = now()->format('Y-m-d_H-i-s') . '_' . $file->getClientOriginalName();

        $path = $file->storeAs('documents', $filename, 'public');

        Repertoire::create([
            'title' => $request->title,
            'file' => $path,
            'language' => $request->language,
            'user_id' => Auth::user()->id,
            'createDate' => now(),
        ]);

        return redirect()->route('user.index')
            ->with('success', 'Le document a été ajouté avec succès!');
    }

    /**
     * Afficher le formulaire de modification
     */
    public function edit(Repertoire $repertoire)
    {
        if ($repertoire->user_id !== Auth::user()->id) {
            abort(403);
        }

        return view('repertoire.edit', ['repertoire' => $repertoire]);
    }

    /**
     * Mettre à jour un document
     */
    public function update(Request $request, Repertoire $repertoire)
    {
        if ($repertoire->user_id !== Auth::user()->id) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|min:3|max:100',
            'language' => 'required|in:fr,en',
        ]);

        $repertoire->update([
            'title' => $request->title,
            'language' => $request->language,
        ]);

        return redirect()->route('user.index')
            ->with('success', 'Document mis à jour avec succès!');
    }

    /**
     * Supprimer un document
     */
    public function destroy(Repertoire $repertoire)
    {
        if ($repertoire->user_id !== Auth::user()->id) {
            abort(403);
        }

        if ($repertoire->file && Storage::disk('public')->exists($repertoire->file)) {
            Storage::disk('public')->delete($repertoire->file);
        }

        $repertoire->delete();

        return redirect()->route('user.index')
            ->with('success', 'Le document est supprimé avec succès!');
    }

    /**
     * Télécharger un document
     */
    public function download(Repertoire $repertoire)
    {
        $path = storage_path('app/public/' . $repertoire->file);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->download($path);
    }
}
