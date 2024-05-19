<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Interfaces\WalletInetrface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    private $wallet;

    public function __construct(WalletInetrface $wallet)
    {
        $this->wallet = $wallet;
    }

    public function index(Request $request)
    {
        $wallets = Auth::user()->hasRole('admin') ? $this->wallet->getAll() :  $this->wallet->getByUserId(Auth::user()->id);
        if ($request->wantsJson()) {
            return datatables()
                ->of($wallets)
                ->addColumn('name', function ($data) {
                    return $data->user->name;
                })
                ->addColumn('status', function ($data) {
                    switch ($data->status) {
                        case 0:
                            $data->status = 'Waiting';
                            break;
                        case 1:
                            $data->status = 'Approved';
                            break;
                        case 2:
                            $data->status = 'Rejected';
                            break;
                        default:
                            $data->status = 'Waiting';
                            break;
                    }
                    return $data->status;
                })
                ->addColumn('created_at', function ($data) {
                    return $data->created_at;
                })
                ->addColumn('balance', function ($data) {
                    return $data->balance;
                })
                ->addColumn('action', function ($data) {
                    return view('admin.wallet.column.action', [
                        'id' => $data->id,
                        'status' => $data->status
                    ]);
                })
                ->addIndexColumn()
                ->make(true);
        }
        if (Auth::user()->hasRole('admin')) {
            return view('admin.wallet.index', compact('wallets'));
        } else {
            return view('guest.wallet.index', [
                'wallets' => $wallets,
                'totalBalance' => $wallets->where('status', 1)->sum('balance'),
            ]);
        }
    }

    public function edit($id)
    {
        $wallet = $this->wallet->getById($id);
        return view('admin.wallet.edit', compact('wallet'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'balance' => 'required|numeric',
            'status' => 'required|numeric',
        ]);
        if ($request->status == 0) {
            toast('You can not update status to waiting again', 'error');
            return redirect()->route('admin.wallet.index');
        }
        try {
            $this->wallet->update($id, $request->request->all());
            toast('Wallet updated successfully', 'success');
            return redirect()->route('admin.wallet.index');
        } catch (\Throwable $th) {
            toast($th->getMessage(), 'error');
            return redirect()->route('admin.wallet.index');
        }
    }

    public function create()
    {
        return view('guest.wallet.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'balance' => 'required|numeric',
        ]);
        try {
            $this->wallet->store($request->except('_token'), Auth::user()->id);
            toast('Top Up berhasil diajukan!', 'success');
            return redirect()->route('admin.wallet.index');
        } catch (\Throwable $th) {
            throw $th;
            toast($th->getMessage(), 'error');
            return redirect()->route('admin.wallet.index');
        }
    }
}
