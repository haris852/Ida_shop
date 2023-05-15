<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.setting.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sex' => ['required'],
            'phone' => ['required', 'string', 'max:255'],
            'address' => ['required'],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
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
            $user->phone = $request->phone;
            $user->email = $request->email;
            if (isset($request->password)) {
                $user->password = password_hash($request->password, PASSWORD_DEFAULT);
            }
            $user->save();

            return redirect()->route('admin.setting.index')->with('success', 'Profil pengguna berhasil diperbarui!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
