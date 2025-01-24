<?php

namespace App\Http\Controllers;

use Validator;
use Carbon\Carbon;
use App\Models\Cuti;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CutiController extends Controller
{
    public function index(){
        $pegawai = User::where('role','pegawai')->get();
        if (request()->ajax()) {
            $data = Cuti::with('user')->get(); 
            return DataTables::of($data)->make(true);
        }
        return view('admin-page.cuti.index',compact('pegawai'));
    }

    public function submit(Request $request){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'alasan' => 'required|string',
           'tgl_mulai' => 'required|date|before_or_equal:tgl_selesai',
        'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
        ]);
        
        if($validator->fails()){
            $messages = $validator->messages();
            $alertMessage = $messages->first(); 
            return back()->with(['error' => $alertMessage]);
        }

        $now = now()->year;
        $cutiTahunIni = Cuti::where('user_id', $request->user_id)
            ->whereYear('tgl_mulai', $now)
            ->get();

        $totalHariCutiTahunIni = $cutiTahunIni->reduce(function ($carry, $cuti) {
            $tglMulai = Carbon::parse($cuti->tgl_mulai);
            $tglSelesai = Carbon::parse($cuti->tgl_selesai);
            return $carry + $tglMulai->diffInDays($tglSelesai) + 1; // +1 karena inklusif
        }, 0);

        $tglMulaiBaru = Carbon::parse($request->tgl_mulai);
        $tglSelesaiBaru = Carbon::parse($request->tgl_selesai);
        $jumlahHariCutiBaru = $tglMulaiBaru->diffInDays($tglSelesaiBaru) + 1; // +1 karena inklusif

        if ($totalHariCutiTahunIni + $jumlahHariCutiBaru > 5) {
           
            return back()->with(['error' => 'Pengajuan cuti ditolak. Total hari cuti dalam satu tahun tidak boleh melebihi 5 hari.']);
        }else{

            Cuti::create([
                'user_id' => $request->user_id,
                'alasan' => $request->alasan,
                'tgl_mulai' => $request->tgl_mulai,
                'tgl_selesai' => $request->tgl_selesai,
            ]);
        }

        return redirect('/cuti')->with('success', 'Data Berhasil Dibuat.');
    }

    public function edit($id){
        $data = Cuti::find($id);
        $pegawai = User::where('role','pegawai')->get();
        return view('admin-page.cuti.edit', compact('data','pegawai'));
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'alasan' => 'required|string',
           'tgl_mulai' => 'required|date|before_or_equal:tgl_selesai',
        'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
        ]);
        
        if($validator->fails()){
            $messages = $validator->messages();
            $alertMessage = $messages->first(); 
            return back()->with(['error' => $alertMessage]);
        }
        $now = now()->year;
        $cutiTahunIni = Cuti::where('user_id', $request->user_id)
            ->whereYear('tgl_mulai', $now)
            ->get();

        $totalHariCutiTahunIni = $cutiTahunIni->reduce(function ($carry, $cuti) {
            $tglMulai = Carbon::parse($cuti->tgl_mulai);
            $tglSelesai = Carbon::parse($cuti->tgl_selesai);
            return $carry + $tglMulai->diffInDays($tglSelesai) + 1; // +1 karena inklusif
        }, 0);

        $tglMulaiBaru = Carbon::parse($request->tgl_mulai);
        $tglSelesaiBaru = Carbon::parse($request->tgl_selesai);
        $jumlahHariCutiBaru = $tglMulaiBaru->diffInDays($tglSelesaiBaru) + 1; // +1 karena inklusif

        if ($totalHariCutiTahunIni + $jumlahHariCutiBaru > 5) {
           
            return back()->with(['error' => 'Pengajuan cuti ditolak. Total hari cuti dalam satu tahun tidak boleh melebihi 5 hari.']);
        }else{
            $data = Cuti::find($id);
            $data->update([
                'user_id' => $request->user_id,
                'alasan' => $request->alasan,
                'tgl_mulai' => $request->tgl_mulai,
                'tgl_selesai' => $request->tgl_selesai,
            ]);
        }
        

        return redirect('/cuti')->with('success', 'Data Berhasil Diupdate.');
    }
    
    public function delete($id){
        $cuti = Cuti::find($id);
        $cuti->delete();
        return redirect('/cuti')->with('success', 'Data Berhasil Dihapus.');
    }
}
