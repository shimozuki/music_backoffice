<?php

namespace App\Http\Controllers;

use App\Models\AboutModel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AbourController extends Controller
{
    public function index()
    {
        return view('dashboard.about.index', [
            'data' => AboutModel::all(),
        ]);
    }

    public function edit($id)
    {
        $data = AboutModel::find($id);
        return view('dashboard.about.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'description' => 'required',
        ]);
        $validatedData['description'] = Str::limit(strip_tags($validatedData['description']), 150, '...');

        AboutModel::where('id', $id)->update($validatedData);

        return redirect()->route('about.index')->with('success', 'Your post has been updated!');

    }
}
