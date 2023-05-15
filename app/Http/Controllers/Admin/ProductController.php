<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\ProductInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $product;

    public function __construct(ProductInterface $product) {
        $this->product = $product;
    }

    public function index(Request $request)
    {
        if($request->ajax()) {
            return datatables()
            ->of($this->product->get())
            ->addColumn('name', function($data) {
                return $data->name;
            })
            ->addColumn('category', function($data) {
                return $data->category;
            })
            ->addColumn('weight', function($data) {
                return $data->weight . 'g';
            })
            ->addColumn('stock', function($data) {
                return $data->stock . 'pcs';
            })
            ->addColumn('price', function($data) {
                return 'Rp. ' . number_format($data->price, 0, ',', '.');
            })
            ->addColumn('status', function($data) {
                return  $data->is_active == 1 ? 'Aktif' : 'Tidak aktif';
            })
            ->addColumn('action', function($data) {
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
