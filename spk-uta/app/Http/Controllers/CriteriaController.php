<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CriteriaController extends Controller
{
    public function create()
    {
        return view('alternatives.create_criteria');
    }

    public function store(Request $request)
    {
        $criteria = [];
        foreach ($request->input('criteria') as $index => $name) {
            $criteria[] = [
                'name' => $name,
                'weight' => $request->input('weights')[$index],
            ];
        }
        session()->put('criteria', $criteria);

        return redirect()->route('alternatives.index');
    }
}
