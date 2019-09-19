<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class InstallController extends Controller
{
    public function show()
    {
        if (User::count() > 1) {
            abort(404);
        }
        return view('vendor.installer.account');
    }

    public function store(Request $request)
    {
        User::updateOrCreate(
            ['id' => 1],
            [
                'name' => $request->name,
                'email' => $request->email,
                'avatar' => generateAvatar($request->email),
                'password' => bcrypt($request->password),
                'bio' => '这家伙很懒什么也没写~',
                'email_verified_at' => Carbon::now()->toDateTimeString(),
            ]
        );
        return redirect()->route('index')->with('success', '管理员账号设置成功！');
    }
}
