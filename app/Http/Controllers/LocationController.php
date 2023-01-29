<?php

namespace App\Http\Controllers;

use App\Http\Requests\Locations\LocationCreateRequest;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        if ($request->paginated == true) {
            return Location::paginate($request->paginated_count);
        }

        return Location::all();
    }

    public function store(LocationCreateRequest $request)
    {
        Location::create($this->setParams($request));

        return response()->json(
            [
                "message" => "Location Created Successfully",
                "success" => true
            ],
            201
        );
    }

    public function show(int $locationId)
    {
        $location = Location::find($locationId);

        if ($location) {
            return response()->json(
                [
                    "data" => $location,
                    "success" => true
                ],
                200
            );
        }

        return response()->json(
            [
                "message" => "Location Not Found",
                "success" => false
            ],
            200
        );
    }

    public function update(LocationCreateRequest $request, $locationId)
    {
        $location = Location::find($locationId);

        if ($location) {
            $location->update($this->setParams($request));

            return response()->json(
                [
                    "message" => "Location Update Successfully",
                    "success" => true
                ],
                201
            );
        }

        return response()->json(
            [
                "message" => "Location Not Found",
                "success" => false
            ],
            404
        );
    }

    public function destroy(int $locationId)
    {
        $location = Location::find($locationId);

        if ($location) {
            $location->delete($locationId);

            return response()->json(
                [
                    "message" => "Location Delete Successfully",
                    "success" => true
                ],
                201
            );
        }

        return response()->json(
            [
                "message" => "Location Not Found",
                "success" => false
            ],
            404
        );

    }

    public function restore(int $locationId)
    {
        $location = Location::onlyTrashed()->find($locationId);

        if ($location) {

            $location->restore();

            return response()->json(
                [
                    "message" => "Location Restore Successfully",
                    "success" => true
                ],
                201
            );
        }

        return response()->json(
            [
                "message" => "Location Not Found",
                "success" => false
            ],
            404
        );
    }

    public function deletedLocationList(Request $request)
    {
        if ($request->paginated == true) {
            return Location::onlyTrashed()->paginate($request->paginated_count);
        }

        return Location::onlyTrashed()->get();
    }

    private function setParams($request)
    {
        return [
            'name' => $request->name
        ];
    }
}
