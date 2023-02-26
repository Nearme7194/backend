<?php

namespace App\Http\Controllers;

use App\Http\Requests\Shops\ShopCreateRequest;
use App\Http\Requests\Shops\ShopUpdateRequest;
use App\Models\Shops;
use App\Models\SubCategoryShops;
use Illuminate\Http\Request;

class ShopsController extends Controller
{
    public function index(Request $request)
    {
        if ($request->paginated == true) {
            return Shops::paginate($request->paginated_count);
        }

        return Shops::all();
    }

    public function store(ShopCreateRequest $request)
    {
        $parmas = $this->setParams($request);
        $shop = Shops::create($parmas);
        foreach ($request->sub_category as $subCategory) {
            $subCategoryParams = [
                "sub_category_id" => $subCategory,
                "shop_id"         => $shop->id
            ];

            $saveSubCategory = SubCategoryShops::create($subCategoryParams);
        }

        return response()->json(
            [
                "message" => "Shop Created Successfully",
                "success" => true
            ],
            201
        );
    }

    public function show(int $tehasilId)
    {
        $tehasil = Shops::find($tehasilId);

        if ($tehasil) {
            return response()->json(
                [
                    "data" => $tehasil,
                    "success" => true
                ],
                200
            );
        }

        return response()->json(
            [
                "message" => "Shop Not Found",
                "success" => false
            ],
            200
        );
    }

    public function update(ShopUpdateRequest $request, $tehasilId)
    {
        $tehasil = Shops::find($tehasilId);

        if ($tehasil) {
            $tehasil->update($this->setParams($request));

            return response()->json(
                [
                    "message" => "Shop Update Successfully",
                    "success" => true
                ],
                201
            );
        }

        return response()->json(
            [
                "message" => "Shop Not Found",
                "success" => false
            ],
            404
        );
    }

    public function destroy(int $tehasilId)
    {
        $tehasil = Shops::find($tehasilId);

        if ($tehasil) {
            $tehasil->delete($tehasilId);

            return response()->json(
                [
                    "message" => "Shop Delete Successfully",
                    "success" => true
                ],
                201
            );
        }

        return response()->json(
            [
                "message" => "Shop Not Found",
                "success" => false
            ],
            404
        );
    }

    public function restore(int $tehasilId)
    {
        $tehasil = Shops::onlyTrashed()->find($tehasilId);

        if ($tehasil) {

            $tehasil->restore();

            return response()->json(
                [
                    "message" => "Shop Restore Successfully",
                    "success" => true
                ],
                201
            );
        }

        return response()->json(
            [
                "message" => "Shop Not Found",
                "success" => false
            ],
            404
        );
    }

    public function deletedShopsList(Request $request)
    {
        if ($request->paginated == true) {
            return Shops::onlyTrashed()->paginate($request->paginated_count);
        }

        return Shops::onlyTrashed()->get();
    }

    private function setParams($request)
    {
        $data  =  [
            'name'           => $request->name,
            'contact_number' => $request->contact_number,
            'open_24'        => $request->open_24,
            'category_id'    => $request->category_id,
            'location_id'    => $request->location_id,
            'address_id'     => $request->address_id,
            "user_id"        => 1 //update with current users
        ];

        if ($request->open_24 == 0) {

            $data1 =  [
                'open_time'      => $request->open_time,
                'close_time'     => $request->close_time,
            ];

           $data = array_merge($data, $data1);
        }

        return $data;
    }
}
