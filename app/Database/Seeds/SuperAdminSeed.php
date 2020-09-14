<?php

namespace App\Database\Seeds;

class SuperAdminSeed extends \CodeIgniter\Database\Seeder
{
    function run()
    {

        $data = [[
            'id' => 1,
            "name" => "admin",
            'label' => "Admin WEB"
        ], [
            'id' => 2,
            'name' => "Pemilik",
            'label' => "Pemilik WEB"
        ]];
        $this->db->table("role")->insertBatch($data);

        // insert data table User
        $user = [[
            'id' => 1,
            'username' => "adminweb",
            'email' => "irsan00mansyur@gmail.com",
            'password' => '$2y$10$kxuTlD904VFTsJ71L0bA3eJdMxv6AqiI..aGUzorhZNa0Kn5WaxQG',
            'name' => "Irsan Mansyur",
            'is_premium' => 1,
            'is_active' => 1,
            'image_profile' => 'default.png'
        ], [
            'id' => 2,
            'username' => "admin", 'email' => "irsan00mansyur@gmail.com",
            'password' => '$2y$10$kxuTlD904VFTsJ71L0bA3eJdMxv6AqiI..aGUzorhZNa0Kn5WaxQG',
            'name' => "Pemilik Web", 'is_premium' => 1, 'is_active' => 1, 'image_profile' => 'default.png'
        ]];
        $this->db->table("users")->insertBatch($user);


        // insert menu default
        $menu1 = [
            'id' => 1,
            'name' => 'Setting'
        ];
        $this->db->table("menu")->insert($menu1);


        // insert useraccessmenu
        $roleaccessmenu = [[
            'id' => 1,
            'role_id' => 1,
            'menu_id' => 1
        ]];
        $this->db->table("role_access_menu")->insertBatch($roleaccessmenu);

        $userrole = ['id' => 1, 'user_id' => 1, 'role_id' => 1];
        $this->db->table("user_access_role")->insert($userrole);

        // insert submenu
        $submenu1 = [[
            'id' => 1,
            'menu_id' => 1,
            'name' => "Olah Menu",
            'url' => 'super-admin/menu',
            'icon' => "folder"
        ], [
            'id' => 2,
            'menu_id' => 1,
            'name' => "Sub Menu",
            'url' => 'super-admin/submenu',
            'icon' => "create_new_folder"
        ], [
            'id' => 3,
            'menu_id' => 1,
            'name' => "List User",
            'url' => 'super-admin/users',
            'icon' => "group"
        ], [
            'id' => 4,
            'menu_id' => 1,
            'name' => "	Role Access",
            'url' => 'super-admin/role',
            'icon' => "accessible"
        ]];
        $this->db->table("submenu")->insertBatch($submenu1);
        $progress = [['id' => 1, 'name' => "Menu", 'user_id' => 1], ['id' => 2, 'name' => 'submenu', 'user_id' => 1], ['id' => 3, 'name' => "user", 'user_id' => 1]];
        $this->db->table("sa_progress")->insertBatch($progress);
    }
}
