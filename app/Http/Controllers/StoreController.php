<?php

namespace App\Http\Controllers;

use App\Interfaces\StoreInterface;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    private $store;


    public function __construct(StoreInterface $store)
    {
        $this->store = $store;
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
                    return $data->status ? 'Aktif' : 'Tidak Aktif';
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

    /**
     * Display the specified resource.
     */
    public function show(Store $store)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Store $store)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Store $store)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Store $store)
    {
        //
    }
}
