<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\StoreInterface;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    private $store;
    private $user;

    public function __construct(StoreInterface $store, User $user)
    {
        $this->store = $store;
        $this->user = $user;
    }


    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return datatables()
                ->of($this->store->getAll())
                ->addColumn('name', function ($data) {
                    return view('admin.store.partials.name', compact('data'));
                })
                ->addColumn('phone', function ($data) {
                    return $data->phone;
                })
                ->addColumn('status', function ($data) {
                    return view('admin.store.partials.status', compact('data'));
                })
                ->addColumn('action', function ($data) {
                    return view('admin.store.partials.action', ['id' => $data->id]);
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.store.index');
    }

    public function create()
    {
        return view('admin.store.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'store_name' => 'required',
            'email' => 'required|unique:users,email',
            'phone' => 'required',
            'address' => 'required',
            'logo' => 'nullable',
        ]);

        try {
            $this->store->store($request->all());
            toast('Data berhasil disimpan', 'success');
            return redirect()->route('admin.store.index');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            toast($th->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function show(Store $store)
    {
        //
    }

    public function edit($id)
    {
        $data = $this->store->getById($id);
        return view('admin.store.edit', compact('data'));
    }

    public function update($id, Request $request)
    {
        $user = $this->store->getById($id)['user'];
        $request->validate([
            'name' => 'required',
            'store_name' => 'required',
            'email' => ['required', 'email', 'unique:users,email,' . $user['id']],
            'phone' => 'required',
            'address' => 'required',
            'logo' => 'nullable',
        ]);

        try {
            $this->store->update($id, $request->all());
            toast('Data berhasil diubah', 'success');
            return redirect()->route('admin.store.index');
        } catch (\Throwable $th) {
            toast($th->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        try {
            $this->store->destroy($id);
            toast('Data berhasil dihapus', 'success');
            return redirect()->route('admin.store.index');
        } catch (\Throwable $th) {
            toast($th->getMessage(), 'error');
            return redirect()->back();
        }
    }

    public function updateStatus($id, Request $request)
    {
        try {
            $this->store->updateStatus($id, $request->status);
            return response()->json([
                'status' => true,
                'message' => 'Data berhasil diubah'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ]);
        }
    }
}
