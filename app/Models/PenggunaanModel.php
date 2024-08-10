<?php

namespace App\Models;

use CodeIgniter\Model;

class PenggunaanModel extends Model
{
    protected $table            = 'penggunaan';
    protected $primaryKey       = 'id_penggunaan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_penggunaan',
        'id_pelanggan',
        'bulan',
        'tahun',
        'meter_awal',
        'meter_akhir',
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
        'id_penggunaan' => 'required|integer|is_unique[penggunaan.id_penggunaan,id_penggunaan,{id_penggunaan}]',
        'id_pelanggan' => 'required|integer',
        'bulan' => 'required|numeric|max_length[2]',
        'tahun' => 'required|numeric|max_length[4]',
        'meter_awal' => 'required|integer',
        'meter_akhir' => 'required|integer',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = ['triggerInsertTagihan'];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = ['triggerUpdateTagihan'];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function triggerInsertTagihan($data)
    {
        $jumlah_meter = $data['data']['meter_akhir'] - $data['data']['meter_awal'];

        $tagihanModel = new \App\Models\TagihanModel();

        $tagihanData = [
            'id_penggunaan' => $data['id'],
            'id_pelanggan' => $data['data']['id_pelanggan'],
            'bulan' => $data['data']['bulan'],
            'tahun' => $data['data']['tahun'],
            'jumlah_meter' => $jumlah_meter,
            'status' => 'Belum Lunas',
        ];

        $tagihanModel->skipValidation()->insert($tagihanData);
    }

    public function triggerUpdateTagihan($data)
    {
        $session = session();

        // $session->setFlashdata('errors', ['PENGGUNAAN MODEL', $data]);
        $jumlah_meter = $data['data']['meter_akhir'] - $data['data']['meter_awal'];

        $tagihanModel = new \App\Models\TagihanModel();
        $tagihan = $tagihanModel->where('id_penggunaan', $data['id'])->first();

        $tagihanModel->skipValidation()
            ->where('id_penggunaan', $data['id'])
            ->set([
                'id_penggunaan' => $data['id'],
                'id_pelanggan' => $data['data']['id_pelanggan'],
                'bulan' => $data['data']['bulan'],
                'tahun' => $data['data']['tahun'],
                'jumlah_meter' => $jumlah_meter,
                'status' => $tagihan['status'],
            ])
            ->update();
    }
}
