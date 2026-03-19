<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SetLocaleController extends Controller
{
    public function index(Request $request, $locale)
    {
        if (! in_array($locale, ['en', 'fr'])) {
            abort(400);
        }
        session()->put('locale', $locale);
        return back();
    }
}
