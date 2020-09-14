<?php

namespace App\Models;

use App\Database\Migrations\TblTagihan;
use CodeIgniter\Model;

class TagihanModel extends Model
{
    protected $table = 'tbl_tagihan';

    protected $returnType = 'object';
    protected $allowedFields = [
        'updated_at', 'user_id', 'volume', 'mtr_lama', 'mtr_baru', 'untuk_bulan_tahun'
    ];

    protected $validationRules = [
        'mtr_baru' => 'required',
        'user_id'    => 'permit_empty|integer',
        'untuk_bulan_tahun' => "required",
        'volume' => "required",
    ];
    public function getTagihan($id = null)
    {
        if ($id) {
            return 0;
        }
        $this->from("(SELECT MONTH(untuk_bulan_tahun) as month,YEAR(untuk_bulan_tahun) as year from tbl_tagihan) as tbl_tagihan");
        $this->join("(SELECT id as idu,name,no_meteran from  users) as user", "tbl_tagihan.user_id=user.idu");
        $this->groupBy("tbl_tagihan.user_id", "asc");
        return $this;
    }
}
