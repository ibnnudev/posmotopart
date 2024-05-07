<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\PermissionInterface;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    private $permission;

    public function __construct(PermissionInterface $permission)
    {
        $this->permission = $permission;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->permission->get())
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('action', function ($data) {
                    return view('admin.permission.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.permission.index');
    }

    public function show($id)
    {
        return $this->permission->getById($id);
    }

    public function create()
    {
        return view('admin.permission.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name',
        ]);
        try {
            $this->permission->store($request->all());

            return redirect()->route('admin.permission.index')->with('success', 'Permission berhasil dibuat');
        } catch (\Throwable $th) {
            return redirect()->route('admin.permission.index')->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $data = $this->permission->getById($id);

        return view('admin.permission.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:permissions,name,' . $id,
        ]);

        try {
            $this->permission->update($id, $request->all());

            return redirect()->route('admin.permission.index')->with('success', 'Permission berhasil diubah');
        } catch (\Throwable $th) {
            return redirect()->route('admin.permission.index')->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->permission->delete($id);
            return response()->json(['status' => true, 'message' => 'Permission berhasil dihapus']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }
}
