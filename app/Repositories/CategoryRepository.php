<?php

namespace App\Repositories;

use App\Interfaces\CategoryInterface;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryRepository implements CategoryInterface
{
    private $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function getAll()
    {
        return $this->category->all();
    }

    public function getById($id)
    {
        return $this->category->find($id);
    }

    public function store($data)
    {
        if (isset($data['logo'])) {
            $filename = uniqid() . '_' . $data['logo']->getClientOriginalName();
            $data['logo']->storeAs('public/categories', $filename);
            $data['logo'] = $filename;
        }

        try {
            return $this->category->create($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update($id, $data)
    {
        $category = $this->category->find($id);

        if (isset($data['logo'])) {
            if ($category->logo != null) {
                Storage::delete('public/categories/' . $category->logo);
            }
            $filename = uniqid() . '_' . $data['logo']->getClientOriginalName();
            $data['logo']->storeAs('public/categories', $filename);
            $data['logo'] = $filename;
        }

        try {
            return $category->update($data);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy($id)
    {
        $category = $this->category->find($id);

        if ($category->logo != null) {
            Storage::delete('public/categories/' . $category->logo);
        }

        try {
            return $category->delete();
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
