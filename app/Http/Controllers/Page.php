<?php

namespace App\Http\Controllers;

use Auth;
use Route;
use Redirect;
use Illuminate\Http\Request;

class Page extends Controller
{
    private $USER   = null;

    public function __construct() {
        $this->middleware(function ($request, $next) {
            if (Auth::Check()) {
                $this->USER = [
                    'ID'        => Auth::id(),
                    'CREATED'   => Auth::user()->created_at
                ];
            }
            return $next($request);
        });
    }

    public function index(Request $request) {
        if (!is_null($this->USER))
            return redirect()->route('home');
        return view('public.index');
    }
}
