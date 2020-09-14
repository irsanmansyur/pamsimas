<?php

namespace App\Controllers\Admin;

use App\Models\PelangganModel;
use SuperAdmin\Models\UserModel;

class Pelanggan extends BaseController

{
    private $model;
    public function __construct()
    {
        parent::__construct();
        $this->model = new PelangganModel();
        $this->back = ['url' => route_to("pelanggan"), "name" => '<i data-feather="arrow-left"></i>Pembayaran'];
    }
    public function index()
    {
        $page = (int) ($this->request->getVar('page_users') ?? 1);
        $page = $page < 1 ? 1 : $page;
        $perPage =  2; //offset

        $search = $this->request->getVar('search');
        $pelanggan = $this->model->select("users.*")->join('user_access_role', "user_access_role.user_id=users.id", "right")->where("user_access_role.role_id", 3);
        if ($search)
            $pelanggan->like("users.name", $search);

        $data = [
            "back" => ['url' => route_to("super-admin"), "name" => '<i data-feather="arrow-left"></i>Dashboard'],
            'page_title' => "Daftar Pelanggan Pamsimas",
            'name' => "Pelanggan",
            "pelanggans" => $pelanggan->paginate($perPage, 'users'),
            'pager' => $this->model->pager,
            'currentPage' => $page,
            'perPage' => $perPage,

            // "_adminTemplate" => 'template/admin',
        ];
        return view_pages("Pelanggan/index", $data);
    }
    public function tambah()
    {
        if ($this->request->getMethod() == 'post') {
            return $this->tambah_pelanggan();
        }
        $data = [
            "back" => $this->back,
            'page_title' => "Menambah Pelanggan Pamsimas",
            'name' => "Tambah Pelanggan",
            'pelanggan' => [],
            // "_adminTemplate" => 'template/admin',
        ];
        return view_pages("Pelanggan/tambah", $data);
    }
    private function tambah_pelanggan()
    {
        $data = $this->validatePelanggan();
        if (!$data) {
            return redirect()->back()->withInput()->with("error", "Validasi Gagal")->with('errors', $this->validator->getErrors());
        }
        $this->model->skipValidation();
        if ($this->model->save($data))
            return redirect()->to(route_to('pelanggan'))->with('message', "Sukses Menambahkan Pelanggan baru");
        return redirect()->back()->withInput()->with("error", "Gagal Menambahkan Pelanggan");
    }

    private function validatePelanggan($pelanggan = [])
    {

        $data = [
            'username' => $this->request->getPost("username"),
            'email' => $this->request->getPost("email"),
            "no_meteran" => $this->request->getPost("no_meteran"),
            'name' => $this->request->getPost("name"),
            "address" => $this->request->getPost("address"),
            "handphone" => $this->request->getPost("handphone"),
            "is_active" => $this->request->getPost("is_active"),
            "password" => $this->request->getPost("password"),
        ];

        $dataValidate = [];
        foreach ($data as $key => $val) {
            if (isset($pelanggan[$key])) {
                if ($pelanggan[$key] != $data[$key])
                    $dataValidate[$key] = $val;
            } else
                $dataValidate[$key] = $val;
        }
        $rules = $this->model->getValidationRules(['only' => array_keys($dataValidate)]);
        if ($this->validate($rules))
            return $data;
        return false;
    }
    public function edit($idUser)
    {
        $pelanggan =  $this->model->user($idUser)->first();
        if ($this->request->getMethod() == 'post')
            return $this->editPelanggan($pelanggan);

        $data = [
            "back" => $this->back,
            'page_title' => "Menambah Pelanggan Pamsimas",
            'name' => "Tambah Pelanggan",
            'pelanggan' => $pelanggan,
            // "_adminTemplate" => 'template/admin',
        ];
        return view_pages("Pelanggan/edit", $data);
    }
    private function editPelanggan($pelanggan)
    {
        $dataAwal = [
            'username' => $this->request->getPost("username"),
            'email' => $this->request->getPost("email"),
            "no_meteran" => $this->request->getPost("no_meteran")
        ];
        $data = array_merge($pelanggan, $this->validatePelanggan($pelanggan));
        if (!$data) {
            return redirect()->back()->withInput()->with("error", "Validasi Gagal")->with('errors', $this->validator->getErrors());
        }
        $this->model->skipValidation();
        if ($this->model->save($data))
            return redirect()->to(route_to('pelanggan'))->with('message', "Sukses Edit Pelanggan");
        return redirect()->back()->withInput()->with("error", "Gagal Edit Pelanggan");
    }

    function get_autocomplete()
    {
        if (isset($_GET['term'])) {
            $result = $this->model->searchPelanggan($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'name'         => $row->name,
                        'handphone'   => $row->handphone,
                        'no_meteran'   => $row->no_meteran,
                        'mtr_lama'   => $row->mtr_lama,
                        'mtr_baru'   => $row->mtr_baru,
                        'address'   => $row->address,
                        'id'   => $row->id,

                    );
                echo json_encode($arr_result);
            }
        }
    }
}
