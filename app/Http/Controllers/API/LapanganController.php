<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Lapangan;
use Illuminate\Support\Facades\Validator;

class LapanganController extends Controller{

    // tampil
    public function index()
    {
        $datas = Lapangan::all();
        return response()->json([
            'pesan' => 'Data Berhasil Ditemukan',
            'data' => $datas
        ], 200);
    }

    // tampil berdasarkan id
    public function show($id){
        $data = Lapangan::find($id);
        if (empty($data)) {
            return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
        }
        return response()->json(['pesan' => 'Data Berhasil Ditemukan', 'data' => $data], 200);
    }

    // create
    public function store(Request $request){
        $validasi = Validator::make($request->all(), [
            'id' => 'required|numeric|unique:lapangan',
            'jenis_lapangan' => 'required',
            'fasilitas' => 'required',
            'keterangan' => 'required'
        ]);
        if ($validasi->fails()) {
            return response()->json(['pesan' => 'data gagal ditambahkan', 'data' => $validasi->errors()->all()], 404);
        }
        $data = Lapangan::create($request->all());
        return response()->json(['pesan' => 'data berhasil ditambahkan', 'data' => $data], 200);
    }

    // update
    public function update(Request $request, $id){
        $lapangan = Lapangan::find($id);
        if (empty($lapangans)) {
            return response()->json(['pesan' => 'data tidak ditemukan', 'data' => ''], 404);
        } else {
            $validasi = Validator::make($request->all(), [
                'id' => 'required|numeric|unique:lapangan',
                'jenis_lapangan' => 'required',
                'fasilitas' => 'required',
                'keterangan' => 'required|numeric'
            ]);
            if ($validasi->fails()) {
                return response()->json(['pesan' => 'Data Gagal diUpdate', 'data' => $validasi->errors()->all()], 404);
            }
            $lapangans->update($request->all());
            return response()->json(['pesan' => 'Data Berhasil disimpan', 'data' => $lapangans], 200);
        }
    }

    // Hapus
    public function destroy($id){
        $lapangans = Lapangan::find($id);
        if (empty($lapangans)) {
            return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
        }
        $lapangans->delete();
        return response()->json(['pesan' => 'Data Berhasil dihapus', 'data' => $lapangans]);
    }
    
    //relasi
    public function lapanganRelasi(){
        $lapangans = Lapangan::with('boking')->get();
        return response()->json(['pesan' => 'Data Berhasil ditemukan', 'data' => $lapangans],200);
    }
    
}