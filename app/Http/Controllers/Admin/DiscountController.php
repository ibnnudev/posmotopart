<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\DiscountInterface;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    private $discount;
    public function __construct(DiscountInterface $discount)
    {
        $this->discount = $discount;
    }
    public function index(Request $request)
    {
        $discounts = $this->discount->getAll();
        if ($request->wantsJson()) {
            return datatables()
                ->of($discounts)
                ->addColumn('logo', function ($data) {
                    return $data->logo;
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
                    return $data->start_date;
                })
                ->addColumn('end_date', function ($data) {
                    return $data->end_date;
                })
                ->addColumn('is_active', function ($data) {
                    return $data->is_active;
                })
                ->addColumn('type', function ($data) {
                    return $data->type;
                })
                ->addColumn('action', function ($data) {
                    return view('admin.discount.column.action', [
                        'id' => $data->id
                    ]);
                })
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.discount.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.discount.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:discounts,code',
            'discount' => 'required|decimal:0,2|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'is_active' => 'required|in:1,0',
            'type' => 'required|in:1,2',
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

    /**
     * Display the specified resource.
     */
    public function show(Discount $discount)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = $this->discount->getById($id);
        return view('admin.discount.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255|unique:discounts,code',
            'discount' => 'required|decimal:0,2|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'is_active' => 'required|in:1,0',
            'type' => 'required|in:1,2',
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

    /**
     * Remove the specified resource from storage.
     */
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
