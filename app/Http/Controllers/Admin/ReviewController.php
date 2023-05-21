<?php

namespace App\Http\Controllers\Admin;

use App\Models\Review;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{

    public function index(Request $request)
    {
        if($request->ajax())
        {
            return datatables()
            ->of(Review::with(['transaction', 'user'])->get())
            ->addColumn('invoice_number', function($data) {
                return $data->transaction->transaction_code;
            })
            ->addColumn('rating', function($data) {
                return $data->rating;
            })
            ->addColumn('review', function($data) {
                return $data->review;
            })
            ->addColumn('user', function($data) {
                return $data->user->name;
            })
            ->addIndexColumn()
            ->make(true);
        }

        return view('admin.review.index');
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
