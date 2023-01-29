<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubCategories\SubCategoryCreateRequest;
use App\Http\Requests\SubCategories\SubCategoryUpdateRequest;
use App\Models\SubCategories;
use Illuminate\Http\Request;

class SubCategoriesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->paginated == true) {
            return SubCategories::paginate($request->paginated_count);
        }

        return SubCategories::all();
    }

    public function store(SubCategoryCreateRequest $request)
    {
        SubCategories::create($this->setParams($request));

        return response()->json(
            [
                "message" => "SubCategory Created Successfully",
                "success" => true
            ],
            201
        );
    }

    public function show(int $subCategoryId)
    {
        $subCategory = SubCategories::find($subCategoryId);

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
                "message" => "SubCategory Not Found",
                "success" => false
            ],
            200
        );
    }

    public function update(SubCategoryUpdateRequest $request, $subCategoryId)
    {
        $subCategory = SubCategories::find($subCategoryId);

        if ($subCategory) {
            $subCategory->update($this->setParams($request));

            return response()->json(
                [
                    "message" => "SubCategory Update Successfully",
                    "success" => true
                ],
                201
            );
        }

        return response()->json(
            [
                "message" => "SubCategory Not Found",
                "success" => false
            ],
            404
        );
    }

    public function destroy(int $subCategoryId)
    {
        $subCategory = SubCategories::find($subCategoryId);

        if ($subCategory) {
            $subCategory->delete($subCategoryId);

            return response()->json(
                [
                    "message" => "SubCategory Delete Successfully",
                    "success" => true
                ],
                201
            );
        }

        return response()->json(
            [
                "message" => "SubCategory Not Found",
                "success" => false
            ],
            404
        );

    }

    public function restore(int $subCategoryId)
    {
        $subCategory = SubCategories::onlyTrashed()->find($subCategoryId);

        if ($subCategory) {

            $subCategory->restore();

            return response()->json(
                [
                    "message" => "SubCategory Restore Successfully",
                    "success" => true
                ],
                201
            );
        }

        return response()->json(
            [
                "message" => "SubCategory Not Found",
                "success" => false
            ],
            404
        );
    }

    public function deletedSubCategoriesList(Request $request)
    {
        if ($request->paginated == true) {
            return SubCategories::onlyTrashed()->paginate($request->paginated_count);
        }

        return SubCategories::onlyTrashed()->get();
    }

    private function setParams($request)
    {
        return [
            'name' => $request->name,
            'category_id' => $request->category_id
        ];
    }
}
