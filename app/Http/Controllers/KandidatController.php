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
    public function edit()
    {
        $kandidats = Kandidat::all();

        return view('admin')->with('kandidats', $kandidats);
    }

    public function hasil()
    {
        $kandidatTertinggi = Kandidat::orderBy('suara', 'desc')->first();

        return view('result', compact('kandidatTertinggi'));
    }

    // Method untuk tambah suara
    public function tambahSuara($id)
    {
        $kandidat = Kandidat::find($id);
        if ($kandidat) {
            $kandidat->increment('suara');
            $kandidat->save();
            
            return response()->json([
                'success' => true,
                'kandidat' => $kandidat
            ]);
        }
        return response()->json(['success' => false]);
    }

    // Method untuk kurang suara
    public function kurangSuara($id)
    {
        $kandidat = Kandidat::find($id);
        if ($kandidat) {
            $kandidat->decrement('suara');
            $kandidat->save();
            
            return response()->json([
                'success' => true,
                'kandidat' => $kandidat
            ]);
        }
        return response()->json(['success' => false]);
    }


    public function getSuara()
    {
        // Ambil semua kandidat dan data suaranya
        $kandidats = Kandidat::all();

        // Kembalikan response JSON berisi data kandidat dan suara
        return response()->json([
            'kandidats' => $kandidats
        ]);
    }

}
