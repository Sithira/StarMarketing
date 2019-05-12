<?php

namespace App\Http\Controllers;

use App\Services\TreeBuilder;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getCommissions()
    {
        $commissions = auth()->user()->commissions;

        return view('commissions', compact('commissions'));
    }

    public function getTree()
    {
        $tree = TreeBuilder::render(User::descendantsAndSelf(auth()->id())->toTree());

        return view('tree', compact('tree'));
    }
}
