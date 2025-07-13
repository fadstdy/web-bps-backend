<?php

namespace App\Http\Controllers;

use App\Models\Publikasi;
use Illuminate\Http\Request;

class PublikasiController extends Controller
{
    public function index() 
    {
        return Publikasi::all();
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'releaseDate' => 'required|date',
            'description' => 'nullable|string',
            'coverUrl' => 'nullable|url',
        ]);
    
        $publikasi = Publikasi::create($validated);
        return response()->json($publikasi, 201);
    }

    // fungsi untuk menampilkan detail publikasi
    public function show($id)
    {
        $publikasi = Publikasi::find($id);

        if (!$publikasi) {
            return response()->json([
                'message' => 'Publikasi tidak ditemukan.'
            ], 404);
        }

        return response()->json([
            'data' => $publikasi
        ]);
    }

    // fungsi untuk mengubah data publikasi
    public function update(Request $request, $id)
    {
        $publikasi = Publikasi::find($id);

        if (!$publikasi) {
            return response()->json(['message' => 'Publikasi tidak ditemukan'], 404);
        }

        // Validasi input (opsional tapi disarankan)
        $validated = $request->validate([
            'title' => 'string|nullable',
            'releaseDate' => 'date|nullable',
            'description' => 'string|nullable',
            'coverUrl' => 'url|nullable',
        ]);

        // Update data
        $publikasi->update($validated);

        return response()->json([
            'message' => 'Publikasi berhasil diperbarui',
            'data' => $publikasi
        ]);
    }

    // fungsi untuk menghapus data publikasi
    public function destroy($id)
    {
        $publikasi = Publikasi::find($id);

        if (!$publikasi) {
            return response()->json(['message' => 'Publikasi tidak ditemukan'], 404);
        }

        $publikasi->delete();

        return response()->json(['message' => 'Publikasi berhasil dihapus']);
    }

}


