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
                "message" => "Medium Created Successfully",
                "success" => true
            ],
            201
        );
    }

    public function show(int $mediumId)
    {
        $medium = Medium::find($mediumId);

        if ($medium) {
            return response()->json(
                [
                    "data" => $medium,
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

    public function update(MediumUpdateRequest $request, $mediumId)
    {
        $medium = Medium::find($mediumId);

        if ($medium) {
            $medium->update($this->setParams($request));

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

    public function destroy(int $mediumId)
    {
        $medium = Medium::find($mediumId);

        if ($medium) {
            $medium->delete($mediumId);

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

    public function restore(int $mediumId)
    {
        $medium = Medium::onlyTrashed()->find($mediumId);

        if ($medium) {

            $medium->restore();

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
