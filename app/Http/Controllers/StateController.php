<?php

namespace App\Http\Controllers;

use App\Http\Requests\States\StateCreateRequest;
use App\Http\Requests\States\StateUpdateRequest;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    public function index(Request $request)
    {
        if ($request->paginated == true) {
            return State::paginate($request->paginated_count);
        }

        return State::all();
    }

    public function store(StateCreateRequest $request)
    {
        State::create($this->setParams($request));

        return response()->json(
            [
                "message" => "State Created Successfully",
                "success" => true
            ],
            201
        );
    }

    public function show(int $stateId)
    {
        $state = State::find($stateId);

        if ($state) {
            return response()->json(
                [
                    "data" => $state,
                    "success" => true
                ],
                200
            );
        }

        return response()->json(
            [
                "message" => "State Not Found",
                "success" => false
            ],
            200
        );
    }

    public function update(StateUpdateRequest $request, $stateId)
    {
        $state = State::find($stateId);

        if ($state) {
            $state->update($this->setParams($request));

            return response()->json(
                [
                    "message" => "State Update Successfully",
                    "success" => true
                ],
                201
            );
        }

        return response()->json(
            [
                "message" => "State Not Found",
                "success" => false
            ],
            404
        );
    }

    public function destroy(int $stateId)
    {
        $state = State::find($stateId);

        if ($state) {
            $state->delete($stateId);

            return response()->json(
                [
                    "message" => "State Delete Successfully",
                    "success" => true
                ],
                201
            );
        }

        return response()->json(
            [
                "message" => "State Not Found",
                "success" => false
            ],
            404
        );

    }

    public function restore(int $stateId)
    {
        $state = State::onlyTrashed()->find($stateId);

        if ($state) {

            $state->restore();

            return response()->json(
                [
                    "message" => "State Restore Successfully",
                    "success" => true
                ],
                201
            );
        }

        return response()->json(
            [
                "message" => "State Not Found",
                "success" => false
            ],
            404
        );
    }

    public function deletedStateList(Request $request)
    {
        if ($request->paginated == true) {
            return State::onlyTrashed()->paginate($request->paginated_count);
        }

        return State::onlyTrashed()->get();
    }

    private function setParams($request)
    {
        return [
            'name' => $request->name
        ];
    }
}
