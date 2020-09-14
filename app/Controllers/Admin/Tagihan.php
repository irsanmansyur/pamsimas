<?php

namespace App\Controllers\Admin;

use App\Models\TagihanModel;

class Tagihan extends BaseController

{
    private $model;
    public function __construct()
    {
        parent::__construct();
        $this->model = new TagihanModel();
        $this->back = ['url' => route_to("tagihan"), "name" => '<i data-feather="arrow-left"></i>Tagihan'];
    }
    public function index()
    {
        $page = (int) ($this->request->getVar('page_users') ?? 1);
        $page = $page < 1 ? 1 : $page;
        $perPage =  2; //offset

        $tagihans = $this->model->getTagihan();
        $data = [
            "back" => ['url' => route_to("super-admin"), "name" => '<i data-feather="arrow-left"></i>Dashboard'],
            'page_title' => "Daftar Semua Tagihan",
            'name' => "Semua Tagihan",
            'tagihans' => $tagihans->paginate($perPage, 'users'),
            'pager' => $this->model->pager,
            'currentPage' => $page,
            'perPage' => $perPage,
        ];
        return view_pages("Tagihan/index", $data);
    }
    public function bayar()
    {
        $data = [
            "back" => ['url' => route_to("super-admin"), "name" => '<i data-feather="arrow-left"></i>Dashboard'],
            'page_title' => "Membayar Tagihan Untuk Pelanggan",
            'name' => "Bayar Tagihan",
            'pelanggan' => [],
        ];
        return view_pages("Tagihan/bayar", $data);
    }
    public function tambah()
    {
        if ($this->request->getMethod() == 'post')
            return $this->tambah_tagihan();
        $data = [
            "back" => ['url' => route_to("super-admin"), "name" => '<i data-feather="arrow-left"></i>Dashboard'],
            'page_title' => "Menambah Tagihan Untuk Pelanggan",
            'name' => "Tambah Tagihan",
            'pelanggan' => ["bulan_tahun" => date("Y-m-d")],
        ];
        return view_pages("Tagihan/tambah", $data);
    }
    public function tambah_tagihan()
    {

        $data = [
            'user_id' => $this->request->getPost("id"),
            "untuk_bulan_tahun" => $this->request->getPost("bulan_tahun"),
            "mtr_baru" => $this->request->getPost("mtr_baru"),
            "mtr_lama" => $this->request->getPost("mtr_lama"),
            "volume" => $this->request->getPost("volume_air"),
        ];
        if ($this->model->save($data))
            return redirect()->to(route_to('tagihan'))->with('message', "Sukses Menambahkan tagihan baru");
        return redirect()->back()->with('errors', $this->model->errors());
    }
}
