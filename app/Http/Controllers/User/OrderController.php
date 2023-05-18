<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Interfaces\TransactionInterface;
use App\Models\ConfigurationStore;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private $transaction;

    public function __construct(TransactionInterface $transaction)
    {
        $this->transaction = $transaction;
    }

    public function index()
    {
        if(!auth()->check()) {
            return redirect()->route('login');
        }

        return view('customer.order', [
            'storeConfiguration' => ConfigurationStore::first(),
            'orders' => $this->transaction->getTransactionByUserId(auth()->user()->id),
        ]);
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
        return response()->json($this->transaction->getById($id));
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
        $this->transaction->destroy($id);
        return response()->json([
            'message' => 'Transaksi berhasil dihapus'
        ]);
    }

    public function confirm(Request $request, string $id)
    {
        $this->transaction->confirm($id, $request->all());
        return redirect()->back()->with('success', 'Transaksi berhasil dikonfirmasi');
    }

}
