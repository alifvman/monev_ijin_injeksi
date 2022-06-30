<?php

namespace App\Http\Controllers;

use App\DokumenPermohonan;
use DB;
use Auth;
use Route;
use App\User;
use App\Role;
use App\Orang;
use App\Perusahaan;
use App\Permohonan;
use App\Tracking;
use App\Document;
use App\StageHandler;
use App\Jobs\SendVerificationEmail;
use App\Jobs\SendPasswordReset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PageController extends Controller
{
    private $USER   = null;
    private $ROUTES = array(
        'index'     => "*",
        'account'   => "public",
        'verify'    => "public",
        'reset'     => "public",
        'signout'   => "member",
        'task'      => "member",
        'search'    => "member",
        'permohonan'=> "member"
    );

    public function __construct() {
        if (!array_key_exists(Route::currentRouteName(), $this->ROUTES))
            return Redirect::to('/');

        $this->middleware(function ($request, $next) {
            $r = $this->ROUTES[Route::currentRouteName()];
            if (Auth::Check()) {
                if ($r == 'public') return Redirect::to('/');
                $this->USER = [
                    'ID'        => Auth::id(),
                    'NAME'      => Auth::user()->name,
                    'EMAIL'     => Auth::user()->email,
                    'POSITION'  => Auth::user()->position,
                    'TITLE'     => Auth::user()->role->name,
                    'STAGES'    => Auth::user()->stages()->get(['stage']),
                    'HANDLES'   => Auth::user()->stages,
                    'CREATED'   => Auth::user()->created_at
                ];
            } else if ($r == 'member') return Redirect::to('/');

            return $next($request);
        });
    }

    public function index(Request $request) {
        if (is_null($this->USER))
            return view('public.index');
        else {
            if ($this->USER['POSITION']=='---') {
                $o = Orang::where('email', $this->USER['EMAIL'])->take(1)->get();
                if (!$o)
                    die("Error E51, silakan hubungi Administrator.");
                $p = Permohonan::where('ref_f3_pengurus', $o[0]['id'])->where('stage', '>', '0')->take(1)->get();
                $d = Document::orderBy('group')->get();
                $s = array(0);
                $f1 = [];
                $f2 = [];
                $f3 = [];
                if (count($p)) {
                    $s = StageHandler::where('stage', $p[0]['stage'])->take(1)->get(['name', 'stage']);
                    $f1 = Orang::where('id', $p[0]['ref_f1_pemohon'])->take(1)->get();
                    $f2 = Perusahaan::where('id', $p[0]['ref_f2_perusahaan'])->take(1)->get();
                    $f3 = Orang::where('id', $p[0]['ref_f3_pengurus'])->take(1)->get();
                }
                $z = StageHandler::get();
                return view('pemohon.permohonan')->with(['USER' => $this->USER, 'DOCUMENTS' => $d, 'PERMOHONAN' => $p, 'F1' => $f1, 'F2' => $f2, 'F3' => $f3, 'Stage' => $s[0], 'STAGES' => $z]);
            } else {
                $t = Permohonan::whereIn('stage', $this->USER['STAGES'])->get(['id', 'nama', 'created_at']);
                $d = Document::orderBy('group')->get();
                return view('member.index')->with(['USER' => $this->USER, 'DOCUMENTS' => $d, 'STAGES' => $this->USER['HANDLES'], 'TASKS' => $t]);
            }
        }
    }

    public function newapp(Request $request) {
        $d = Document::orderBy('group')->get();
        return view('member.newapp')->with(['USER' => $this->USER, 'DOCUMENTS' => $d]);
    }

    public function acorang(Request $request) {
        $o = Orang::where('nama', 'like', '%'.$request['term'].'%')->get(['id', 'nama as label', 'nama as value']);
        return response()
            ->json($o)
            ->withCallback($request->input('callback'));
    }

    public function orangdetail(Request $request) {
        $i = $request['id'];
        $o = Orang::where('id', $i)->take(1)->get();
        $r = $o ? ['error' => 0, 'orang' => $o[0]] : ['error' => 1];
        return response()->json($r);
    }

    public function orangemail(Request $request) {
        $e = $request['email'];
        $o = Orang::where('email', $e)->take(1)->get();
        $r = $o ? ['error' => 0, 'orang' => $o[0]] : ['error' => 1];
        return response()->json($r);
    }

    public function acperusahaan(Request $request) {
        $p = Perusahaan::where('nama', 'like', '%'.$request['term'].'%')->get(['id', 'nama as label', 'nama as value']);
        return response()
            ->json($p)
            ->withCallback($request->input('callback'));
    }

    public function perusahaandetail(Request $request) {
        $i = $request['id'];
        $p = Perusahaan::where('id', $i)->take(1)->get();
        $r = $p ? ['error' => 0, 'perusahaan' => $p[0]] : ['error' => 1];
        return response()->json($r);
    }

    public function permohonan(Request $request) {
        $f1_id = intval($request['f1_id']);
        $f2_id = intval($request['f2_id']);
        $f3_id = 0;
        $f1 = array(
            'nama' => $request['f1_nama'],
            'jabatan' => $request['f1_jabatan'],
            'alamat' => $request['f1_alamat'],
            'kelurahan' => $request['f1_kelurahan'],
            'kecamatan' => $request['f1_kecamatan'],
            'kotakabupaten' => $request['f1_kotakabupaten'],
            'provinsi' => $request['f1_provinsi'],
            'kodepos' => $request['f1_kodepos'],
            'telp' => $request['f1_telp'],
            'faks' => $request['f1_faks'],
            'email' => $request['f1_email']
        );
        $f2 = array(
                'nama' => $request['f2_nama'],
                'alamat' => $request['f2_alamat'],
                'kelurahan' => $request['f2_kelurahan'],
                'kecamatan' => $request['f2_kecamatan'],
                'kotakabupaten' => $request['f2_kotakabupaten'],
                'provinsi' => $request['f2_provinsi'],
                'kodepos' => $request['f2_kodepos'],
                'telp' => $request['f2_telp'],
                'faks' => $request['f2_faks'],
                'email' => $request['f2_email'],
                'kegiatan' => $request['f2_kegiatan'],
                'kegiatan_alamat' => $request['f2_kegiatan_alamat'],
                'kegiatan_kelurahan' => $request['f2_kegiatan_kelurahan'],
                'kegiatan_kecamatan' => $request['f2_kegiatan_kecamatan'],
                'kegiatan_kotakabupaten' => $request['f2_kegiatan_kotakabupaten'],
                'kegiatan_provinsi' => $request['f2_kegiatan_provinsi'],
                'kegiatan_kodepos' => $request['f2_kegiatan_kodepos'],
                'akte' => $request['f2_akte'],
                'npp' => $request['f2_npp'],
                'npwp' => $request['f2_npwp'],
                'produksi' => $request['f2_produksi'],
                'kapasitas' => $request['f2_kapasitas'],
                'kontak' => $request['f2_kontak']
        );
        $f3 = array(
            'nama' => $request['f3_nama'],
            'jabatan' => $request['f3_jabatan'],
            'alamat' => $request['f3_alamat'],
            'kelurahan' => $request['f3_kelurahan'],
            'kecamatan' => $request['f3_kecamatan'],
            'kotakabupaten' => $request['f3_kotakabupaten'],
            'provinsi' => $request['f3_provinsi'],
            'kodepos' => $request['f3_kodepos'],
            'telp' => $request['f3_telp'],
            'faks' => $request['f3_faks']
        );
        if ($f1_id==0) {
            $o = Orang::create($f1);
            $f1_id = $o->id;
        } else {
            $o = Orang::where('id', $f1_id)->take(1);
            if ($o) $o->update($f1);
        }
        if ($f2_id==0) {
            $p = Perusahaan::create($f2);
            $f2_id = $p->id;
        } else {
            $p = Perusahaan::where('id', $f2_id)->take(1);
            if ($p) $p->update($f2);
        }
        $o = Orang::where('email', $this->USER['EMAIL'])->take(1);
        if ($o) {
            $o->update($f3);
            $o = Orang::where('email', $this->USER['EMAIL'])->take(1)->get();
            $f3_id = $o[0]['id'];
        }
        $p = Permohonan::create(array(
            'nama'              => $request['f2_nama'],
            'ref_f1_pemohon'    => $f1_id,
            'ref_f2_perusahaan' => $f2_id,
            'ref_f3_pengurus'   => $f3_id,
            'jenispermohonan'   => $request['jenispermohonan'],
            'stage'             => 1
        ));
        $i = $p->id;
        foreach ($request->files as $var => $file) {
            $d = intval(substr($var,4));
            $p = $request->file($var)->store('dokumen');
            DokumenPermohonan::create(array(
                'permohonan_id' => $i,
                'document_id'   => $d,
                'filename'          => $file->getClientOriginalName(),
                'ext'           => $file->getClientOriginalExtension(),
                'mime'          => $file->getMimeType(),
                'pathname'      => $p
            ));
        }
//        $path = $request->file('DOC_29')->store('fileku');
//        echo $path;
        return Redirect::to('/');
    }


    public function taskdetail(Request $request) {
        $i = $request['id'];
        $p = Permohonan::where('id', $i)->take(1)->get();
        $f1 = Orang::where('id', $p[0]['ref_f1_pemohon'])->take(1)->get();
        $f2 = Perusahaan::where('id', $p[0]['ref_f2_perusahaan'])->take(1)->get();
        $f3 = Orang::where('id', $p[0]['ref_f3_pengurus'])->take(1)->get();
        if ($this->USER['POSITION']=='---')
            $n = [];
        else {
            $n = Permohonan::where('id', $i)->first()->trackings;
            foreach ($n as $k => $r) $n[$k]['handler'] = $r->role->name;
        }
        $d = DokumenPermohonan::where('permohonan_id', $i)->get('document_id as id');
        $s = Tracking::where('permohonan_id', $i)->take(1)->orderby('created_at', 'DESC')->get('created_at');
        if (isset($s[0]))
            $z = $s[0];
        else
            $z = $p[0];
        $r = $p ? ['error' => 0, 'permohonan' => $p[0], 'f1' => $f1[0], 'f2' => $f2[0], 'f3' => $f3[0], 'notes' => $n, 'stat' => $z, 'documents' => $d] : ['error' => 1];
        return response()->json($r);
    }

    public function taskupdate(Request $request) {
        $i = $_POST['id'];
        $n = $_POST['note'];
        $a = $_POST['act']=='next' ? 'next' : 'reroute';
        $p = Permohonan::where('id', $i)->take(1)->get(['stage']);
        $h = StageHandler::where('stage', $p[0]['stage'])->take(1)->get($a);
        $u = Permohonan::where('id', $i)->take(1)->update(['stage' => $h[0][$a]]);
        if ($u)
            Tracking::create(array('permohonan_id' => $i, 'stage' => $p[0]['stage'], 'note' => $n));
        $r = $u ? ['error' => 0] : ['error' => 1];
        return response()->json($r);
    }

    public function search(Request $request) {
        $k = $request['keyword'];
        if ($this->USER['POSITION']=='---')
            $p = Permohonan::where('nama', 'like', '%'.$k.'%')->where('ref_f3_pengurus', $this->USER['ID'])->get();
        else
            $p = Permohonan::where('nama', 'like', '%'.$k.'%')->get();
        $d = Document::orderBy('group')->get();
        $s = StageHandler::get();
        return view('member.search')->with(['USER' => $this->USER, 'DOCUMENTS' => $d, 'STAGES' => $s, 'RESULTS' => $p]);
    }
    ///// account functions /////

    public function signout(Request $request) {
        if (Auth::Check()) {
            \App\Log::create(array('ipa' => $_SERVER['REMOTE_ADDR'], 'log' => Auth::user()->email .' signed out'));
            Auth::logout();
        }
        return Redirect::to('/');
    }

    public function verify($token)
    {
        $user = User::where('token', $token)->first();

        if (!$user)
            return Redirect::to('/');   // TODO

        $user->email_verified_at = now();
        $user->token = null;
        if ($user->save()) {
            \App\Log::create(array('ipa' => $_SERVER['REMOTE_ADDR'], 'log' => $user->email .' verified'));
            Orang::create(array(
                'nama' => $user->name,
                'jabatan' => '',
                'alamat' => '',
                'kelurahan' => '',
                'kecamatan' => '',
                'kotakabupaten' => '',
                'provinsi' => '',
                'kodepos' => '',
                'telp' => '',
                'faks' => '',
                'email' => $user->email
            ));
            return view('public.verified');
        } else
            die("FATAL ERROR: Failed to update verification."); // TODO
    }

    public function reset($token)
    {
        $user = User::where('token', $token)->first();

        if (!$user)
            return Redirect::to('/');   // TODO

        return view('public.setpass')->with(['token' => $token]);
    }

    public function account(Request $request) {
        $rules = array(
            'fullname'  => 'required|regex:/^[a-z ]+$/i|min:3',
            'email'     => 'required|email',
            'password'  => 'required|alpha_num|min:8|max:20'
        );
        $messages = array(
            'fullname.required'     => 'Fullname required.',
            'fullname.regex'		=> 'Fullname must be alphabets.',
            'email.required'	    => 'Email required.',
            'email.email'		    => 'Email Address format not suitable.',
            'password.required'     => 'Password required.',
            'password.alpha_num'	=> 'Password must be alphanumerics.',
            'password.min'		    => 'Password minimal 8 characters.',
            'password.max'		    => 'Password maximal 20 characters.',
        );
        if (($request->input('action') == 'signin') || ($request->input('action') == 'reset') || ($request->input('action') == 'setpass')) unset($rules['fullname']);
        if ($request->input('action') == 'reset') unset($rules['password']);
        if ($request->input('action') == 'setpass') unset($rules['email']);

        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            if ($request->input('action') != 'setpass')
                return Redirect::to('/')->withErrors($validator)->withInput($request->except('password'));
            else
                return Redirect::to('/reset/'.$request['token'])->withErrors($validator)->withInput($request->except('password'));
        } else {
            switch ($request->input('action')) {
                case 'setpass':
                    $user = User::where('token', $request['token'])->first();
                    if (!$user)
                        return Redirect::to('/reset/'.$request['token'])->withErrors(['Akun tidak dapat ditemukan.'])->withInput($request->except('password'));
                    $user->password = Hash::make($request['password']);
                    $user->token = null;
                    if (!$user->save())
                        return Redirect::to('/')->withErrors(['Tidak dapat me-reset password, silakan hubungi Administrator.'])->withInput($request->except('password'));
                    \App\Log::create(array('ipa' => $_SERVER['REMOTE_ADDR'], 'log' => $user->email .' new password set'));
                    return view('public.passset');
                    break;
                case 'reset':
                    $user = User::where('email', $request['email'])->first();
                    if (!$user)
                        return Redirect::to('/')->withErrors(['Email tidak terdaftar.'])->withInput($request->except('password'));
                    $user->token = base64_encode('RESETPASSWD'. $request['email'] . $user->password);
                    if (!$user->save())
                        return Redirect::to('/')->withErrors(['Tidak dapat me-reset password, silakan hubungi Administrator.'])->withInput($request->except('password'));
                    \App\Log::create(array('ipa' => $_SERVER['REMOTE_ADDR'], 'log' => $user->email .' request password reset'));
                    dispatch(new SendPasswordReset($user));
                    return view('public.reset')->with(['email' => $request['email']]);
                    break;
                case 'signup':
                    $user = User::where('email', $request['email'])->first();
                    if ($user) {
                        return Redirect::to('/')->withErrors(['Email sudah terdaftar dalam sistem.'])->withInput($request->except('password'));
                    }
                    $user = User::create([
                        'name'     => $request['fullname'],
                        'email'    => $request['email'],
                        'password' => Hash::make($request['password']),
                        'token'    => base64_encode('EMAILVRFY'. $request['email'] . Hash::make($request['password']))
                    ]);
                    if (!$user)
                        return Redirect::to('/')->withErrors(['Tidak dapat membuat Akun baru, silakan hubungi Administrator.'])->withInput($request->except('password'));
                    \App\Log::create(array('ipa' => $_SERVER['REMOTE_ADDR'], 'log' => $user->email .' signed up'));
                    dispatch(new SendVerificationEmail($user));
                    return view('public.signup')->with(['email' => $request['email']]);
                    break;
                case 'signin':
                    $account = array('email' => $request->input('email'), 'password' => $request->input('password'));
                    if (Auth::attempt($account)) {
                        $user = User::where('email', $request['email'])->first();
                        if (is_null($user->email_verified_at)) {
                            \App\Log::create(array('ipa'=>$_SERVER['REMOTE_ADDR'], 'log' => $request->input('email') .' unactivated account sign in trial'));
                            Auth::logout();
                            return view('public.signup')->with(['email' => $request['email']]);
                        }
                        \App\Log::create(array('ipa'=>$_SERVER['REMOTE_ADDR'], 'log' => $request->input('email') .' signed in'));
                        return Redirect::to('/');
                    } else
                        return Redirect::to('/')->withErrors(['Gagal login, silakan cek Email dan Password.'])->withInput($request->except('password'));
                    break;
                default:
                    // TODO
            }
        }
    }
}
