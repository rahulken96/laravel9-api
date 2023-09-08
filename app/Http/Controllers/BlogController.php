<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $blogs = !empty(Blog::get()) ? Blog::latest()->paginate(10) : request(); /* Paginate digunanakan untuk menampilkan dengan bentuk page halaman dengan jumlah per halaman yang ditentukan */

        /* Fungsi Disini adalah untuk mengambil semua data ketika menggunakan api dengan melihat semua data */
        $blogs = !empty(Blog::get()) ? Blog::select('title','body')->get() : request();
        return $data = [
            "status" => 1,
            "data" => $blogs
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* Validasi Inputan yang disetorkan saat melakukan create data pada API */
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        /* Memasukkan Data yang telah lolos validasi diatas dan menyimpannya ke dalam database di dalam tabel Blog */
        $blog = Blog::create($request->all());
        return [
            "status" => 1,
            "data" => $blog,
            "msg" => "Blog Berhasil Ditambahkan!" /* Pesan yang tersampaikan ketika create data berhasil dilakukan */
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        /* Menampilkan data berdasarkan id dari blog yang dikirimkan ketika menampilkan data berdasarkan id dari API */
        return [
            "status" => 1,
            "data" =>$blog
        ];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        /* Validasi Inputan yang disetorkan saat melakukan update data berdasarkan Id blog pada API */
        $request->validate([
            'title' => 'required',
            'body' => 'required',
        ]);

        /* Memasukkan Data yang telah lolos validasi diatas dan mengubah data berdasarkan Id blog yang dikirimkan ke dalam database di dalam tabel Blog */
        $blog->update($request->all());
        return [
            "status" => 1,
            "data" => $blog,
            "msg" => "Blog Berhasil Diubah!" /* Pesan ketika data yang dicari berhasil terubah  */
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        /* Menghapus data dari tabel blog berdasarkan Id */
        $blog->delete();
        return [
            "status" => 1,
            "data" => $blog,
            "msg" => "Blog Berhasil Dihapus!" /* Pesan ketika data yang dicari berhasil terhapus */
        ];
    }
}
