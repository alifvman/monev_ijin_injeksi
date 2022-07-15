<?php

namespace App\Http\Controllers;

use App\Jobs\SendNotificationEmail;
use App\Peran;
use App\User;
use App\Arsip;
use App\Dokumen;
use App\Orang;
use App\Tracking;
use App\Perusahaan;
use App\Permohonan;
use App\DokumenPermohonan;
use App\StageHandler;
use Auth;
use Route;
use Redirect;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;

class Member extends Controller
{
    private $USER   = null;
    private $ROUTES = ['home', 'prosses', 'dashboard', 'userman', 'updaterole', 'settings', 'submission', 'autocomplete', 'data', 'download', 'appdetail', 'appupdate', 'appcancel', 'profile', 'password', 'search'];

    public function __construct() {
        $this->middleware(function ($request, $next) {
            if (Auth::Check()) {
                $this->USER = [
                    'ID'        => Auth::id(),
                    'NAMA'      => Auth::user()->nama,
                    'EMAIL'     => Auth::user()->email,
                    'POSISI'    => Auth::user()->posisi,
                    'PERAN'     => Auth::user()->peran->nama,
                    'CREATED'   => Auth::user()->created_at
                ];
            } else return Redirect::to('/');
            if (!in_array(Route::currentRouteName(), $this->ROUTES))
                return Redirect::to('/');
            return $next($request);
        });
    }

    public function home(Request $request) {
        if ($this->USER['POSISI']=='PMH') {
            // external user
            $o = Auth::user()->orang;
            if (is_null($o))
                return view('applicant.error')->with(['error'=>'PMH.O']);
            $p = Permohonan::where('ref_f3_pengurus', $this->USER['ID'])->where('stage', '>', -100)->where('stage', '<', 99)->first();
            $d = Dokumen::orderBy('grup')->get();
            $x = [];
            $x['f3'] = Orang::where('email', $this->USER['EMAIL'])->first()->toArray();
            if (is_null($p))
                return view('applicant.form')->with(['USER' => $this->USER, 'dokumen' => $d, 'data' => $x]);
            if (intval($p['stage']) < 0) {
                $s = StageHandler::where('stage', ($p['stage']*-1))->get(['nama'])->first()->toArray();
                $p['status'] = $s['nama'];
                return view('applicant.status')->with(['USER' => $this->USER, 'stage' => $p['stage'], 'data' => $p]);
            }
            $j = array('B'=>"Permohonan Baru", 'U'=>"Perubahan", 'P'=>"Perpanjangan");
            $s = StageHandler::where('stage', $p['stage'])->get(['nama'])->first()->toArray();
            if ($p['stage']==99)
                $z = 100;
            else
                $z = intval(($p['stage']/14)*100);
                $x['id'] = $p['id'];
                $x['f1'] = Orang::where('id', $p['ref_f1_pemohon'])->first()->toArray();
                $x['f2'] = Perusahaan::where('id', $p['ref_f2_perusahaan'])->first()->toArray();
                $x['dokumen'] = DokumenPermohonan::where('permohonan_id', $p['id'])->get()->toArray();
                $x['status'] =  $s['nama'] . ' ( '.$z.'% selesai )';
                $x['jenis'] = $p['jenis'];
                $x['stage'] = $p['stage'];
                $x['permohonan'] = $j[$p['jenis']];
                return view('applicant.status')->with(['USER' => $this->USER, 'dokumen' => $d, 'stage' => $p['stage'], 'data' => $x]);
        } else {
            $s = StageHandler::get(['stage', 'nama', 'bread', 'posisi']);
            $t = [];
            foreach ($s as $i) if ($i['posisi']==$this->USER['POSISI']) $t[] = $i['stage'];
            $p = Permohonan::whereIn('stage', $t)->get();
            return view('internal.index')->with(['USER' => $this->USER, 'STAGES' => $s, 'apps' => $p]);
        }
    }

    public function prosses(Request $request, $object)
    {

        $e = 0;
        $i = decrypt($object);
        $t = [];
        $x = [];
        $h = [];
        $s = StageHandler::get(['stage', 'nama', 'bread', 'posisi']);
        if (!isset($request['mode'])) {
            foreach ($s as $j) if ($j['posisi'] == $this->USER['POSISI']) $t[] = $j['stage'];
            $p = Permohonan::where('id', $i)->whereIn('stage', $t)->first();
        } else
            $p = Permohonan::where('id', $i)->first();;
        $k = array('B'=>"Permohonan Baru", 'U'=>"Perubahan", 'P'=>"Perpanjangan");
        $d = Dokumen::orderBy('grup')->get();
        $s = StageHandler::where('stage', $p['stage'])->first();
        $s = is_null($s) ? [] : $s->makeHidden(['id', 'stage', 'posisi', 'bread', 'flag', 'created_at', 'updated_at'])->toArray();
        $g = array_column(DokumenPermohonan::where('permohonan_id', $p['id'])->get(['dokumen_id'])->toArray(), 'dokumen_id');
        foreach ($d as $w) if (in_array($w['id'], $g)) $h[] = ['grup'=>$w['grup'], 'nama'=>$w['nama'], 'link'=>$p['id'].':'.$w['id']];
        $x['id'] = $p['id'];
        $f = Orang::where('id', $p['ref_f1_pemohon'])->first();
        $x['f1'] = is_null($f) ? [] : $f->makeHidden(['id', 'flag', 'created_at', 'updated_at'])->toArray();
        $f = Perusahaan::where('id', $p['ref_f2_perusahaan'])->first();
        $x['f2'] = is_null($f) ? [] : $f->makeHidden(['id', 'flag', 'created_at', 'updated_at'])->toArray();
        $f = Orang::where('id', $p['ref_f3_pengurus'])->first();
        $x['f3'] = is_null($f) ? [] : $f->makeHidden(['id', 'flag', 'created_at', 'updated_at'])->toArray();
        $x['dokumen'] = $h;
        $x['jenis'] = $p['jenis'];
        $x['stage'] = $p['stage'];
        $x['permohonan'] = $k[$p['jenis']];
        $x['action'] = $s;

        $t = Tracking::where('permohonan_id', $p['id'])->whereNotNull('note')->get()->makeHidden(['id', 'flag', 'created_at', 'updated_at']); // TODO: secure id, posisi, flag, created_at, updated_at
        $t->load('peran');
        $x['tracking'] = $t;
        $t = Tracking::where('permohonan_id', $p['id'])->get()->makeHidden(['id', 'permohonan_id', 'flag', 'note', 'updated_at']); // TODO: secure id, posisi, flag, created_at, updated_at
//        $x['staging'] = array_merge(array(array("created_at" => $p['created_at'], "stage" => 0)), $t->toArray());
        $s = $t->toArray();
        $x['staging'] = [];
        if (count($s) > 0)
        {
            foreach ($s as $i)
            {
                $k = 0; $t = strtotime($p['created_at']);
                foreach ($s as $j)
                {
                    if (($j['stage'] < $i['stage']) && ($j['stage'] > $k))
                    {
                        $k = $j['stage'];
                        $t = strtotime($j['created_at']);
                    }
                }
                $timing = $this->secondsToWords(strtotime($i['created_at']) - $t);
                $x['staging'][$i['stage']] = ($timing == "") ? "Seketika" : $timing;
            }
        }

        $stage = StageHandler::get(['stage', 'nama', 'bread', 'posisi']);
        $t = [];
        foreach ($stage as $i) if ($i['posisi'] == $this->USER['POSISI']) $t[] = $i['stage'];
        $r = ($e!=0) ? ['error' => 1] : ['error' => 0, 'stage' => $s, 'data' => $x];
        return $r;
        return view('internal.inbox')->with(['r' => $r, 'STAGES' => $stage, 'USER' => $this->USER]);

    }

    public function dashboard(Request $request) {
        if ($this->USER['POSISI']=='DIR') {
            $x = [];
            $z = [];
            for ($i=1; $i<=12; $i++) {
                $p = Permohonan::where('stage', '>', 0)->whereMonth('created_at', $i)->whereYear('created_at', date("Y"))->get();
                $z['total'][$i] = count($p);
                $p = Permohonan::where('stage', '=', 99)->whereMonth('updated_at', $i)->whereYear('updated_at', date("Y"))->get();
                $z['selesai'][$i] = count($p);
            }
            $p = Permohonan::where('stage', '>', 0)->get('id');
            $x['total'] = count($p);
            $p = Permohonan::where('stage', '=', 99)->get('id');
            $x['completed'] = count($p);
            $y = Peran::where('posisi', '<>', 'PMH')->orderBy('id')->get(['posisi', 'nama'])->toArray();
            foreach ($y as $k => $i) {
                $s = StageHandler::where('posisi', $i['posisi'])->get('stage')->toArray();
                $p = Permohonan::whereIn('stage', $s)->get();
                $y[$k]['permohonan'] = count($p);
            }
            return view('internal.dashboard')->with(['USER' => $this->USER, 'permohonan' => $x, 'proses' => $y, 'statistik' => $z]);
        }
        return Redirect::to('/');
    }

    public function userman(Request $request) {
        if ($this->USER['POSISI']=='KSD') {
            $d = [];
            $d['peran'] = Peran::get()->toArray();
            $u = User::where('posisi', '<>', 'PMH')->get()->makeHidden(['flag', 'created_at', 'updated_at']);
            $u->load('peran');
            $d['user'] = $u->toArray();
            return view('internal.userman')->with(['USER' => $this->USER, 'data' => $d]);
        }
        return Redirect::to('/');
    }

    public function updaterole(Request $request) {
        $i = $request['uid'];
        $p = $request['prn'];
        $t = Peran::where('posisi', $p)->first();
        $r = ['error' => 1];
        if (!is_null($t)) {
            $u = User::where('id', $i)->first();
            if ($u) $t = $u->update(['posisi' => $p]);
            if ($t) {
                \App\Log::create(array('ipa' => $_SERVER['REMOTE_ADDR'], 'log' => $this->USER['EMAIL'] .' changed user '.$u['nama'].' ('.$u['id'].') role into '.$p));
                $t = Peran::where('posisi', $p)->first();
            }
            if ($t) $r = ['error' => 0, 'uid' => $u['id'], 'peran' => $t['nama']];
        }
        return response()->json($r);
    }

    public function search(Request $request) {
        $k = $request['keyword'];
        $p = Permohonan::where('nama', 'like', '%'.$k.'%')->where('stage', '>', 0)->get();
        $s = StageHandler::get(['stage', 'nama', 'bread', 'posisi']);
        return view('internal.result')->with(['USER' => $this->USER, 'STAGES' => $s, 'apps' => $p]);
    }

    public function settings(Request $request) {
        return view('internal.settings')->with(['USER' => $this->USER]);
    }

    public function profile(Request $request) {
        $n = $request['nama'];
        User::where('id', $this->USER['ID'])->take(1)->update(['nama'=>$n]);
        return Redirect::to('/home');
    }

    public function password(Request $request) {
        $u = User::where('id', $this->USER['ID'])->take(1)->update(['password' => Hash::make($request['newpassword'])]);
        return Redirect::to('/home');
    }

    public function appupdate(Request $request) {
        $i = $request['id'];
        $s = $request['ra'];
        $n = $request['nt'];
        if ($s != 99) {
            $z = StageHandler::where('stage', $s)->first()->toArray();
            $z = User::where('posisi', $z['posisi'])->first()->toArray();
            $e = $z['email'];
        }
        $p = Permohonan::where('id', $i)->first()->toArray();
        $z = $p['stage'];
        $t = Permohonan::where('id', $i)->take(1)->update(['stage' => $s]);
        if ($t) $t = Tracking::create(['permohonan_id' => $i, 'stage' => $z, 'note' => $n]);
        if ($t and ($s==99)) {
            $f1 = Orang::where('id', $p['ref_f1_pemohon'])->first()->makeHidden(['id', 'flag', 'created_at', 'updated_at'])->toArray();
            $f2 = Perusahaan::where('id', $p['ref_f2_perusahaan'])->first()->makeHidden(['id', 'flag', 'created_at', 'updated_at'])->toArray();
            $f3 = Orang::where('id', $p['ref_f3_pengurus'])->first()->makeHidden(['id', 'flag', 'created_at', 'updated_at'])->toArray();
            $m = ['permohonan_id' => $i, 'jenis' => $p['jenis']];
            foreach ($f1 as $key => $value) $m['f1'.$key] = $value;
            foreach ($f2 as $key => $value) $m['f2'.$key] = $value;
            foreach ($f3 as $key => $value) $m['f3'.$key] = $value;
            $t = Arsip::create($m);
        }
        if ($s != 99)
        {
            dispatch(new SendNotificationEmail($e));
        }
        $r = $t ? ['error' => 0] : ['error' => 1];
        return response()->json($r);
    }

    public function appcancel(Request $request) {
        $i = $request['id'];
        $p = Permohonan::where('id', $i)->first()->toArray();
        $s = intval($p['stage']);
        if (($s > -100) and ($s < 0)) {
            $s -= 100;
            $t = Permohonan::where('id', $i)->take(1)->update(['stage' => $s]);
        }
        return Redirect::to('/home');
    }

    public function appdetail(Request $request) {
        $e = 0;
        $i = $request['id'];
        $t = [];
        $x = [];
        $h = [];
        $s = StageHandler::get(['stage', 'nama', 'bread', 'posisi']);
        if (!isset($request['mode'])) {
            foreach ($s as $j) if ($j['posisi'] == $this->USER['POSISI']) $t[] = $j['stage'];
            $p = Permohonan::where('id', $i)->whereIn('stage', $t)->first();
        } else
            $p = Permohonan::where('id', $i)->first();;
        $k = array('B'=>"Permohonan Baru", 'U'=>"Perubahan", 'P'=>"Perpanjangan");
        $d = Dokumen::orderBy('grup')->get();
        $s = StageHandler::where('stage', $p['stage'])->first();
        $s = is_null($s) ? [] : $s->makeHidden(['id', 'stage', 'posisi', 'bread', 'flag', 'created_at', 'updated_at'])->toArray();
        $g = array_column(DokumenPermohonan::where('permohonan_id', $p['id'])->get(['dokumen_id'])->toArray(), 'dokumen_id');
        foreach ($d as $w) if (in_array($w['id'], $g)) $h[] = ['grup'=>$w['grup'], 'nama'=>$w['nama'], 'link'=>$p['id'].':'.$w['id']];
        $x['id'] = $p['id'];
        $f = Orang::where('id', $p['ref_f1_pemohon'])->first();
        $x['f1'] = is_null($f) ? [] : $f->makeHidden(['id', 'flag', 'created_at', 'updated_at'])->toArray();
        $f = Perusahaan::where('id', $p['ref_f2_perusahaan'])->first();
        $x['f2'] = is_null($f) ? [] : $f->makeHidden(['id', 'flag', 'created_at', 'updated_at'])->toArray();
        $f = Orang::where('id', $p['ref_f3_pengurus'])->first();
        $x['f3'] = is_null($f) ? [] : $f->makeHidden(['id', 'flag', 'created_at', 'updated_at'])->toArray();
        $x['dokumen'] = $h;
        $x['jenis'] = $p['jenis'];
        $x['stage'] = $p['stage'];
        $x['permohonan'] = $k[$p['jenis']];
        $x['action'] = $s;

        $t = Tracking::where('permohonan_id', $p['id'])->whereNotNull('note')->get()->makeHidden(['id', 'flag', 'created_at', 'updated_at']); // TODO: secure id, posisi, flag, created_at, updated_at
        $t->load('peran');
        $x['tracking'] = $t;

        $t = Tracking::where('permohonan_id', $p['id'])->get()->makeHidden(['id', 'permohonan_id', 'flag', 'note', 'updated_at']); // TODO: secure id, posisi, flag, created_at, updated_at
//        $x['staging'] = array_merge(array(array("created_at" => $p['created_at'], "stage" => 0)), $t->toArray());
        $s = $t->toArray();
        $x['staging'] = [];
        if (count($s) > 0)
        {
            foreach ($s as $i)
            {
                $k = 0; $t = strtotime($p['created_at']);
                foreach ($s as $j)
                {
                    if (($j['stage'] < $i['stage']) && ($j['stage'] > $k))
                    {
                        $k = $j['stage'];
                        $t = strtotime($j['created_at']);
                    }
                }
                $timing = $this->secondsToWords(strtotime($i['created_at']) - $t);
                $x['staging'][$i['stage']] = ($timing == "") ? "Seketika" : $timing;
            }
        }

        $r = ($e!=0) ? ['error' => 1] : ['error' => 0, 'stage' => $s, 'data' => $x];
        return response()->json($r);

    }

    private function secondsToWords($seconds)
    {
        $ret = "";

        /*** get the days ***/
        $days = intval(intval($seconds) / (3600*24));
        if($days> 0)
        {
            $ret .= "$days hari ";
        }

        /*** get the hours ***/
        $hours = (intval($seconds) / 3600) % 24;
        if($hours > 0)
        {
            $ret .= "$hours jam ";
        }

        /*** get the minutes ***/
        $minutes = (intval($seconds) / 60) % 60;
        if($minutes > 0)
        {
            $ret .= "$minutes menit";
        }

        /*** get the seconds ***/
//        $seconds = intval($seconds) % 60;
//        if ($seconds > 0) {
//            $ret .= "$seconds dtk";
//        }

        return $ret;
    }

    public function submission(Request $request) {
        if ($this->USER['POSISI']=='PMH') {

            $f1_id = intval($request['f1id']);
            $f2_id = intval($request['f2id']);

            $d = array('f1'=>[], 'f2'=>[], 'f3'=>[]);

            $o = new Orang();
            $f = $o->getFillable();
            $x = array_search('flag', $f);
            if ($x) unset($f[$x]);

            foreach ($f as $i) {
                $d['f1'][$i] = $request->input('f1'.$i);
                $d['f3'][$i] = $request->input('f3'.$i);
            }

            $o = new Perusahaan();
            $f = $o->getFillable();
            $x = array_search('flag', $f);
            if ($x) unset($f[$x]);

            foreach ($f as $i)
                $d['f2'][$i] = $request->input('f2'.$i);

            unset($d['f3']['email']);

            if ($f1_id == 0) {
                $o = Orang::create($d['f1']);
                $f1_id = $o->id;
            } else {
                $o = Orang::where('id', $f1_id)->take(1);
                if ($o) $o->update($d['f1']);
            }

            if ($f2_id == 0) {
                $p = Perusahaan::create($d['f2']);
                $f2_id = $p->id;
            } else {
                $p = Perusahaan::where('id', $f2_id)->take(1);
                if ($p) $p->update($d['f2']);
            }

            $o = Orang::where('email', $this->USER['EMAIL'])->take(1);
            if ($o) $o->update($d['f3']);

            $p = Permohonan::create(array(
                'nama'              => $request['f2nama'],
                'ref_f1_pemohon'    => $f1_id,
                'ref_f2_perusahaan' => $f2_id,
                'ref_f3_pengurus'   => $this->USER['ID'],
                'jenis'             => $request['permohonan'],
                'stage'             => 1
            ));

            $i = $p->id;
            foreach ($request->files as $var => $file) {
                $d = intval(substr($var,3));
                $p = $request->file($var)->storeAs('appdoc', 'A'.$i.'D'.$d);
                DokumenPermohonan::create(array(
                    'permohonan_id' => $i,
                    'dokumen_id'    => $d,
                    'filename'      => $file->getClientOriginalName(),
                    'ext'           => $file->getClientOriginalExtension(),
                    'mime'          => $file->getMimeType(),
                    'pathname'      => $p
                ));
            }
        }

        return Redirect::to('/home');
    }

    public function downloadapdoc(Request $request, $appid, $docid) {
        $p = Permohonan::where('id', $appid)->first();
        if (is_null($p))
            abort(404, 'Dokumen tidak dikenali.');
        if (($this->USER['POSISI']=='PMH') and ($p['ref_f3_pengurus'] != $this->USER['ID']))
            abort(403, 'Tindakan tidak sah.');
        $d = Dokumen::where('id', $docid)->first();
        $e = DokumenPermohonan::where('permohonan_id', $appid)->where('dokumen_id', $docid)->first();
        if (is_null($d) or is_null($e))
            abort(404, 'Dokumen tidak dikenali.');
        $f = 'appdoc/A'.$appid.'D'.$docid;
        return Storage::download($f, $p['nama'].' - '.$d['nama'].'.'.$e['ext']);
    }

    public function autocomplete(Request $request, $object) {
        switch ($object) {
            case 'orang':
                $r = Orang::where('nama', 'like', '%'.$request['term'].'%')->get(['id', 'nama as label', 'nama as value']);
                break;
            case 'perusahaan':
                $r = Perusahaan::where('nama', 'like', '%'.$request['term'].'%')->get(['id', 'nama as label', 'nama as value']);
                break;
            default:
                $r = [];
        }
        return response()->json($r)->withCallback($request->input('callback'));
    }

    public function data(Request $request, $object) {
        $i = $request['id'];
        switch ($object) {
            case 'orang':
                $d = Orang::where('id', $i)->first();
                break;
            case 'perusahaan':
                $d = Perusahaan::where('id', $i)->first();
                break;
            default:
                $d = false;
        }
        $r = $d ? ['error' => 0, 'data' => $d] : ['error' => 1];
        return response()->json($r);
    }

}
