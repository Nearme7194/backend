<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\CreateProductRequest;
use App\Http\Requests\Products\ProductUpdateRequest;
use App\Models\Products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->paginated == true) {
            return Products::paginate($request->paginated_count);
        }

        return Products::all();
    }

    public function store(CreateProductRequest $request)
    {
        Products::create($this->setParams($request));

        return response()->json(
            [
                "message" => "Product Created Successfully",
                "success" => true
            ],
            201
        );
    }

    public function show(int $productId)
    {
        $product = Products::find($productId);

        if ($product) {
            return response()->json(
                [
                    "data" => $product,
                    "success" => true
                ],
                200
            );
        }

        return response()->json(
            [
                "message" => "Product Not Found",
                "success" => false
            ],
            200
        );
    }

    public function update(ProductUpdateRequest $request, $productId)
    {
        $product = Products::find($productId);

        if ($product) {
            $product->update($this->setParams($request));

            return response()->json(
                [
                    "message" => "Product Update Successfully",
                    "success" => true
                ],
                201
            );
        }

        return response()->json(
            [
                "message" => "Product Not Found",
                "success" => false
            ],
            404
        );
    }

    public function destroy(int $productId)
    {
        $product = Products::find($productId);

        if ($product) {
            $product->delete($productId);

            return response()->json(
                [
                    "message" => "Product Delete Successfully",
                    "success" => true
                ],
                201
            );
        }

        return response()->json(
            [
                "message" => "Product Not Found",
                "success" => false
            ],
            404
        );

    }

    public function restore(int $productId)
    {
        $product = Products::onlyTrashed()->find($productId);

        if ($product) {

            $product->restore();

            return response()->json(
                [
                    "message" => "Product Restore Successfully",
                    "success" => true
                ],
                201
            );
        }

        return response()->json(
            [
                "message" => "Product Not Found",
                "success" => false
            ],
            404
        );
    }

    public function deletedProductList(Request $request)
    {
        if ($request->paginated == true) {
            return Products::onlyTrashed()->paginate($request->paginated_count);
        }

        return Products::onlyTrashed()->get();
    }

    private function setParams($request)
    {
        return [
            'name' => $request->name
        ];
    }


}
