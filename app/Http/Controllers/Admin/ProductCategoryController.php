<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AclResource;
use App\Models\ProductCategory;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductCategoryController extends Controller
{
    public function __construct()
    {
        ensure_user_can_access(AclResource::PRODUCT_CATEGORY_MANAGEMENT);
    }
    
    public function index()
    {
        $items = ProductCategory::with('products')->orderBy('name', 'asc')->get();
        return view('admin.product-category.index', compact('items'));
    }

    public function edit(Request $request, $id = 0)
    {
        $item = $id ? ProductCategory::find($id) : new ProductCategory();
        if (!$item)
            return redirect('admin/product-category')->with('warning', 'Kategori produk tidak ditemukan.');

        if ($request->method() == 'POST') {
            $validator = Validator::make($request->all(), [
                'name' => 'required|unique:product_categories,name,' . $request->id . '|max:100',
            ], [
                'name.required' => 'Nama kategori harus diisi.',
                'name.unique' => 'Nama kategori sudah digunakan.',
                'name.max' => 'Nama kategori terlalu panjang, maksimal 100 karakter.',
            ]);

            if ($validator->fails())
                return redirect()->back()->withInput()->withErrors($validator);

            $data = ['Old Data' => $item->toArray()];
            $item->fill($request->all());
            $item->save();
            $data['New Data'] = $item->toArray();

            UserActivity::log(
                UserActivity::PRODUCT_CATEGORY_MANAGEMENT,
                ($id == 0 ? 'Tambah' : 'Perbarui') . ' Kategori Produk',
                'Kategori Produk ' . e($item->name) . ' telah ' . ($id == 0 ? 'dibuat' : 'diperbarui'),
                $data
            );

            return redirect('admin/product-category')->with('info', 'Kategori produk telah disimpan.');
        }

        return view('admin.product-category.edit', compact('item'));
    }

    public function delete($id)
    {
        // fix me, notif kalo kategori ga bisa dihapus
        if (!$item = ProductCategory::find($id))
            $message = 'Kategori tidak ditemukan.';
        else if ($item->delete($id)) {
            $message = 'Kategori ' . e($item->name) . ' telah dihapus.';
            UserActivity::log(
                UserActivity::PRODUCT_CATEGORY_MANAGEMENT,
                'Hapus Kategori',
                $message,
                $item->toArray()
            );
        }

        return redirect('admin/product-category')->with('info', $message);
    }
}
