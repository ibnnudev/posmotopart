<?php

namespace App\Repositories;

use App\Interfaces\WalletInetrface;
use App\Models\Wallet;

class WalletRepository implements WalletInetrface
{
    private $wallet;

    public function __construct(Wallet $wallet)
    {
        $this->wallet = $wallet;
    }

    public function getAll()
    {
        return $this->wallet->with('user')->get();
    }

    public function getById($id)
    {
        return $this->wallet->find($id);
    }

    public function store($data, $userId)
    {
        try {
            return $this->wallet->create([
                'balance' => $data['balance'],
                'user_id' => $userId
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update($id, $data)
    {
        $category = $this->wallet->find($id);
        try {
            return $category->update($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy($id)
    {
        try {
            $category = $this->wallet->find($id);
            return $category->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function getByUserId($userId)
    {
        return $this->wallet->with('user')->where('user_id', $userId)->get();
    }
}
