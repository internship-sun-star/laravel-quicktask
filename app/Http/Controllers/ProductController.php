<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    const DEFAULT_PAGE = 1;
    const DEFAULT_LIMIT = 10;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, User $user)
    {
        $page = $request->query('page', ProductController::DEFAULT_PAGE);
        $limit = $request->query('limit', ProductController::DEFAULT_LIMIT);

        $products = $user->products;

        return view('products', [
            'products' => $products,
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
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
