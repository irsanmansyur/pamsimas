<?php

namespace App\Models;

use CodeIgniter\Model;

class TransaksiModel extends Model
{
    protected $table = 'tbl_transaksi';

    protected $returnType = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'ip_address', 'email', 'user_id', 'date', 'success'
    ];


    protected $validationRules = [
        'ip_address' => 'required',
        'email'      => 'required',
        'user_id'    => 'permit_empty|integer',
        'date'       => 'required|valid_date',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;
}
