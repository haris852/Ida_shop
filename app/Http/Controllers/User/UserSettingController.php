<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserSettingController extends Controller
{
    public function index()
    {
        return view('customer.setting');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sex' => ['required'],
            'phone' => ['required', 'string', 'max:255'],
            'address' => ['required'],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'old_password' => ['nullable', 'string', 'min:8'],
            'new_password' => ['nullable', 'string', 'min:8'],
            'new_password_confirmation' => ['nullable', 'string', 'min:8'],
        ]);

        try {
            $user = User::find($id);

            if (isset($request->avatar)) {
                $oldAvatar = $user->avatar;
                if ($oldAvatar != null) {
                    Storage::delete('public/avatar/' . $oldAvatar);
                }
                $filename = uniqid() . $request->avatar->getClientOriginalName();
                $request->avatar->storeAs('public/avatar', $filename);

                $user->avatar = $filename;
            }

            $user->name = $request->name;
            $user->sex = $request->sex;
            $user->phone = $request->phone;
            $user->address = $request->address;
            $user->email = $request->email;
            // check if password is not null
            if ($request->old_password != null && $request->new_password != null && $request->new_password_confirmation != null) {
                if (Hash::check($request->old_password, $user->password)) {
                    if ($request->new_password == $request->new_password_confirmation) {
                        $user->password = Hash::make($request->new_password);
                    } else {
                        return redirect()->back()->with('error', 'Password baru dan konfirmasi password baru tidak sama!');
                    }
                } else {
                    return redirect()->back()->with('error', 'Password lama tidak sesuai!');
                }
            }

            $user->save();

            return redirect()->route('user.setting.index')->with('success', 'Profil pengguna berhasil diperbarui!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }
}
