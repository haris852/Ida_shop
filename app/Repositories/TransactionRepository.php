<?php

namespace App\Repositories;

use App\Interfaces\TransactionInterface;
use App\Models\ConfigurationStore;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\DB;

class TransactionRepository implements TransactionInterface
{
    private $transaction;
    private $transactionDetail;
    private $storeConfiguration;

    public function __construct(Transaction $transaction, TransactionDetail $transactionDetail, ConfigurationStore $storeConfiguration)
    {
        $this->transaction = $transaction;
        $this->transactionDetail = $transactionDetail;
        $this->storeConfiguration = $storeConfiguration;
    }

    public function getAll()
    {
        return $this->transaction->with(['user', 'transactionDetail.product'])->orderBy('created_at', 'desc')->get();
    }

    public function store($attributes)
    {
        $shippingCost = $this->storeConfiguration->first()->shipping_cost;

        DB::beginTransaction();

        // transaction
        try {
            foreach ($attributes['carts'] as $cart) {
                $product = $this->transactionDetail->where('product_id', $cart['id'])->first();
                if ($product->product->stock < $cart['quantity']) {
                    throw new \Exception('Stock ' . $product->product->name . ' tidak mencukupi');
                }
            }

            $transaction = $this->transaction->create([
                'transaction_code' => $this->transaction->generateTransactionCode(),
                'receiver_name' => $attributes['receiver_name'],
                'receiver_phone' => $attributes['receiver_phone'],
                'receiver_address' => $attributes['address'],
                'note' => $attributes['note'] ?? null,
                'status' => $this->transaction::STATUS_PENDING,
                'user_id' => auth()->user()->id,
                'payment_method' => $attributes['payment_method'],
                'total_price' => $attributes['subTotal'] + $shippingCost,
                'shipping_price' => $shippingCost,
                'total_payment' => $attributes['total']
            ]);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        // transaction detail
        try {
            foreach ($attributes['carts'] as $cart) {
                $this->transactionDetail->create([
                    'transaction_id' => $transaction->id,
                    'product_id' => $cart['id'],
                    'qty' => $cart['quantity'],
                    'price' => $cart['price'],
                    'total_price' => $cart['subtotal']
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        // change stock
        try {
            foreach ($attributes['carts'] as $cart) {
                $product = $this->transactionDetail->where('product_id', $cart['id'])->first();
                $product->product->update([
                    'stock' => $product->product->stock - $cart['quantity']
                ]);
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        DB::commit();
    }

    public function getTransactionByUserId($userId)
    {
        return $this->transaction->where('user_id', $userId)->with('transactionDetail.product')->orderBy('created_at', 'desc')->get();
    }

    public function destroy($id)
    {
        $transaction = $this->transaction->findOrFail($id);

        DB::beginTransaction();

        try {
            $transaction->delete();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        try {
            $transaction->transactionDetail()->delete();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }

        DB::commit();
    }

    public function getById($id)
    {
        return $this->transaction->with('transactionDetail.product')->findOrFail($id);
    }

    public function confirm($id, $attributes)
    {
        $filename = uniqid() . '-' . $attributes['proof_of_payment']->getClientOriginalName();
        $attributes['proof_of_payment']->storeAs('public/payment', $filename);

        return $this->transaction->find($id)->update([
            'status' => $this->transaction::STATUS_PAID,
            'proof_of_payment' => $filename
        ]);
    }
}
