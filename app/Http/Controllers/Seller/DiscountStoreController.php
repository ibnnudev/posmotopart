<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use App\Models\DiscountStore;
use App\Http\Requests\StoreDiscountStoreRequest;
use App\Http\Requests\UpdateDiscountStoreRequest;
use App\Interfaces\DiscountStoreInterface;
use App\Interfaces\StoreInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DiscountStoreController extends Controller
{
    private $discountStore;
    public function __construct(DiscountStoreInterface $discountStore)
    {
        $this->discountStore = $discountStore;
    }
    public function index()
    {
        $discountStores = $this->discountStore->getAll();
        dd($discountStores);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($discountId)
    {
        if ($this->discountStore->discountIsExist($discountId, Auth::user()->store->id)) {
            toast('Diskon sudah diikuti', 'error');
            return redirect()->route('admin.discount.index');
        }

        try {
            $this->discountStore->store((int) $discountId, Auth::user()->store->id);
            toast('Diskon ditambahkan', 'success');
            return redirect()->route('admin.discount.index');
        } catch (\Throwable $th) {
            toast($th->getMessage(), 'error');
            return redirect()->route('admin.discount.index');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(DiscountStore $discountStore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DiscountStore $discountStore)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDiscountStoreRequest $request, DiscountStore $discountStore)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($discountId)
    {
        $discountStoreId = $this->discountStore->getByDiscountAndStore($discountId, Auth::user()->store->id)->id;
        try {
            $this->discountStore->destroy($discountStoreId);
            toast('Diskon dihapus', 'success');
            return redirect()->route('admin.discount.index');
        } catch (\Throwable $th) {
            toast($th->getMessage(), 'error');
            return redirect()->route('admin.discount.index');
        }
    }
}
