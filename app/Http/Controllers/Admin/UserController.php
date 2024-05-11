<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\PermissionInterface;
use App\Interfaces\RoleInterface;
use App\Interfaces\UserInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userManagement;
    private $permission;
    private $role;

    public function __construct(UserInterface $userManagement, PermissionInterface $permission, RoleInterface $role)
    {
        $this->userManagement = $userManagement;
        $this->permission = $permission;
        $this->role = $role;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()
                ->of($this->userManagement->getAll())
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('email', function ($data) {
                    return $data->email;
                })
                ->addColumn('phone', function ($data) {
                    return $data->phone;
                })
                ->addColumn('role', function ($data) {
                    return ucwords(str_replace('_', ' ', $data->getRoleNames()->first()));
                })
                ->addColumn('join_date', function ($data) {
                    return Carbon::parse($data->created_at)->locale('id')->isoFormat('LL');
                })
                ->addColumn('action', function ($data) {
                    return view('admin.user.column.action', compact('data'));
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.user.index');
    }

    public function getById($id)
    {
        return response()->json($this->userManagement->getById($id));
    }

    public function create()
    {
        $roles = $this->role->get();

        return view('admin.user.create', [
            'roles' => $roles,
        ]);
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'role' => 'required',
            'phone_number' => 'required',
        ]);

        try {
            $this->userManagement->store($request->all());

            return redirect()->route('admin.user.index')->with('success', 'Pengguna berhasil ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->route('admin.user.index')->with('error', $th->getMessage());
        }
    }

    public function edit($id)
    {
        $user = $this->userManagement->getById($id);
        $role = $user->roles()->pluck('name');

        return view('admin.user.edit', [
            'data' => $user,
            'roles' => $this->role->get(),
            'this_role' => $this->role->getByName($role)
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required',
            'phone_number' => 'required',
            'branch_id' => 'nullable|exists:branches,id',
            'join_date' => 'required',
        ]);

        try {
            $this->userManagement->update($id, $request->all());

            return redirect()->route('admin.user.index')->with('success', 'Pengguna berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect()->route('admin.user.index')->with('error', $th->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->userManagement->destroy($id);

            return response()->json(['status' => true, 'message' => 'Pengguna berhasil dihapus']);
        } catch (\Throwable $th) {
            return response()->json(['status' => false, 'message' => $th->getMessage()]);
        }
    }

    public function updatePermission(Request $request, $id)
    {
        $request->validate([
            'permission' => 'required|array',
        ]);
        try {
            $this->userManagement->updatePermission($id, $request->permission);

            return redirect()->route('admin.user.index')->with('success', 'Hak akses pengguna berhasil diperbarui');
        } catch (\Throwable $th) {
            return redirect()->route('admin.user.index')->with('error', $th->getMessage());
        }
    }
}
