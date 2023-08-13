<?php

namespace App\Http\Controllers;

use App\Http\Requests\Role\StoreRoleRequest;
use App\Http\Requests\Role\UpdateRoleRequest;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $semua_role = Role::where('name', 'LIKE', '%' . $request->get('find') . '%')
            ->paginate(10);

        return view('pages.master-data.role.index', [
            'semua_role' => $semua_role
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRoleRequest $request)
    {
        $data = $request->validated();

        $role = Role::make($data);
        $role->saveOrFail();

        return redirect()->route('master-data.role.index')->with(['success' => 'Berhasil menambahkan role baru!']);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        $data = $request->validated();

        $role->fill($data);
        $role->saveOrFail();

        return redirect()->route('master-data.role.index')->with(['success' => 'Berhasil update data role!']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        $role->delete();

        return redirect()->route('master-data.role.index')->with(['success' => 'Berhasil menghapus role!']);
    }
}
