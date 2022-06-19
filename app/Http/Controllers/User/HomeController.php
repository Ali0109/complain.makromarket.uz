<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Shop;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $user = User::where('id', Auth::id())->first();
        $shops = Shop::all();
        return view('user.index', compact('shops', 'user'));
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'shop_id' => 'required',
            'type_accident_id' => 'required',
            'description' => 'required',
        ]);

        $user_name = User::where('id', Auth::id())->first()->name;
        if (empty($user_name)) {
            $request->validate(['name' => 'required']);

            User::where('id', Auth::id())->update([
                'name' => $request->input('name'),
            ]);
        }

        $request->input('recall') == 'on' ? $recall = 1 : $recall = 0;

        $application = Application::create([
            'user_id' => Auth::id(),
            'shop_id' => $request->input('shop_id'),
            'type_accident_id' => $request->input('type_accident_id'),
            'description' => $request->input('description'),
            'recall' => $recall,
        ]);

        return redirect()->route('user.app_complete');
    }

    public function appComplete() {
        $app = Application::where('user_id', Auth::id())->latest()->first();
        return view('user.app_complete', compact('app'));
    }

    public function appCompleteStore() {
        Auth::logout();
        return redirect()->route('login');
    }
}
