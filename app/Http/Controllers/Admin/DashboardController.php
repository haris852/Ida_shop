<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\TransactionDetail;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $transaction;
    private $transactionDetail;
    private $product;

    public function __construct(Transaction $transaction, TransactionDetail $transactionDetail, Product $product) {
        $this->transaction = $transaction;
        $this->transactionDetail = $transactionDetail;
        $this->product = $product;
    }

    public function __invoke()
    {
        $totalSales = $this->transaction->getTotalSales();
        $totalSalesDifference = $this->transaction->getTotalSalesDifference();
        $totalSalesDaily = $this->transaction->getTotalSalesDaily();

        return view('admin.dashboard.index', [
            'totalSales' => $this->formatRupiah($totalSales),
            'totalSalesDifference' => $totalSalesDifference,
            'totalSalesDaily' => $this->formatRupiah($totalSalesDaily),
            'totalCustomer' => $this->transaction->getTotalCustomers(),
            'totalCustomerDaily' => $this->transaction->getTotalCustomersDaily(),
            'totalCustomerDifference' => $this->transaction->getTotalCustomersDifference(),
            'totalProductSales' => $this->transactionDetail->getTotalProductSales(),
            'totalProductSalesDifference' => $this->transactionDetail->getTotalProductSalesDifference(),
            'totalSalesProductCategory' => $this->product->getTotalSalesByCategory(),
        ]);
    }

    private function formatRupiah($number)
    {
        $number = (int) $number;
        // change 000 to K, 000,000 to M, 000,000,000 to B
        if ($number >= 1000000000) {
            $number = round($number / 1000000000, 1) . ' B';
        } else if ($number >= 1000000) {
            $number = round($number / 1000000, 1) . ' M';
        } else if ($number >= 1000) {
            $number = round($number / 1000, 1) . ' K';
        }

        return $number;
    }
}
