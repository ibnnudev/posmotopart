<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\PermissionInterface;
use App\Interfaces\RoleInterface;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private $role;

    private $permission;

    public function __construct(RoleInterface $role, PermissionInterface $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->role->get())
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('action', function ($data) {
                    return view('admin.role.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.role.index');
    }

    public function create()
    {
        $permissions = $this->permission->get();

        return view('admin.role.create', compact('permissions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
            'permissions' => 'required|array',
        ]);

        try {
            $this->role->store($request->all());

            return redirect()->route('admin.role.index')->with('success', 'Hak akses berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        return view('admin.role.edit', [
            'role' => $this->role->getById($id),
            'permissions' => $this->permission->get(),
        ]);
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name,' . $id,
            'permissions' => 'required|array',
        ]);

        try {
            $this->role->update($id, $request->all());

            return redirect()->route('admin.role.index')->with('success', 'Hak akses berhasil diperbarui');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->role->delete($id);

            return response()->json(['status' => true, 'message' => 'Hak akses berhasil dihapus']);
        } catch (\Exception $e) {
            return response()->json(['status' => false, 'message' => $e->getMessage()]);
        }
    }

    public function getWhich($place)
    {
        try {
            return $this->role->getWhich($place);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
