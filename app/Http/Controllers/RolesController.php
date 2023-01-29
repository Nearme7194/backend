<?php

namespace App\Http\Controllers;

use App\Http\Requests\Roles\RoleCreateRequest;
use App\Http\Requests\Roles\RoleUpdateRequest;
use App\Models\Roles;
use Illuminate\Http\Request;

class RolesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->paginated == true) {
            return Roles::paginate($request->paginated_count);
        }

        return Roles::all();
    }

    public function store(RoleCreateRequest $request)
    {
        Roles::create($this->setParams($request));

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
        $product = Roles::find($productId);

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

    public function update(RoleUpdateRequest $request, $productId)
    {
        $product = Roles::find($productId);

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
        $product = Roles::find($productId);

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
        $product = Roles::onlyTrashed()->find($productId);

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

    public function deletedRoleList(Request $request)
    {
        if ($request->paginated == true) {
            return Roles::onlyTrashed()->paginate($request->paginated_count);
        }

        return Roles::onlyTrashed()->get();
    }

    private function setParams($request)
    {
        return [
            'name' => $request->name
        ];
    }
}
