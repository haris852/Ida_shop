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

    public function __construct(UserInterface $user) {
        $this->user = $user;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request){
        if($request->ajax()) {
            return datatables()
            ->of($this->user->get())
            ->addColumn('name', function($data) {
                return $data->name;
            })
            ->addColumn('phone', function($data) {
                return $data->phone;
            })
            ->addColumn('address', function($data) {
                return $data->address;
            })
            ->addColumn('email', function($data) {
                return $data->email;
            })
            ->addColumn('role', function($data) {
                return $data->role;
            })
            ->addColumn('action', function($data) {
                return view('admin.dashboard.user.column.action', [
                    'data' => $data
                ]);
            })
            ->addIndexColumn()
            ->make(true);
        }
        return view("admin.dashboard.user.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.dashboard.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'email' => ['nullable', 'string', 'email', 'max:255'],
        //     'password' => ['nullable', 'string', 'min:8'],
        //     'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
        // ], [
        //     'image.image' => 'File yang diupload harus berupa gambar!',
        //     'image.mimes' => 'File yang diupload harus berupa gambar!',
        //     'image.max' => 'Ukuran file yang diupload maksimal 2MB!',
        // ]);
        try {
            //
            $filename = uniqid() . $request->image->getClientOriginalName();
            $request->image->storeAs('public/avatar', $filename);
            $request['avatar'] = $filename;
            //
            $request['password'] = Hash::make($request->password);
            User::create($request->all());

            return redirect()->route('admin.user.index')->with('success', 'Pengguna berhasil ditambah!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
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
        return view('admin.dashboard.user.edit', [
            'data' => $this->user->getById($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // $request->validate([
        //     'email' => ['nullable', 'string', 'email', 'max:255'],
        //     'password' => ['nullable', 'string', 'min:8', 'confirmed'],
        //     'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048']
        // ], [
        //     'avatar.image' => 'File yang diupload harus berupa gambar!',
        //     'avatar.mimes' => 'File yang diupload harus berupa gambar!',
        //     'avatar.max' => 'Ukuran file yang diupload maksimal 2MB!',
        // ]);

        try {
            $user = User::find($id);
            if (isset($request->image)) {
                $filename = uniqid() . $request->image->getClientOriginalName();
                $request->image->storeAs('public/avatar', $filename);
                $request['avatar'] = $filename;

                $oldAvatar = $user->avatar;
                if ($oldAvatar != null) {
                    Storage::delete('public/avatar/' . $oldAvatar);
                }
            }
            //
            $request['password'] = Hash::make($request->password);
            $user->update($request->all());

            return redirect()->route('admin.user.index')->with('success', 'Pengguna berhasil diperbarui!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->user->delete($id);
        return response()->json([
            'status' => true,
            'message' => 'Produk berhasil dihapus!'
        ]);
    }


}
