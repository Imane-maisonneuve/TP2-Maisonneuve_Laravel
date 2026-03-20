<?php

namespace App\Http\Controllers;

use App\Models\Forum;
use App\Models\Repertoire;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function index()
    {
        $forums = Forum::select('forums.*', 'users.name')
            ->join('users', 'forums.user_id', '=', 'users.id')
            ->where('forums.user_id', '=', Auth::user()->id)
            ->orderBy('createDate', 'DESC')
            ->get();

        $repertoires = Repertoire::select('repertoires.*', 'users.name')
            ->join('users', 'repertoires.user_id', '=', 'users.id')
            ->where('repertoires.user_id', '=', Auth::user()->id)
            ->orderBy('createDate', 'DESC')
            ->get();

        return view('user.index', ['forums' => $forums, 'repertoires' => $repertoires]);
    }
}
