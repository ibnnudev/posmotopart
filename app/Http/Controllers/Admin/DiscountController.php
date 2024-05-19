<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\DiscountInterface;
use App\Interfaces\DiscountStoreInterface;
use App\Models\Discount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscountController extends Controller
{
    private $discount;
    private $discountStore;
    public function __construct(DiscountInterface $discount,  DiscountStoreInterface $discountStore)
    {
        $this->discount = $discount;
        $this->discountStore = $discountStore;
    }
    public function index(Request $request)
    {
        $userLogin = Auth::user()->roles->pluck('name')->toArray()[0];
        $discounts =  $this->discount->getAll();
        if ($request->wantsJson()) {
            $dataTable = datatables()
                ->of($discounts)
                ->addColumn('logo', function ($data) {
                    return view('admin.discount.column.logo', [
                        'logo' => $data->logo ? 'storage/discount/' . $data->logo : null
                    ]);
                })
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('code', function ($data) {
                    return $data->code;
                })
                ->addColumn('discount', function ($data) {
                    return $data->discount . ' %';
                })
                ->addColumn('start_date', function ($data) {
                    return date('d/m/Y', strtotime($data->start_date));
                })
                ->addColumn('end_date', function ($data) {
                    return date('d/m/Y', strtotime($data->end_date));
                })

                ->addColumn('action', function ($data) {
                    $isAppalied = Auth::user()->hasRole('seller') ? $this->discountStore->discountIsExist($data->id, auth()->user()->store->id) : false;
                    return view('admin.discount.column.action', [
                        'data'      => $data,
                        'isApplied' => $isAppalied
                    ]);
                })
                ->addIndexColumn();

            if ($userLogin == 'seller') {
                $dataTable->addColumn('condition', function ($data) {
                    return $this->discountStore->discountIsExist($data->id, auth()->user()->store->id) ? 'Sudah Terdaftar' : 'Belum Terdaftar';
                });
            }
            return $dataTable->make(true);
        }
        return view('admin.discount.index');
    }

    public function create()
    {
        return view('admin.discount.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'logo'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name'       => 'required|string|max:255',
            'code'       => 'required|string|max:255|unique:discounts,code',
            'discount'   => 'required|decimal:0,2|max:100',
            'start_date' => 'required|date',
            'end_date'   => 'required|date',
            'is_active'  => 'required|in:1,0',
            // 'type'       => 'nullable|in:1,2',
        ]);

        try {
            $this->discount->store($request->except('_token'));
            toast('Payment option created successfully', 'success');
            return redirect()->route('admin.discount.index');
        } catch (\Throwable $th) {
            toast($th->getMessage(), 'error');
            return redirect()->route('admin.discount.index');
        }
    }

    public function show($id, Request $request)
    {
        $discountStores = $this->discountStore->getByDiscountId($id);
        $discount = $this->discount->getById($id);

        if ($request->wantsJson()) {
            return datatables()
                ->of($discountStores)
                ->addColumn('logo', function ($data) {
                    return view('admin.discount.column.logo', [
                        'logo' => $data->store->logo ? 'storage/store/' . $data->store->logo : null
                    ]);
                })
                ->addColumn('name', function ($data) {
                    return $data->store->name;
                })
                ->addColumn('owner', function ($data) {
                    return $data->store->user->name;
                })
                ->addColumn('address', function ($data) {
                    return $data->store->address;
                })
                ->addColumn('phone', function ($data) {
                    return $data->store->phone;
                })
                ->addColumn('status', function ($data) {
                    return $data->store->status == 1 ? 'Aktif' : 'Tidak Aktif';
                })
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.discount.show', compact('discount'));
    }

    public function edit($id)
    {
        $data = $this->discount->getById($id);
        return view('admin.discount.edit', compact('data'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'logo'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name'       => 'required|string|max:255',
            'code'       => 'required|string|max:255|unique:discounts,code,' . $id,
            'discount'   => 'required|decimal:0,2|max:100',
            'start_date' => 'required|date',
            'end_date'   => 'required|date',
            'is_active'  => 'required|in:1,0',
            // 'type'       => 'nullable|in:1,2',
        ]);

        try {
            $this->discount->update($id, $request->request->all());
            toast('Discount updated successfully', 'success');
            return redirect()->route('admin.discount.index');
        } catch (\Throwable $th) {
            toast($th->getMessage(), 'error');
            return redirect()->route('admin.discount.index');
        }
    }

    public function destroy($id)
    {
        try {
            $this->discount->destroy($id);
            return response()->json(true);
        } catch (\Throwable $th) {
            return response()->json(false);
        }
    }
}
