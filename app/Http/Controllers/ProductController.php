<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    const DEFAULT_PAGE = 1;
    const DEFAULT_LIMIT = 10;

    public function index(Request $request, User $user)
    {
        $page = $request->query('page', ProductController::DEFAULT_PAGE);
        $limit = $request->query('limit', ProductController::DEFAULT_LIMIT);
        $skip = ($page - 1) * $limit;

        $products = $user->products()
                        ->orderByDesc('id')
                        ->skip($skip)
                        ->take($limit)
                        ->get();

        return view('products', [
            'products' => $products,
        ]);
    }

    public function store(StoreProductRequest $request, User $user)
    {
        $vBody = $request->validated();
        $vBody["slug"] = Str::slug($vBody["name"]);

        $product = $user->products()->create($vBody);

        return $product;
    }

    public function find(User $user, int $id)
    {
        return $user->products()->find($id);
    }

    public function update(UpdateProductRequest $request, User $user, int $id)
    {
        $vBody = $request->validated();
        if (isset($vBody["name"])) {
            $vBody["slug"] = Str::slug($vBody["name"]);
        }

        $product = $this->find($user, $id)->update($vBody);

        return $product;
    }

    public function destroy(User $user, int $id)
    {
        return $this->find($user, $id)->delete();
    }
}
