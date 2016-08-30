<?php

namespace App\Http\Controllers;

use App\typemoneys;
use App\Wallets;
use DB;
use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $wallets = DB::table('wallets')
                ->join('typemoneys', 'wallets.id_type', '=', 'typemoneys.id_type')
                ->orderBy('name_wallet', 'asc')
                ->paginate(5);
        return view('home', ['wallets' => $wallets]);
    }

    public function addWallet() {
        $typeMoneys = typemoneys::all();
        return view('addwallet', ['typeMoneys' => $typeMoneys]);
    }

    public function addTypemoney() {
        return view('addtypemoney');
    }

    public function addTypemoneySuccess(Request $request) {

        $this->validate($request, [
            'namemoney' => 'required|max:15|min:3',
        ],[
            'namemoney.required' => 'Type Money is required.',
        ]);

        $dulieu_tu_input = $request->all();
        $typemoneys = new typemoneys;
        $typemoneys->name_type = $dulieu_tu_input["namemoney"];
        $typemoneys->save();
        return redirect('/home');
    }

    public function addData(Request $request) {

        $this->validate($request, [
            'name' => 'required|max:15|min:3',
            'money' => 'required|numeric|min:1',
            'typemoney' => 'required',
        ],[
            'name.required' => 'Name Wallet is required.',
            'money.required' => 'Money is required.',
            'typemoney.required' => 'Type Money is required.',
        ]);
        
        $dulieu_tu_input = $request->all();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_type = substr($file->getMimeType(), strrpos($file->getMimeType(), '/') + 1);
            if ($file_type == "jpeg" || $file_type == "png" || $file_type == "jpg") {
                $file_name = str_random('60') . '.' . $file_type;
                $path = "images";
                $dulieu_tu_input['image'] = $path . '/' . $file_name;
                $file->move($path, $file_name);
                $wallets = new wallets;
                $wallets->name_wallet = $dulieu_tu_input["name"];
                $wallets->money_wallet = $dulieu_tu_input["money"];
                $wallets->id_type = $dulieu_tu_input["typemoney"];
                $wallets->note_wallet = $dulieu_tu_input["note"];
                $wallets->avatar_wallet = $dulieu_tu_input["image"];
                $wallets->save();
                return redirect('/home');
            } else {
                // không phải file ảnh
                $error = "Kiểu file không hợp lệ. Vui lòng nhập lại";
                $typeMoneys = typemoneys::all();
                return view('addwallet2', ['error' => $error, 'typeMoneys' => $typeMoneys, 'input' => $dulieu_tu_input]);
            }
        } else {
            $wallets = new wallets;
            $wallets->name_wallet = $dulieu_tu_input["name"];
            $wallets->money_wallet = $dulieu_tu_input["money"];
            $wallets->id_type = $dulieu_tu_input["typemoney"];
            $wallets->note_wallet = $dulieu_tu_input["note"];
            $wallets->avatar_wallet = 'images/default.png';
            $wallets->save();
            return redirect('/home');
        }
    }

    public function deleteWallet($id = '') {
        $wallet = wallets::where('id_wallet', $id)->first();
        if ($wallet->avatar_wallet != 'images/default.png') {
            @unlink("$wallet->avatar_wallet");
        }
        wallets::where('id_wallet', $id)->delete();
        return redirect('/home');
    }

    public function editWallet($id = '') {
        $wallets = DB::table('wallets')
                ->join('typemoneys', 'wallets.id_type', '=', 'typemoneys.id_type')
                ->where('wallets.id_wallet', $id)
                ->first();
        $typeMoneys = typemoneys::all();
        return view('editwallet', ['typeMoneys' => $typeMoneys, 'wallets' => $wallets]);
    }

    public function transfer() {
        $wallets = wallets::all();
        $typemoneys = typemoneys::all();
        return view('transfer', ['typemoneys' => $typemoneys, 'wallets' => $wallets]);
    }

    public function transfersuccess(Request $request) {
        
        $this->validate($request, [
            'money' => 'required',
            'walletsent' => 'required',
            'walletreceive' => 'required',
        ],[
            'money.required' => 'Money is required.',
        ]);
        
        $dulieu_tu_input = $request->all();
        $a = $dulieu_tu_input['walletsent'];
        $b = $dulieu_tu_input['walletreceive'];
        if ($a != $b) {
            $wallet1 = wallets::where('name_wallet', $a)->first();
            $wallet2 = wallets::where('name_wallet', $b)->first();
            if (($wallet1->id_type) == ($wallet2->id_type)) {
                $c = $dulieu_tu_input['money'];
                $x = $wallet1->money_wallet;
                if ($c <= $x && $c != 0) {
                    $m = $wallet1->money_wallet - $c;
                    $n = $wallet2->money_wallet + $c;
                    wallets::where('name_wallet', $a)->update(array(
                        'money_wallet' => $m,
                    ));
                    wallets::where('name_wallet', $b)->update(array(
                        'money_wallet' => $n,
                    ));
                    return redirect('/home');
                } else {
                    $loithieutien = 'Số tiền chuyển phải nhỏ hơn hoặc bằng số tiền trong ví.';
                    $wall = wallets::all();
                    return view('transfer', ['wallets' => $wall, 'loithieutien' => $loithieutien, 'wsent' => $a, 'wreceive' => $b]);
                }
            } else {
                $errorkhacloaitien = 'Đơn vị tiền không giống nhau.';
                $wall = wallets::all();
                return view('transfer', ['wallets' => $wall, 'errorkhacloaitien' => $errorkhacloaitien, 'wsent' => $a, 'wreceive' => $b]);
            }
        } else {
            $errortrungvi = "Trùng ví. Vui lòng chọn lại.";
            $wallets = wallets::all();
            return view('transfer', ['wsent' => $a, 'wreceive' => $b, 'errortrungvi' => $errortrungvi, 'wallets' => $wallets]);
        }
    }

    public function updateWallet(Request $request) {
        $dulieu_tu_input = $request->all();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $file_type = substr($file->getMimeType(), strrpos($file->getMimeType(), '/') + 1);
            if ($file_type == "jpeg" || $file_type == "png" || $file_type == "jpg") {

                $wall = wallets::where('id_wallet', $dulieu_tu_input["idwallet"])->first();
                if ($wall->avatar_wallet != 'images/default.png') {
                    @unlink("$wall->avatar_wallet");
                }
                $file_name = str_random('60') . '.' . $file_type;
                $path = "images";
                $dulieu_tu_input['image'] = $path . '/' . $file_name;
                $file->move($path, $file_name);
                $wallets = wallets::where('id_wallet', $dulieu_tu_input["idwallet"])->update(array(
                    'name_wallet' => $dulieu_tu_input["name"],
                    'money_wallet' => $dulieu_tu_input["money"],
                    'id_type' => $dulieu_tu_input["typemoney"],
                    'note_wallet' => $dulieu_tu_input["note"],
                    'avatar_wallet' => $dulieu_tu_input["image"],
                ));
                return redirect('/home');
            } else {
                // không phải file ảnh
                $errorupdate = "Kiểu file không hợp lệ. Vui lòng nhập lại";
                $idUpdate = $dulieu_tu_input["idwallet"];
                $choose = typemoneys::where('id_type', $dulieu_tu_input["typemoney"])->first();
                $typeMoneys = typemoneys::all();
                return view('editwallet2', ['choose' => $choose, 'idUpdate' => $idUpdate, 'errorupdate' => $errorupdate, 'typeMoneys' => $typeMoneys, 'input' => $dulieu_tu_input]);
            }
        } else {
            $idUpdate = $dulieu_tu_input["idwallet"];
            $wall = wallets::where('id_wallet', $idUpdate)->first();
            $wallets = wallets::where('id_wallet', $idUpdate)->update(array(
                'name_wallet' => $dulieu_tu_input["name"],
                'money_wallet' => $dulieu_tu_input["money"],
                'id_type' => $dulieu_tu_input["typemoney"],
                'note_wallet' => $dulieu_tu_input["note"],
                'avatar_wallet' => $wall["avatar_wallet"],
            ));
            return redirect('/home');
        }
    }

}
