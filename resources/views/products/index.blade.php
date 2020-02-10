@extends('layouts.master')
​
@section('title')
    <title>Manajemen Produk</title>
@endsection
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Manajemen Produk</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Produk</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
​
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @card
                            @slot('title')
                            <a href="{{ route('produk.create') }}" 
                                class="btn btn-primary btn-sm">
                                <i class="fa fa-edit"></i> Tambah
                            </a>
                            @endslot
                            
                            @if (session('success'))
                                @alert(['type' => 'success'])
                                    {!! session('success') !!}
                                @endalert
                            @endif
                            
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                        <th>NO</th>
                                        <th>Barcode</th>
                                        <th>nama</th>
                                        <th>stok</th>
                                        <th>harga beli</th>
                                        <th>harga jual</th>
                                        <th>diskon</th>
                                        <th>keterangan</th>
                                        <th>Aksi</th>>
                                        </tr>
                                    </thead>
                                    <tbody>

                                @foreach($products as $s)
                                        <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $s->barcode }}</td>
                                        <td>{{ $s->nama }}</td>
                                        <td>{{ $s->stok }}</td>
                                        <td>{{ $s->harga_beli }}</td>
                                        <td>{{ $s->harga_jual }}</td>
                                        <td>{{ $s->diskon}}</td> 
                                        <td>{{ $s->keterangan }}</td>
                                            <td>
                                            <a href="/products/detail/{{$s->barcode}}" class="btn btn-sm btn-warning"><i class="far fa-edit"></i></a>
                                            <a href="/products/delete/{{$s->id}}" class="btn btn-sm btn-danger hapus"><i class="far fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                @endforeach                                        
                                    </tbody>
                                </table>
                            </div>
                            @slot('footer')
​
                            @endslot
                        @endcard
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection