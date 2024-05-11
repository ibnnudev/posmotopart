<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\StoreInterface;
use App\Models\User;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    private $user;
    private $store;

    public function __construct(StoreInterface $store)
    {
        $this->user = new User();
        $this->store = $store;
    }

    public function profile()
    {
        return view('admin.profile.index', [
            'user' => auth()->user(),
            'store' => auth()->user()->store
        ]);
    }

    public function updateProfile(Request $request)
    {
        try {
            $this->user->find(auth()->user()->id)->update($request->all());
            toast('Profil berhasil diupdate', 'success');
            return redirect()->route('admin.profile.index');
        } catch (\Throwable $th) {
            dd($th->getMessage());
            toast('Profil gagal diupdate', 'error');
            return redirect()->route('admin.profile.index');
        }
    }

    public function updateStore(Request $request)
    {
        try {
            $this->store->updateStoreOnly(auth()->user()->store->id, $request->all());
            toast('Toko berhasil diupdate', 'success');
            return redirect()->route('admin.profile.index');
        } catch (\Throwable $th) {
            toast('Toko gagal diupdate', 'error');
            return redirect()->route('admin.profile.index');
        }
    }

    public function updateBank(Request $request)
    {
        $request->validate([
            'card_number' => 'required|numeric',
            'bank_name' => 'required|string',
            'owner_name' => 'required|string'
        ]);

        try {
            $this->store->updateBank(auth()->user()->store->id, $request->all());
            toast('Bank berhasil diupdate', 'success');
            return redirect()->route('admin.profile.index');
        } catch (\Throwable $th) {
            toast($th->getMessage(), 'error');
            return redirect()->route('admin.profile.index');
        }
    }
}
