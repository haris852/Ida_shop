<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\UserInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    private $user;

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd($this->user->get());
        if ($request->ajax()) {
            return datatables()
                ->of($this->user->get())
                ->addColumn('name', function ($data) {
                    return $data->name ?? '-';
                })
                ->addColumn('phone', function ($data) {
                    return $data->phone ?? '-';
                })
                ->addColumn('address', function ($data) {
                    return $data->address ?? '-';
                })
                ->addColumn('email', function ($data) {
                    return $data->email ?? '-';
                })
                ->addColumn('role', function ($data) {
                    return $data->role;
                })
                ->addColumn('action', function ($data) {
                    return view('admin.user.column.action', ['data' => $data]);
                })
                ->addIndexColumn()
                ->make(true);
        }
        return view("admin.user.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sex' => ['required'],
            'phone' => ['required', 'string', 'max:255'],
            'address' => ['required'],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
        ]);

        try {
            $filename = uniqid() . $request->avatar->getClientOriginalName();
            $request->avatar->storeAs('public/avatar', $filename);
            $request['avatar'] = $filename;
            //
            $request['password'] = Hash::make('password');
            User::create($request->all());

            return redirect()->route('admin.user.index')->with('success', 'Pengguna berhasil ditambah!');
        } catch (\Throwable $th) {
            dd($th->getMessage());
        }
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
        return view('admin.user.edit', [
            'data' => $this->user->getById($id)
        ]);
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
            $user->email = $request->email;
            $user->save();

            return redirect()->route('admin.user.index')->with('success', 'Profil pengguna berhasil diperbarui!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->user->getById($id)->update([
            'is_active' => 0
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Produk berhasil dihapus!'
        ]);
    }

    public function inactive(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->user->getInactive())
                ->addColumn('name', function ($data) {
                    return $data->name ?? '-';
                })
                ->addColumn('phone', function ($data) {
                    return $data->phone ?? '-';
                })
                ->addColumn('address', function ($data) {
                    return $data->address ?? '-';
                })
                ->addColumn('email', function ($data) {
                    return $data->email ?? '-';
                })
                ->addColumn('role', function ($data) {
                    return $data->role;
                })
                ->addColumn('action', function ($data) {
                    return view('admin.user.column.action', ['data' => $data]);
                })
                ->addIndexColumn()
                ->make(true);
        }
        return view("admin.user.inactive");
    }

    public function activate($id)
    {
        $this->user->getById($id)->update([
            'is_active' => 1
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Pengguna berhasil diaktifkan!'
        ]);
    }
}
