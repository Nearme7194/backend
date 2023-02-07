<?php

namespace App\Http\Controllers;

use App\Http\Requests\Tehasils\TehasilCreateRequest;
use App\Http\Requests\Tehasils\TehasilUpdateRequest;
use App\Models\Tehasil;
use Illuminate\Http\Request;

class TehasilController extends Controller
{
    public function index(Request $request)
    {
        if ($request->paginated == true) {
            return Tehasil::paginate($request->paginated_count);
        }

        return Tehasil::all();
    }

    public function store(TehasilCreateRequest $request)
    {
        Tehasil::create($this->setParams($request));

        return response()->json(
            [
                "message" => "Tehasil Created Successfully",
                "success" => true
            ],
            201
        );
    }

    public function show(int $tehasilId)
    {
        $tehasil = Tehasil::find($tehasilId);

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
                "message" => "Tehasil Not Found",
                "success" => false
            ],
            200
        );
    }

    public function update(TehasilUpdateRequest $request, $tehasilId)
    {
        $tehasil = Tehasil::find($tehasilId);

        if ($tehasil) {
            $tehasil->update($this->setParams($request));

            return response()->json(
                [
                    "message" => "Tehasil Update Successfully",
                    "success" => true
                ],
                201
            );
        }

        return response()->json(
            [
                "message" => "Tehasil Not Found",
                "success" => false
            ],
            404
        );
    }

    public function destroy(int $tehasilId)
    {
        $tehasil = Tehasil::find($tehasilId);

        if ($tehasil) {
            $tehasil->delete($tehasilId);

            return response()->json(
                [
                    "message" => "Tehasil Delete Successfully",
                    "success" => true
                ],
                201
            );
        }

        return response()->json(
            [
                "message" => "Tehasil Not Found",
                "success" => false
            ],
            404
        );

    }

    public function restore(int $tehasilId)
    {
        $tehasil = Tehasil::onlyTrashed()->find($tehasilId);

        if ($tehasil) {

            $tehasil->restore();

            return response()->json(
                [
                    "message" => "Tehasil Restore Successfully",
                    "success" => true
                ],
                201
            );
        }

        return response()->json(
            [
                "message" => "Tehasil Not Found",
                "success" => false
            ],
            404
        );
    }

    public function deletedTehasilList(Request $request)
    {
        if ($request->paginated == true) {
            return Tehasil::onlyTrashed()->paginate($request->paginated_count);
        }

        return Tehasil::onlyTrashed()->get();
    }

    private function setParams($request)
    {
        return [
            'name' => $request->name,
            'state_id' => $request->state_id,
            'district_id' => $request->district_id
        ];
    }
}
