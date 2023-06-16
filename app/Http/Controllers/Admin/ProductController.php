<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\ProductInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $product;

    public function __construct(ProductInterface $product)
    {
        $this->product = $product;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->product->get())
                ->addColumn('image', function ($data) {
                    return view('admin.product.column.image', ['data' => $data]);
                })
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('category', function ($data) {
                    return $data->category;
                })
                ->addColumn('weight', function ($data) {
                    return $data->weight . ' ' . $data->unit;
                })
                ->addColumn('stock', function ($data) {
                    return $data->stock . ' item';
                })
                ->addColumn('price', function ($data) {
                    return 'Rp. ' . number_format($data->price, 0, ',', '.');
                })
                ->addColumn('status', function ($data) {
                    return view('admin.product.column.status', ['data' => $data]);
                })
                ->addColumn('action', function ($data) {
                    return view('admin.product.column.action', [
                        'data' => $data
                    ]);
                })
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'weight' => ['required'],
            'stock' => ['required'],
            'unit' => ['required'],
            'description' => ['nullable'],
            'price' => ['required'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ], [
            'name.required' => 'Nama produk tidak boleh kosong!',
            'category.required' => 'Kategori produk tidak boleh kosong!',
            'weight.required' => 'Berat produk tidak boleh kosong!',
            'unit.required' => 'Satuan produk tidak boleh kosong!',
            'stock.required' => 'Stok produk tidak boleh kosong!',
            'price.required' => 'Harga produk tidak boleh kosong!',
            'image.image' => 'File yang diupload harus berupa gambar!',
            'image.mimes' => 'File yang diupload harus berupa gambar!',
            'image.max' => 'Ukuran file yang diupload maksimal 2MB!',
        ]);

        try {
            $this->product->store($request->all());
            return redirect()->route('admin.product.index')->with('success', 'Produk berhasil ditambahkan!');
        } catch (\Throwable $th) {
            return redirect()->route('admin.product.index')->with('error', 'Produk gagal ditambahkan!');
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
        return view('admin.product.edit', [
            'data' => $this->product->getById($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:255'],
            'weight' => ['required'],
            'stock' => ['required'],
            'unit' => ['required'],
            'price' => ['required'],
            'description' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ], [
            'name.required' => 'Nama produk tidak boleh kosong!',
            'category.required' => 'Kategori produk tidak boleh kosong!',
            'weight.required' => 'Berat produk tidak boleh kosong!',
            'unit.required' => 'Satuan produk tidak boleh kosong!',
            'stock.required' => 'Stok produk tidak boleh kosong!',
            'price.required' => 'Harga produk tidak boleh kosong!',
            'image.image' => 'File yang diupload harus berupa gambar!',
            'image.mimes' => 'File yang diupload harus berupa gambar!',
            'image.max' => 'Ukuran file yang diupload maksimal 2MB!',
        ]);

        try {
            $this->product->update($id, $request->all());
            return redirect()->route('admin.product.index')->with('success', 'Produk berhasil diperbarui!');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui produk!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->product->delete($id);
        return response()->json([
            'status' => true,
            'message' => 'Produk berhasil dihapus!'
        ]);
    }
}
