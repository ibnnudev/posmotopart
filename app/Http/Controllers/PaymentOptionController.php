<?php

namespace App\Http\Controllers;

use App\Interfaces\PaymentOptionInterface;
use App\Models\PaymentOption;
use Illuminate\Http\Request;

class PaymentOptionController extends Controller
{
    private $paymentOption;

    public function __construct(PaymentOptionInterface $paymentOption)
    {
        $this->paymentOption = $paymentOption;
    }
    public function index(Request $request)
    {
        $paymentOptions = $this->paymentOption->getAll();
        if ($request->wantsJson()) {
            return datatables()
                ->of($paymentOptions)
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('description', function ($data) {
                    return $data->description;
                })
                ->addColumn('status', function ($data) {
                    return $data->status;
                })
                ->addColumn('admin_fee', function ($data) {
                    return $data->admin_fee;
                })
                ->addColumn('duration', function ($data) {
                    return $data->duration;
                })
                ->addColumn('action', function ($data) {
                    return view('admin.payment_option.column.action', [
                        'id' => $data->id
                    ]);
                })
                ->addIndexColumn()
                ->make(true);
        }
        return view('admin.payment_option.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('admin.payment_option.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string|max:255',
            'status' => 'required|in:1,0',
            'admin_fee' => 'required|numeric',
            'duration' => 'required|numeric',
        ]);

        try {
            $this->paymentOption->store($request->accepts('_token'));
            toast('Payment option created successfully', 'success');
            return redirect()->route('admin.payment-option.index');
        } catch (\Throwable $th) {
            toast($th->getMessage(), 'error');
            return redirect()->route('admin.payment-option.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentOption $paymentOption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $data = $this->paymentOption->getById($id);
        return view('admin.payment_option.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'string|max:255',
            'status' => 'required|in:1,0',
            'admin_fee' => 'required|numeric',
            'duration' => 'required|numeric',
        ]);

        try {
            $this->paymentOption->update($id, $request->request->all());
            toast('Payment option updated successfully', 'success');
            return redirect()->route('admin.payment-option.index');
        } catch (\Throwable $th) {
            toast($th->getMessage(), 'error');
            return redirect()->route('admin.payment-option.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentOption $paymentOption)
    {
    }
}
