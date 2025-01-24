<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\Cuti;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(){
        if (request()->ajax()) {
            $data = User::where('role','admin')->get(); 
            return DataTables::of($data)->make(true);
        }
        return view('admin-page.admin.index',);
    }

    public function submit(Request $request){
        $validator = Validator::make($request->all(), [
            'nama_depan' => 'required|string',
            'nama_belakang' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
            'password_confirm' => 'required|same:password',
        ]);
        
        if($validator->fails()){
            $messages = $validator->messages();
            $alertMessage = $messages->first(); 
            return back()->with(['error' => $alertMessage]);
        }

        User::create([
            'nama_depan' => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'email' => $request->email,
            'role' => 'admin',
            'password' => Hash::make($request->password),
        ]);

        return redirect('/admin')->with('success', 'Data Berhasil Dibuat.');
    }

    public function edit($id){
        $data = User::find($id);
        return view('admin-page.admin.edit', compact('data'));
    }

    public function update(Request $request, $id){
        $validator = Validator::make($request->all(), [
            'nama_depan' => 'required|string',
            'nama_belakang' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string',
            'password_confirm' => 'required|same:password',
        ]);
        
        if($validator->fails()){
            $messages = $validator->messages();
            $alertMessage = $messages->first(); 
            return back()->with(['error' => $alertMessage]);
        }

        $data = User::find($id);
        $data->update([
            'nama_depan' => $request->nama_depan,
            'nama_belakang' => $request->nama_belakang,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        

        return redirect('/admin')->with('success', 'Data Berhasil Diupdate.');
    }
    
    public function delete($id){
        $data = User::find($id);
        $cuti = Cuti::where('user_id',$id);
        $cuti->delete();
        $data->delete();
        return redirect('/admin')->with('success', 'Data Berhasil Dihapus.');
    }

    

}
