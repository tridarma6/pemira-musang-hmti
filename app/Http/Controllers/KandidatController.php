<?php

namespace App\Http\Controllers;

use App\Models\Kandidat;
use Illuminate\Http\Request;

class KandidatController extends Controller
{
    public function index()
    {
        $kandidats = Kandidat::all();

        return view('welcome')->with('kandidats', $kandidats);
    }

    public function hasil()
    {
        $kandidatTertinggi = Kandidat::orderBy('suara', 'desc')->first();

        return view('result', compact('kandidatTertinggi'));
    }

    public function tambahSuara(Request $request, $id)
    {
        $kandidat = Kandidat::findOrFail($id);
    
        // Tambahkan suara
        $kandidat->increment('suara');
    
        // Kirimkan respons JSON
        return response()->json([
            'success' => true,
            'message' => 'Suara berhasil ditambahkan!',
            'kandidat' => $kandidat
        ]);
    }
    public function kurangSuara(Request $request, $id)
    {
        $kandidat = Kandidat::findOrFail($id);
    
        // Tambahkan suara
        $kandidat->decrement('suara');
    
        // Kirimkan respons JSON
        return response()->json([
            'success' => true,
            'message' => 'Suara berhasil dikurangkan!',
            'kandidat' => $kandidat
        ]);
    }
}
