<?php

namespace App\Http\Controllers;

use App\Http\Requests\Addresses\AddressesCreateRequest;
use App\Http\Requests\Addresses\AddressesUpdateRequest;
use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function index(Request $request)
    {
        if ($request->paginated == true) {
            return Address::paginate($request->paginated_count);
        }

        return Address::all();
    }

    public function store(AddressesCreateRequest $request)
    {
        // dd($this->setParams($request));
        Address::create($this->setParams($request));

        return response()->json(
            [
                "message" => "Address Created Successfully",
                "success" => true
            ],
            201
        );
    }

    public function show(int $tehasilId)
    {
        $tehasil = Address::find($tehasilId);

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
                "message" => "Address Not Found",
                "success" => false
            ],
            200
        );
    }

    public function update(AddressesUpdateRequest $request, $tehasilId)
    {
        $tehasil = Address::find($tehasilId);

        if ($tehasil) {
            $tehasil->update($this->setParams($request));

            return response()->json(
                [
                    "message" => "Address Update Successfully",
                    "success" => true
                ],
                201
            );
        }

        return response()->json(
            [
                "message" => "Address Not Found",
                "success" => false
            ],
            404
        );
    }

    public function destroy(int $tehasilId)
    {
        $tehasil = Address::find($tehasilId);

        if ($tehasil) {
            $tehasil->delete($tehasilId);

            return response()->json(
                [
                    "message" => "Address Delete Successfully",
                    "success" => true
                ],
                201
            );
        }

        return response()->json(
            [
                "message" => "Address Not Found",
                "success" => false
            ],
            404
        );

    }

    public function restore(int $tehasilId)
    {
        $tehasil = Address::onlyTrashed()->find($tehasilId);

        if ($tehasil) {

            $tehasil->restore();

            return response()->json(
                [
                    "message" => "Address Restore Successfully",
                    "success" => true
                ],
                201
            );
        }

        return response()->json(
            [
                "message" => "Address Not Found",
                "success" => false
            ],
            404
        );
    }

    public function deletedTehasilList(Request $request)
    {
        if ($request->paginated == true) {
            return Address::onlyTrashed()->paginate($request->paginated_count);
        }

        return Address::onlyTrashed()->get();
    }

    private function setParams($request)
    {
        return [
            'body' => $request->body,
            'pincode' => $request->pincode,
            'state_id' => $request->state_id,
            'district_id' => $request->district_id,
            'tehasils_id'  => $request->tehasil_id
        ];
    }
}
