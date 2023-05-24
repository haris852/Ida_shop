<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Interfaces\ProductInterface;
use App\Models\ConfigurationStore;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $product;

    public function __construct(ProductInterface $product)
    {
        $this->product = $product;
    }

    public function index()
    {
        $configurationStore = ConfigurationStore::first();
        return view('customer.home', [
            'products' => $this->product->get(),
            'cart' => session()->get('cart') ?? '',
            'isOpen' => $configurationStore->isOpen(),
            'openTime' => Carbon::parse($configurationStore->open_at)->format('H:i'),
        ]);
    }

    public function cart()
    {
        // check if user active
        if (!auth()->user()->is_active) {
            return redirect()->route('home')->with('error', 'Anda tidak bisa melakukan pemesanan, silahkan hubungi admin untuk mengaktifkan akun anda');
        }
        $configurationStore = ConfigurationStore::first();
        return view('customer.cart', [
            'carts' => session()->get('cart') ?? '',
            'isOpen' => $configurationStore->isOpen(),
            'openTime' => Carbon::parse($configurationStore->open_at)->format('H:i'),
        ]);
    }

    public function cartStore(Request $request)
    {
        $product = $this->product->getById($request->id);
        if (!$request->session()->has('cart') || !array_key_exists($product->id, $request->session()->get('cart'))) {
            $request->session()->put('cart.' . $product->id, [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'image' => $product->image,
                'weight' => $product->weight,
                'unit' => $product->unit,
                'quantity' => 1,
                'subtotal' => $product->price
            ]);
        } else {
            $request->session()->put('cart.' . $product->id . '.quantity', $request->session()->get('cart.' . $product->id . '.quantity') + 1);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Produk berhasil ditambahkan ke keranjang',
            'cart' => $request->session()->get('cart')
        ]);
    }

    public function cartDestroy(Request $request)
    {
        $cart = $request->session()->get('cart');
        unset($cart[$request->id]);
        $request->session()->put('cart', $cart);

        return true;
    }

    public function menu()
    {
        return view('customer.menu', [
            'products' => $this->product->get(),
            'categories' => $this->product->getCategories(),
        ]);
    }
}
