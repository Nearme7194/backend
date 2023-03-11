<?php

namespace App\Http\Controllers;

use App\Http\Requests\Districts\DistrictCreateRequest;
use App\Http\Requests\Districts\DistrictUpdateRequest;
use App\Models\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    public function index(Request $request)
    {
        if ($request->paginated == true) {
            return District::paginate($request->paginated_count);
        }

        return District::all();
    }

    public function store(DistrictCreateRequest $request)
    {
        District::create($this->setParams($request));

        return response()->json(
            [
                "message" => "District Created Successfully",
                "success" => true
            ],
            201
        );
    }

    public function show(int $subCategoryId)
    {
        $subCategory = District::find($subCategoryId);

        if ($subCategory) {
            return response()->json(
                [
                    "data" => $subCategory,
                    "success" => true
                ],
                200
            );
        }

        return response()->json(
            [
                "message" => "District Not Found",
                "success" => false
            ],
            200
        );
    }

    public function update(DistrictUpdateRequest $request, $subCategoryId)
    {
        $subCategory = District::find($subCategoryId);

        if ($subCategory) {
            $subCategory->update($this->setParams($request));

            return response()->json(
                [
                    "message" => "District Update Successfully",
                    "success" => true
                ],
                201
            );
        }

        return response()->json(
            [
                "message" => "District Not Found",
                "success" => false
            ],
            404
        );
    }

    public function destroy(int $subCategoryId)
    {
        $subCategory = District::find($subCategoryId);

        if ($subCategory) {
            $subCategory->delete($subCategoryId);

            return response()->json(
                [
                    "message" => "District Delete Successfully",
                    "success" => true
                ],
                201
            );
        }

        return response()->json(
            [
                "message" => "District Not Found",
                "success" => false
            ],
            404
        );

    }

    public function restore(int $subCategoryId)
    {
        $subCategory = District::onlyTrashed()->find($subCategoryId);

        if ($subCategory) {

            $subCategory->restore();

            return response()->json(
                [
                    "message" => "District Restore Successfully",
                    "success" => true
                ],
                201
            );
        }

        return response()->json(
            [
                "message" => "District Not Found",
                "success" => false
            ],
            404
        );
    }

    public function deletedDistrictsList(Request $request)
    {
        if ($request->paginated == true) {
            return District::onlyTrashed()->paginate($request->paginated_count);
        }

        return District::onlyTrashed()->get();
    }

    private function setParams($request)
    {
        return [
            'name' => $request->name,
            'state_id' => $request->state_id
        ];
    }
}
