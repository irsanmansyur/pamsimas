<?php

namespace App\Controllers\Admin;

use App\Models\TransaksiModel;

class Pembayaran extends BaseController

{
    private $model;
    public function __construct()
    {
        parent::__construct();
        $this->model = new TransaksiModel();
        $this->back = ['url' => route_to("transaksi"), "name" => '<i data-feather="arrow-left"></i>Pembayaran'];
    }
    public function index()
    {
        $data = [
            "back" => ['url' => route_to("super-admin"), "name" => '<i data-feather="arrow-left"></i>Dashboard'],
            'page_title' => "Daftar Transaksi User",
            'name' => "Transaksi",
            // "_adminTemplate" => 'template/admin',
        ];
        return view_pages("Pembayaran/Transaksi", $data);
    }
}
