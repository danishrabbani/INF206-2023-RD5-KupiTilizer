<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules;
use \Carbon\Carbon;
use Illuminate\View\View;


class ProductController extends Controller
{
    /**
     * Display manage product 
     * 
     * @return \Illuminate\View\View 
     */
    public function index(): View
    {
        $products = Product::all();
        return view('adminproduct',['products'=>$products]);
    }

    public function addProduct(Request $request): RedirectResponse
    {
        $date = Carbon::now();
        $request->validate([
            'nama_product'=> ['required', 'string'],
            'harga' => ['required', 'integer'],
            'deskripsi' => ['nullable', 'string'],
            //'foto_product' => ['image', 'nullable']
        ]);

        $product = Product::create([
            'id' => (string)$date->format('ymd').bin2hex(random_bytes(2)),
            'nama_product' => $request->nama_product,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
            //'foto_product' => $request->foto_product,
        ]);
        return redirect()->back()->with('success', 'Product berhasil ditambahkan');
    } 

    public function destroy($id): RedirectResponse
    {
        //menghapus product dari database 
        DB::table('products')->where('id', $id)->delete();
        
        ///kembali ke laman manage user dengan alert succes
        return redirect()->back()->with('success', 'Product berhasil dihapus');
        
    }
}
