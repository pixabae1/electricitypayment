<?php

namespace App\Models;

use CodeIgniter\Model;

class PelangganModel extends Model
{
    protected $table            = 'pelanggan';
    protected $primaryKey       = 'id_pelanggan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_pelanggan',
        'username',
        'password',
        'nomor_kwh',
        'nama_pelanggan',
        'alamat',
        'id_tarif',
    ];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'id_pelanggan' => 'required|integer|is_unique[pelanggan.id_pelanggan,id_pelanggan,{id_pelanggan}]',
        'username' => 'required|alpha|max_length[16]|is_unique[pelanggan.username,id_pelanggan,{id_pelanggan}]',
        'password' => 'required|alpha_numeric_punct|max_length[64]',
        'nomor_kwh' => 'required|numeric|max_length[16]|is_unique[pelanggan.nomor_kwh,id_pelanggan,{id_pelanggan}]',
        'nama_pelanggan' => 'required|alpha_space|max_length[32]',
        'alamat' => 'required|alpha_numeric_punct|max_length[64]',
        'id_tarif' => 'required|integer',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
