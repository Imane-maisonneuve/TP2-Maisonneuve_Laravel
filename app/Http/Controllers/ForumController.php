<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ForumController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $forums = Forum::select('forums.*', 'users.name')
            ->join('users', 'forums.user_id', '=', 'users.id')
            ->orderBy('createDate', 'DESC')
            ->get();

        return view('forum.index', ['forums' => $forums]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function user()
    {
        $forums = Forum::select('forums.*', 'users.name')
            ->join('users', 'forums.user_id', '=', 'users.id')
            ->where('forums.user_id', '=', Auth::user()->id)
            ->get();
        return view('forum.user', ['forums' => $forums]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'title' => 'required|string|min:10|max:100',
                'article' => 'required|min:20|max:1000'
            ],
            [],
            ['user_id' => 'User']
        );

        $forum = Forum::create([
            'title' => $request->title,
            'article' => $request->article,
            'user_id' => Auth::user()->id,
            'createDate' => now(),
        ]);

        return redirect()->route('forum.user')->with('success', 'L’article a été créé avec succès!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Forum $forum)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Forum $forum)
    {
        return view('forum.edit', ['forum' => $forum]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Forum $forum)
    {
        $request->validate(
            [
                'title' => 'required|string|min:10|max:100',
                'article' => 'required|min:20|max:1000'
            ],
            [],
            ['user_id' => 'User']
        );

        $forum->update([
            'title' => $request->title,
            'article' => $request->article
        ]);

        return redirect()->route('forum.user', $forum->id)->with('success', 'L’article a été mis à jour avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Forum $forum)
    {
        $forum->delete();
        return redirect()->route('forum.user')->withSuccess('L’article est supprimé avec succès!');
    }
}
