<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Application;
use App\Models\Shop;
use App\Models\Status;
use App\Models\TypeAccident;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class MainController extends Controller
{
    public function index()
    {
        $admin = Admin::where('id', Auth::guard('admin')->id())->first();
        return view('admin.index', compact('admin'));
    }

    public function profileEdit()
    {
        $admin = Admin::where('id', Auth::guard('admin')->id())->first();
        return view('admin.profile_edit', compact('admin'));
    }

    public function profileUpdate(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required|min:6',
        ]);

        $password = Hash::make($request->input('password'));

        Admin::where('id', Auth::id())->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $password,
        ]);

        return back()->with('success', 'Данные изменены');
    }

    public function createAdmin()
    {
        return view('admin.create_admin');
    }

    public function storeAdmin(Request $request)
    {
        $validation = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $email = $request->input('email');
        $admin = Admin::where('email', $email)->first();
        if (empty($admin)) {
            $selfId = Auth::guard('admin')->id();
            $password = Hash::make($request->input('password'));
            Admin::insert([
                'name' => $request->input('name'),
                'email' => $email,
                'password' => $password,
                'createdByAdmin' => $selfId,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString(),
            ]);
        } else {
            return back()->with('error', 'Этот email уже используется');
        }
        return back()->with('success', 'Новый администратор создан');
    }

    public function apps()
    {
        if (session('apps')) {
            $apps = session('apps');
        } else {
            $apps = Application::with('users', 'shops', 'type_accidents', 'statuses')
                ->paginate(5);
        }

        $shops = Shop::get();
        $types = TypeAccident::get();
        $statuses = Status::get();
        return view('admin.apps', compact('apps', 'shops', 'types', 'statuses'));
    }

    public function appSearch(Request $request)
    {
        if($request->input('date_from') == null) {
            $date_from = '2000-01-01';
        } else {
            $date_from = $request->input('date_from');
        }

        if($request->input('date_to') == null) {
            $date_to = '3000-01-01';
        } else {
            $date_to = $request->input('date_to');
        }

        if($request->input('id') == null) {
            $eq_id = '>=';
            $id = 0;
        } else {
            $eq_id = '=';
            $id = $request->input('id');
        }

        if ($request->input('name') == null) {
            $users_id = User::pluck('id')->toArray();
        } else {
            $name = strtolower($request->input('name'));
            $users_id = User::where('name', 'LIKE', strtolower("%$name%"))->pluck('id')->toArray();
        }

        if ($request->input('shop_id') == null) {
            $shop = 0;
            $eq_shop = '>=';
        } else {
            $shop = $request->input('shop_id');
            $eq_shop = '=';
        }

        if ($request->input('type_accident_id') == null) {
            $type_accident = 0;
            $eq_type_accident = '>=';
        } else {
            $type_accident = $request->input('type_accident_id');
            $eq_type_accident = '=';
        }

        if ($request->input('description') == null) {
            $description = '';
        } else {
            $description = strtolower($request->input('description'));
        }

        if($request->input('recall') == null) {
            $eq_recall = '>=';
            $recall = 0;
        } else {
            $eq_recall = '=';
            $recall = $request->input('recall');
        }

        if ($request->input('status_id') == null) {
            $status = 0;
            $eq_status = '>=';
        } else {
            $status = $request->input('status_id');
            $eq_status = '=';
        }


        $apps = Application::where('id', $eq_id, $id)
            ->where('created_at', '>=', $date_from)
            ->where('created_at', '<=', $date_to)
            ->whereIn('user_id', $users_id)
            ->where('shop_id', $eq_shop, $shop)
            ->where('type_accident_id', $eq_type_accident, $type_accident)
            ->where('description', 'like', strtolower("%$description%"))
            ->where('recall', $eq_recall, $recall)
            ->where('status_id', $eq_status, $status)
            ->paginate(5);

        return back()->with('apps', $apps);
    }

    public function appShow($id) {
        $app = Application::where('id', $id)
            ->with('users', 'shops', 'type_accidents', 'statuses')
            ->first();
        if($app->status_id == 1) {
            Application::where('id', $id)->update([
                'status_id' => 2
            ]);
        }
        return view('admin.app_show', compact('app'));
    }

    public function appClose(Request $request) {
        Application::where('id', $request->input('id'))->update([
            'status_id' => 3,
        ]);
        return redirect()->route('admin.apps');
    }

    public function appCancel(Request $request) {
        Application::where('id', $request->input('id'))->update([
            'status_id' => 4,
        ]);
        return redirect()->route('admin.apps');
    }
}
