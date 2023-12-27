<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SejarahumumModel;
use Illuminate\Support\Str;

class SejarahumumCOntroller extends Controller
{
    public function index()
    {
        return view('dashboard.sejarah_umum.index', [
            'data' => SejarahumumModel::all(),
        ]);
    }

    public function edit($id)
    {
        $data = SejarahumumModel::find($id);
        return view('dashboard.sejarah_umum.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'description' => 'required',
        ]);
        $validatedData['description'] = Str::limit(strip_tags($validatedData['description']), 150, '...');

        SejarahumumModel::where('id', $id)->update($validatedData);

        return redirect()->route('sejarah_umum.index')->with('success', 'Your post has been updated!');

    }
}
