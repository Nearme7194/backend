<?php

namespace App\Http\Controllers;

use App\Http\Requests\Medium\MediumCreateRequest;
use App\Http\Requests\Medium\MediumUpdateRequest;
use App\Models\Medium;
use Illuminate\Http\Request;

class MediumController extends Controller
{
    public function index(Request $request)
    {
        if ($request->paginated == true) {
            return Medium::paginate($request->paginated_count);
        }

        return Medium::all();
    }

    public function store(MediumCreateRequest $request)
    {
        Medium::create($this->setParams($request));

        return response()->json(
            [
                "message" => "Prodcut Created Successfully",
                "success" => true
            ],
            201
        );
    }

    public function show(int $productId)
    {
        $product = Medium::find($productId);

        if ($product) {
            return response()->json(
                [
                    "Medium_data" => $product,
                    "success" => true
                ],
                200
            );
        }

        return response()->json(
            [
                "message" => "Medium Not Found",
                "success" => false
            ],
            200
        );
    }

    public function update(MediumUpdateRequest $request, $productId)
    {
        $product = Medium::find($productId);

        if ($product) {
            $product->update($this->setParams($request));

            return response()->json(
                [
                    "message" => "Medium Update Successfully",
                    "success" => true
                ],
                201
            );
        }

        return response()->json(
            [
                "message" => "Medium Not Found",
                "success" => false
            ],
            404
        );
    }

    public function destroy(int $productId)
    {
        $product = Medium::find($productId);

        if ($product) {
            $product->delete($productId);

            return response()->json(
                [
                    "message" => "Medium Delete Successfully",
                    "success" => true
                ],
                201
            );
        }

        return response()->json(
            [
                "message" => "Medium Not Found",
                "success" => false
            ],
            404
        );

    }

    public function restore(int $productId)
    {
        $product = Medium::onlyTrashed()->find($productId);

        if ($product) {

            $product->restore();

            return response()->json(
                [
                    "message" => "Medium Restore Successfully",
                    "success" => true
                ],
                201
            );
        }

        return response()->json(
            [
                "message" => "Medium Not Found",
                "success" => false
            ],
            404
        );
    }

    public function deletedMediumList(Request $request)
    {
        if ($request->paginated == true) {
            return Medium::onlyTrashed()->paginate($request->paginated_count);
        }

        return Medium::onlyTrashed()->get();
    }

    private function setParams($request)
    {
        return [
            'name' => $request->name
        ];
    }
}
