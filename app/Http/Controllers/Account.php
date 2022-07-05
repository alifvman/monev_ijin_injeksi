<?php

namespace App\Http\Controllers;

use Auth;
use Hash;
use Route;
use Redirect;
use App\User;
use App\Orang;
use App\Jobs\SendVerificationEmail;
use App\Jobs\SendPasswordResetEmail;
use Illuminate\Http\Request;

class Account extends Controller
{
    private $USER   = null;
    private $ROUTES = [
        'public'        => ['login', 'forgot', 'register', 'verify', 'reset', 'setpass'],
        'authenticated' => ['logout']
    ];

    public function __construct() {
        $this->middleware(function ($request, $next) {
            $s = 'public';
            if (Auth::Check()) {
                $this->USER = [
                    'ID'        => Auth::id(),
                    'CREATED'   => Auth::user()->created_at
                ];
                $s = 'authenticated';
            }
            if (!in_array(Route::currentRouteName(), $this->ROUTES[$s]))
                return Redirect::to('/');
            return $next($request);
        });
    }

    public function login(Request $request) {
        if (Auth::attempt(array('email' => $request->input('email'), 'password' => $request->input('password')))) {
            $u = User::where('email', $request->input('email'))->first();
            if (is_null($u->email_verified_at)) {
                \App\Log::create(array('ipa'=>$_SERVER['REMOTE_ADDR'], 'log' => $request->input('email') .' unactivated account failed to sign in'));
                Auth::logout();
                return view('public.error')->with(['error'=>'UL.U', 'description'=>'Anda belum melakukan verifikasi email dan aktivasi akun.']);
            }
            \App\Log::create(array('ipa'=>$_SERVER['REMOTE_ADDR'], 'log' => $request->input('email') .' signed in'));
            return Redirect::to('/home');
        } else
            return Redirect::to('/')->withErrors(['Gagal login, silakan cek Email dan Password.'])->withInput($request->except('password'));
    }

    public function forgot(Request $request) {
        $u = User::where('email', $request->input('email'))->first();
        if (!$u)
            return Redirect::to('/')->withErrors(['Email tidak terdaftar.'])->withInput($request->except('password'));
        $u->token = base64_encode('RSTPWD'. $request->input('email') . $u->password);
        if (!$u->save()) {
            \App\Log::create(array('ipa' => $_SERVER['REMOTE_ADDR'], 'log' => $u->email .' failed to update token for password reset'));
            return Redirect::to('/')->withErrors(['Tidak dapat menyimpan token, silakan hubungi Administrator.'])->withInput($request->except('password'));
        }
        \App\Log::create(array('ipa' => $_SERVER['REMOTE_ADDR'], 'log' => $u->email .' request password reset'));
        dispatch(new SendPasswordResetEmail($u));
        return view('public.requested')->with(['nama' => $u->nama, 'email' => $u->email]);
    }

    public function reset($token)
    {
        $u = User::where('token', $token)->first();

        if (!$u)
            return view('public.error')->with(['error'=>'PR.T', 'description'=>'Token tidak ditemukan.']);

        return view('public.reset')->with(['token' => $token]);
    }

    public function setpass(Request $request) {
        $u = User::where('token', $request->input('token'))->first();
        if (!$u)
            return view('public.error')->with(['error'=>'PS.T', 'description'=>'Token tidak ditemukan.']);
        $u->password = Hash::make($request['password']);
        $u->token = null;
        if (!$u->save()) {
            \App\Log::create(array('ipa' => $_SERVER['REMOTE_ADDR'], 'log' => $u->email .' failed to save new password'));
            return view('public.error')->with(['error' => 'PS.U', 'description' => 'Gagal menyimpan password baru, silakan hubungi Administrator.']);
        }
        \App\Log::create(array('ipa' => $_SERVER['REMOTE_ADDR'], 'log' => $u->email .' new password set'));
        return view('public.reseted')->with(['nama' => $u->nama, 'email' => $u->email]);
    }

    public function verify($token) {
        $u = User::where('token', $token)->first();

        if (!$u){
            return view('public.error')->with(['error'=>'DBEV.T', 'description'=>'Token tidak ditemukan.']);
        }

        $u->email_verified_at = now();
        $u->token = null;
        if ($u->save()) {
            \App\Log::create(array('ipa' => $_SERVER['REMOTE_ADDR'], 'log' => $u->email .' verified'));
            $o = Orang::create(array(
                'nama' => $u->nama,
                'jabatan' => '', 'alamat' => '', 'kelurahan' => '', 'kecamatan' => '', 'kota' => '', 'provinsi' => '', 'kodepos' => '', 'telp' => '', 'faks' => '',
                'email' => $u->email
            ));
            $s = $o ? "created" : "failed to create";
            \App\Log::create(array('ipa' => $_SERVER['REMOTE_ADDR'], 'log' => $u->email .' minimal Orang data '. $s));
            return view('public.verified')->with(['nama' => $u->nama, 'email' => $u->email]);
        } else {
            \App\Log::create(array('ipa' => $_SERVER['REMOTE_ADDR'], 'log' => $u->email .' failed to update email verification timestamp'));
            return view('public.error')->with(['error'=>'DBEV.U']);
        }
    }

    public function register(Request $request) {
        $u = User::where('email', $request->input('email'))->first();
        if ($u)
            return Redirect::to('/')->withErrors(['Email sudah terdaftar dalam sistem.'])->withInput($request->except('password'));
        $u = User::create([
            'nama'     => $request->input('nama'),
            'posisi'   => 'BARU',
            'email'    => $request->input('email'),
            'password' => Hash::make($request->input('password')),
            'token'    => base64_encode('VRFEML'. $request->input('email') . Hash::make($request->input('password')))
        ]);
        if (!$u)
            return Redirect::to('/')->withErrors(['Tidak dapat membuat Akun baru, silakan hubungi Administrator.'])->withInput($request->except('password'));
        \App\Log::create(array('ipa' => $_SERVER['REMOTE_ADDR'], 'log' => $u->email .' registered'));
        dispatch(new SendVerificationEmail($u));
        return view('public.registered')->with(['nama' => $u->nama, 'email' => $u->email]);
    }

    public function logout(Request $request) {
        if (Auth::Check()) {
            \App\Log::create(array('ipa' => $_SERVER['REMOTE_ADDR'], 'log' => Auth::user()->email .' signed out'));
            Auth::logout();
        }
        return Redirect::to('/');
    }
}
