<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tbl_gimcana;


class modalGincamasController extends Controller
{
    public function index()
    {
        $modal = tbl_gimcana::all();
        return view('modal.index', compact('modal'));
    }
}
