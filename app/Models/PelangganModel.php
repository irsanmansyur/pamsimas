<?php

namespace App\Models;

use CodeIgniter\Model;

class PelangganModel extends Model
{
    protected $table = 'users';
    private $roleId = 3;

    protected $returnType = 'array';
    protected $dateFormat = "datetime";
    protected $allowedFields = [
        'username', 'name', 'email', "password", 'updated_at', "activation_code", "ip_address", 'is_active', 'address', 'handphone', 'image_profile', "token", 'no_meteran'
    ];
    protected $validationRules    = [
        'username'     => 'required|min_length[3]|is_unique[users.username]',
        'no_meteran'     => 'required|is_unique[users.no_meteran,username,{username}]',
        'name'     => 'required|min_length[3]',
        'email'        => 'required|valid_email|is_unique[users.email,username,{username}]',
        'address'        => 'min_length[12]',
        'handphone'        => 'min_length[11]',
        'password'     => 'required|min_length[5]',
        'password_confirm'     => 'required|matches[password]',
        'image_profile'     => [
            'rules' => "max_size[image_profile,1024]|is_image[image_profile]",
            // 'rules' => "max_size[image_profile,1024]|is_image[image_profile]|mime_in[image_profile,image/jpg,image/jpeg,image/png]",
            "errors" => [
                'max_size' =>  "Max file size image 1 Mb",
                "is_image" => "Your chose not image",
                // "mime_in" => "Your choose image not Mime Image"
            ]
        ]
    ];
    protected $beforeInsert = ['hashPassword', 'setRole'];
    protected $afterInsert = ['hashPassword', 'setRole'];
    protected $beforeUpdate = ['hashPassword', 'deleteImg'];
    // EVENT
    // BEFORE 
    // ==================================================
    function hashPassword(array $data)
    {
        if (!isset($data['data']['password'])) return $data;
        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        return $data;
    }
    function  deleteImg($data)
    {
        $id = $data['id'];
        $user = $this->find($id)[0];
        if (!isset($data['data']['image_profile'])) return $data;
        $img = $user['image_profile'];
        if ($img != "default.png") {
            if (file_exists("superadmin/images/profile/" . $img)) {
                unlink("superadmin/images/profile/" . $img);
            }
        }
        return $data;
    }

    public function setRole($data)
    {
        dd($data);
        if (!isset($data['data']['password'])) return $data;
        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        return $data;
    }
    public function user($idUser)
    {
        $this->select("users.*,user_access_role.role_id");
        $this->from("users", true);
        $this->join("user_access_role", "user_access_role.user_id=users.id", "left");
        $this->where('user_access_role.user_id', $idUser);
        return $this;
    }
    public function pelanggan($perPage)
    {
        $this->select("users.*,user_access_role.role_id");
        $this->from("users", true);
        $this->join("user_access_role", "user_access_role.user_id=users.id", "left");
        $this->where('user_access_role.role_id', $this->roleId);
        return $this->paginate($perPage, 'users');
    }
    public function countAllPelanggan()
    {
        $this->select("users.*,user_access_role.role_id");
        $this->from("users", true);
        $this->join("user_access_role", "user_access_role.user_id=users.id", "left");
        $this->where('user_access_role.role_id', $this->roleId);
        return $this->countAllResults();
    }
    public function searchPelanggan($search)
    {
        $this->select("users.*,user_access_role.role_id,mtr_baru,mtr_lama");
        $this->from("user_access_role", true);
        $this->join("users", "users.id=user_access_role.user_id", "left");
        $this->join("(SELECT * from tbl_tagihan order by created_at desc limit 1) as tbl_tg", "users.id=tbl_tg.user_id", "left");
        $this->where([
            'user_access_role.role_id' => $this->roleId,
            "users.no_meteran!=" => null
        ]);
        $this->groupStart()
            ->like('users.no_meteran', $search)
            ->orLike('users.name', $search)
            ->orLike('users.handphone', $search)
            ->groupEnd();
        $this->groupBy("user_access_role.user_id");
        return $this->get()->getResultObject();
    }
}
