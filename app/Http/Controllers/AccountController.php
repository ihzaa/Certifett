<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Auth;

class AccountController extends Controller
{
    public function tampil()
    {
        $data = Auth::user();
        $data['is_pass_null'] = User::whereId($data->id)->where('password', "")->first();
        return view('frontend.kelolaAkun', ['data' => $data]);
    }

    public function update(Request $request)
    {
        $user = DB::table('users')->where('id', $request->id)->first();


        // dd(Hash::check($request->pass, $user->password));

        if ($request->newPass == Null) {

            if (Hash::check($request->pass, $user->password) == true) {
                DB::table('users')
                    ->where('id', $request->id)
                    ->update([
                        'name' => $request->nama
                    ]);

                return redirect(route('manageAccount-page'))->with('message', 'Berhasil Memberbarui Data Akun!')->with('icon', 'success');
            } else {
                return redirect(route('manageAccount-page'))->with('message', 'Password yg dimasukkan salah!')->with('icon', 'warning');
            }
        } else {

            if (Hash::check($request->pass, $user->password) == true) {
                DB::table('users')
                    ->where('id', $request->id)
                    ->update([
                        'name' => $request->nama,
                        'password' => Hash::make($request->newPass)
                    ]);

                return redirect(route('manageAccount-page'))->with('message', 'Berhasil Memberbarui Data Akun!')->with('icon', 'success');
            } else {
                return redirect(route('manageAccount-page'))->with('message', 'Password yg dimasukkan salah!')->with('icon', 'warning');
            }
        }
    }

    public function FirstPasswordConfig(Request $request)
    {
        User::find(Auth::id())->update(
            [
                "password" => Hash::make($request->pass1)
            ]
        );
        return redirect(route('manageAccount-page'))->with('message', 'Berhasil Memberbarui Data Akun!')->with('icon', 'success');
    }
}
