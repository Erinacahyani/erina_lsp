<?php

namespace App\Http\Controllers;
use App\Category;
use App\Product;
use File;
use Image;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
    	$d['products'] = Product::all();
    	return view("products.index", $d);
    }

    public function tambah()
    {
        $categories = Category::all();
        $unit = Unit::all();
        $laba = Laba::all();
        $stok_minimum = Stok_Ppn::all();
        return view('products.add', compact('categories', 'unit', 'laba', 'stok_minimum'));
    }

    public function add(Request $r){
    	$d = new Product;
    	$d->kategori_id = $r->input("kategori_id");
    	$d->unit_id = $r->input("unit_id");
    	$d->mata_uang_id = $r->input("mata_uang_id");
    	$d->barcode = rand(1000,10000000000);
    	$d->nama = $r->input("nama");
        $d->harga_beli = $r->input("harga_beli");
        $d->harga_jual = $r->input("harga_jual");
    	$d->stok = $r->input("stok");
    	$d->keterangan = $r->input("keterangan");
    	$d->diskon = $r->input("diskon");
        $d->laba = $r->input("laba");
        $d->ppn = $r->input("ppn");



        if($r->diskon != null){
            $diskon = $r->harga_beli * $r->diskon / '100';
            $minus = $r->harga_beli - $diskon;
            $persen = $minus * ($r->laba + $r->ppn) / '100';
            $d->harga_jual = $minus + $persen;
        }else{
        $persen = $r->harga_beli * ($r->laba + $r->ppn) / '100';
        $d->harga_jual = $r->harga_beli + $persen;
        }

    	$d->save();
        return redirect('/barang');
    }

    public function detail($barcode) {
        $kategori = Kategori::all();
        $matauang = Mata_Uang::all();
        $unit = Unit::all();
        $laba = Laba::all();
        $ppnstok = Stok_Ppn::all();
        $product = Products::where('barcode', $barcode)->first();
        return view('admin.barang.edit', compact('produk', 'kategori', 'matauang', 'unit', 'laba', 'ppnstok'));
    }

    public function proses_detail(Request $r) {
        $product = Products::where('barcode', $r->barcode)->first();
        $product->nama = $r->nama;
        $product->stok = $r->stok;
        $product->kategori_id = $r->kategori_id;
        $product->mata_uang_id = $r->mata_uang_id;
        $product->unit_id = $r->unit_id;
        $product->harga_beli = $r->harga_beli;
        $product->keterangan = $r->keterangan;
        $product->diskon = $r->diskon;
        $product->laba = $r->laba;
        $product->ppn = $r->ppn;

        if($r->diskon != null){
            $diskon = $r->harga_beli * $r->diskon / '100';
            $minus = $r->harga_beli - $diskon;
            $persen = $minus * ($r->laba + $r->ppn) / '100';
            $product->harga_jual = $minus + $persen;
        }else{
        $persen = $r->harga_beli * ($r->laba + $r->ppn) / '100';
        $product->harga_jual = $r->harga_beli + $persen;
        }
        $product->save();
        return redirect(url('/barang'));
    }

    public function delete($id)
    {
        $product = Products::find($id);
        $barang->delete();
        return redirect(url('/barang'));
    }

    public function store(Request $request)
{
    //validasi data
    $this->validate($request, [
        'code' => 'required|string|max:10|unique:products',
        'name' => 'required|string|max:100',
        'description' => 'nullable|string|max:100',
        'stock' => 'required|integer',
        'price' => 'required|integer',
        'category_id' => 'required|exists:categories,id',
        'photo' => 'nullable|image|mimes:jpg,png,jpeg'
    ]);
​
    try {
        //default $photo = null
        $photo = null;
        //jika terdapat file (Foto / Gambar) yang dikirim
        if ($request->hasFile('photo')) {
            //maka menjalankan method saveFile()
            $photo = $this->saveFile($request->name, $request->file('photo'));
        }

 
        //Simpan data ke dalam table products
        $product = Products::create([
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
            'stock' => $request->stock,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'photo' => $photo
        ]);
        
        //jika berhasil direct ke produk.index
        return redirect(route('products.index'))
            ->with(['success' => '<strong>' . $product->name . '</strong> Ditambahkan']);
    } catch (\Exception $e) {
        //jika gagal, kembali ke halaman sebelumnya kemudian tampilkan error
        return redirect()->back()
            ->with(['error' => $e->getMessage()]);
    }

    private function saveFile($name, $photo)
{
    //set nama file adalah gabungan antara nama produk dan time(). Ekstensi gambar tetap dipertahankan
    $images = str_slug($name) . time() . '.' . $photo->getClientOriginalExtension();
    //set path untuk menyimpan gambar
    $path = public_path('uploads/product');
​
    //cek jika uploads/product bukan direktori / folder
    if (!File::isDirectory($path)) {
        //maka folder tersebut dibuat
        File::makeDirectory($path, 0777, true, true);
    } 
    //simpan gambar yang diuplaod ke folrder uploads/produk
    Image::make($photo)->save($path . '/' . $images);
    //mengembalikan nama file yang ditampung divariable $images
    return $images;
}
}
}
