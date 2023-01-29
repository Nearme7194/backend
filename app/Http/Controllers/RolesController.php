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
                "message" => "Role Created Successfully",
                "success" => true
            ],
            201
        );
    }

    public function show(int $roleId)
    {
        $role = Roles::find($roleId);

        if ($role) {
            return response()->json(
                [
                    "data" => $role,
                    "success" => true
                ],
                200
            );
        }

        return response()->json(
            [
                "message" => "Role Not Found",
                "success" => false
            ],
            200
        );
    }

    public function update(RoleUpdateRequest $request, $roleId)
    {
        $role = Roles::find($roleId);

        if ($role) {
            $role->update($this->setParams($request));

            return response()->json(
                [
                    "message" => "Role Update Successfully",
                    "success" => true
                ],
                201
            );
        }

        return response()->json(
            [
                "message" => "Role Not Found",
                "success" => false
            ],
            404
        );
    }

    public function destroy(int $roleId)
    {
        $role = Roles::find($roleId);

        if ($role) {
            $role->delete($roleId);

            return response()->json(
                [
                    "message" => "Role Delete Successfully",
                    "success" => true
                ],
                201
            );
        }

        return response()->json(
            [
                "message" => "Role Not Found",
                "success" => false
            ],
            404
        );

    }

    public function restore(int $roleId)
    {
        $role = Roles::onlyTrashed()->find($roleId);

        if ($role) {

            $role->restore();

            return response()->json(
                [
                    "message" => "Role Restore Successfully",
                    "success" => true
                ],
                201
            );
        }

        return response()->json(
            [
                "message" => "Role Not Found",
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
