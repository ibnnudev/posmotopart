<?php

namespace App\Http\Controllers;

use App\Interfaces\CategoryInterface;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $category;

    public function __construct(CategoryInterface $category)
    {
        $this->category = $category;
    }

    public function index(Request $request)
    {
        $categories = $this->category->getAll();
        if ($request->wantsJson()) {
            return datatables()
                ->of($categories)
                ->addColumn('logo', function ($data) {
                    return view('admin.category.column.logo', [
                        'logo' => $data->logo
                    ]);
                })
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('action', function ($data) {
                    return view('admin.category.column.action', [
                        'id' => $data->id
                    ]);
                })
                ->addIndexColumn()
                ->make(true);
        }

        return view('admin.category.index');
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
        ]);

        try {
            $this->category->store($request->except('_token'));
            toast('Data berhasil ditambahkan', 'success');
            return redirect()->route('admin.category.index');
        } catch (\Throwable $th) {
            toast($th->getMessage(), 'error');
            return redirect()->route('admin.category.index');
        }
    }

    public function show(Category $category)
    {
        //
    }

    public function edit($id)
    {
        $data = $this->category->getById($id);
        return view('admin.category.edit', compact('data'));
    }

    public function update($id, Request $request)
    {
        $request->validate([
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|string|max:255',
        ]);

        try {
            $this->category->update($id, $request->all());
            toast('Data berhasil diupdate', 'success');
            return redirect()->route('admin.category.index');
        } catch (\Throwable $th) {
            toast($th->getMessage(), 'error');
            return redirect()->route('admin.category.index');
        }
    }

    public function destroy($id)
    {
        try {
            $this->category->destroy($id);
            return response()->json(true);
        } catch (\Throwable $th) {
            return response()->json(false);
        }
    }
}
