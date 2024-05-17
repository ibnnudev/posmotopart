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
        $discounts = $userLogin == 'admin' ? $this->discount->getAll() : $this->discount->getDiscountsNotExpired();
        if ($request->wantsJson()) {
            return datatables()
                ->of($discounts)
                ->addColumn('logo', function ($data) {
                    return view('admin.discount.column.logo', [
                        'data' => $data
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
                ->addColumn('is_active', function ($data) {
                    return $data->is_active == 1 ? 'Aktif' : 'Tidak Aktif';
                })
                ->addColumn('condition', function ($data) {
                    return $this->discountStore->discountIsExist($data->id, auth()->user()->store->id) ? 'Sudah Terdaftar' : 'Belum Terdaftar';
                })
                ->addColumn('action', function ($data) {
                    return view('admin.discount.column.action', [
                        'id' => $data->id,
                        'isApplied' => $this->discountStore->discountIsExist($data->id, auth()->user()->store->id),
                    ]);
                })
                ->addIndexColumn()
                ->make(true);
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

    public function show(Discount $discount)
    {
        //
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
