<?php

namespace App\Http\Controllers;

use App\Http\Requests\Categories\CategoryCreateRequest;
use App\Http\Requests\Categories\CategoryUpdateRequest;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        if ($request->paginated == true) {
            return Categories::paginate($request->paginated_count);
        }

        return Categories::all();
    }

    public function store(CategoryCreateRequest $request)
    {
        Categories::create($this->setParams($request));

        return response()->json(
            [
                "message" => "Category Created Successfully",
                "success" => true
            ],
            201
        );
    }

    public function show(int $categoryId)
    {
        $category = Categories::find($categoryId);

        if ($category) {
            return response()->json(
                [
                    "data" => $category,
                    "success" => true
                ],
                200
            );
        }

        return response()->json(
            [
                "message" => "Category Not Found",
                "success" => false
            ],
            200
        );
    }

    public function update(CategoryUpdateRequest $request, $categoryId)
    {
        $category = Categories::find($categoryId);

        if ($category) {
            $category->update($this->setParams($request));

            return response()->json(
                [
                    "message" => "Category Update Successfully",
                    "success" => true
                ],
                201
            );
        }

        return response()->json(
            [
                "message" => "Category Not Found",
                "success" => false
            ],
            404
        );
    }

    public function destroy(int $categoryId)
    {
        $category = Categories::find($categoryId);

        if ($category) {
            $category->delete($categoryId);

            return response()->json(
                [
                    "message" => "Category Delete Successfully",
                    "success" => true
                ],
                201
            );
        }

        return response()->json(
            [
                "message" => "Category Not Found",
                "success" => false
            ],
            404
        );

    }

    public function restore(int $categoryId)
    {
        $category = Categories::onlyTrashed()->find($categoryId);

        if ($category) {

            $category->restore();

            return response()->json(
                [
                    "message" => "Category Restore Successfully",
                    "success" => true
                ],
                201
            );
        }

        return response()->json(
            [
                "message" => "Category Not Found",
                "success" => false
            ],
            404
        );
    }

    public function deletedCategoryList(Request $request)
    {
        if ($request->paginated == true) {
            return Categories::onlyTrashed()->paginate($request->paginated_count);
        }

        return Categories::onlyTrashed()->get();
    }

    private function setParams($request)
    {
        return [
            'name' => $request->name
        ];
    }
}
