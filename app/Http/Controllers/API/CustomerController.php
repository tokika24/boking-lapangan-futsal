<?php
namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Customer;

use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller{
    
    // tampil
    public function index(){
        $datas = Customer::all();
        return response()->json([
            'pesan' => 'Data Berhasil Ditemukan',
            'data' => $datas
        ], 200);
    }

    // tampil berdasarkan id
    public function show($id){
        $data = Customer::find($id);
        if (empty($data)) {
            return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
        }
        return response()->json(['pesan' => 'Data Berhasil Ditemukan', 'data' => $data], 200);
    }

    // create
    public function store(Request $request){
        $validasi = Validator::make($request->all(), [
            'id' => 'required|unique:customer',
            'nama_team' => 'required',
            'penanggung' => 'required',
            'no_telp' => 'required',
            'alamat' => 'required'
        ]);
        if ($validasi->fails()) {
            return response()->json(['pesan' => 'data gagal ditambahkan', 'data' => $validasi->errors()->all()], 404);
        }
        $data = Customer::create($request->all());
        return response()->json(['pesan' => 'data berhasil ditambahkan', 'data' => $data], 200);
    }

    // update
    public function update(Request $request, $id){
        $customers = Customer::find($id);
        if (empty($customers)) {
            return response()->json(['pesan' => 'data tidak ditemukan', 'data' => ''], 404);
        } else {
            $validasi = Validator::make($request->all(), [
                'nama_team' => 'required',
                'penanggung' => 'required',
                'no_telp' => 'required',
                'alamat' => 'required'
            ]);
            if ($validasi->fails()) {
                return response()->json(['pesan' => 'Data Gagal diUpdate', 'data' => $validasi->errors()->all()], 404);
            }
            $customers->update($request->all());
            return response()->json(['pesan' => 'Data Berhasil disimpan', 'data' => $customers], 200);
        }
    }

    // Hapus
    public function destroy($id){
        $customers = Customer::find($id);
        if (empty($customers)) {
            return response()->json(['pesan' => 'Data Tidak ditemukan', 'data' => ''], 404);
        }
        $customers->delete();
        return response()->json(['pesan' => 'Data Berhasil dihapus', 'data' => $customers]);
    }

    //relasi
    public function customerRelasi(){
        $customers = Customer::with('boking')->get();
        return response()->json(['pesan' => 'Data Berhasil ditemukan', 'data' => $customers],200);
    }
}
