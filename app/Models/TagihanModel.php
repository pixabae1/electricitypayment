<?php

namespace App\Models;

use CodeIgniter\Model;

class TagihanModel extends Model
{
    protected $table            = 'tagihan';
    protected $primaryKey       = 'id_tagihan';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'id_tagihan',
        'id_penggunaan',
        'id_pelanggan',
        'bulan',
        'tahun',
        'jumlah_meter',
        'status',
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
        'id_tagihan' => 'required|integer|is_unique[tagihan.id_tagihan,id_tagihan,{id_tagihan}]',
        'id_penggunaan' => 'required|integer',
        'id_pelanggan' => 'required|integer',
        'bulan' => 'required|numeric|max_length[2]',
        'tahun' => 'required|numeric|max_length[4]',
        'jumlah_meter' => 'required|integer',
        'status' => 'required|in_list[Lunas, Belum Lunas]',
    ];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = ['updatePembayaran'];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function updatePembayaran($data)
    {
        $session = session();

        $pembayaranModel = new \App\Models\PembayaranModel;
        $pelangganModel = new \App\Models\PelangganModel;

        $tagihan = $this->select('tagihan.id_tagihan')
            ->where(['id_pelanggan' => $data['data']['id_pelanggan'], 'id_penggunaan' => $data['data']['id_penggunaan']])
            ->first();

        $pembayaran = $pembayaranModel->where('id_tagihan', $tagihan['id_tagihan'])->first();

        // $session->setFlashdata('errors', ['TAGIHAN MODEL', [$tagihan, $pembayaran]]);

        $tarif_bayar = $pelangganModel->select('tarif.tarifperkwh')
            ->join('tarif', 'tarif.id_tarif = pelanggan.id_tarif')
            ->first();

        $total_bayar = $data['data']['jumlah_meter'] * $tarif_bayar['tarifperkwh'];

        if ($data['data']['status'] === 'Lunas') {
            if (!$pembayaran) {
                $date = explode('-', date("Y-m-d"));

                $pembayaranModel->skipValidation()
                    ->insert([
                        'id_tagihan' => $tagihan['id_tagihan'],
                        'id_pelanggan' => $data['data']['id_pelanggan'],
                        'tanggal_pembayaran' => date("Y-m-d"),
                        'bulan_bayar' => $date[1],
                        'biaya_admin' => '2500',
                        'total_bayar' => $total_bayar,
                        'id_user' => $session->get('user')['id_user'],
                    ]);
                $session->setFlashdata('errors', 'A1');
            } else {
                $pembayaranModel->where('id_tagihan', $tagihan['id_tagihan'])
                    ->set(['total_bayar' => $total_bayar])
                    ->update();

                // $session->setFlashdata('errors', ['A2', [$data['data']['jumlah_meter'], $tarif_bayar]]);
            }
        } else {
            if ($pembayaran) {
                $pembayaranModel->where('id_tagihan', $data['id'])->delete();
            }
            $session->setFlashdata('errors', 'B1');
        }

        // if ($pembayaran) {
        //     if ($data['data']['status'] === 'Belum Lunas') {
        //         $pembayaranModel->where('id_tagihan', $data['id'])->delete();
        //     }
        // } else {
        //     if ($data['data']['status'] === 'Lunas') {
        //     } else {
        //         $date = explode('-', date("Y-m-d"));

        //         $tarif_bayar = $pelangganModel->select('tarif.tarifperkwh')
        //             ->join('tarif', 'tarif.id_tarif = pelanggan.id_tarif')
        //             ->first();
        //         $total_bayar = (int)$data['data']['jumlah_meter'] * (int)$tarif_bayar;

        //         $session = session();

        //         $pembayaranModel->skipValidation()
        //             ->insert([
        //                 'id_tagihan' => $tagihan['id_tagihan'],
        //                 'id_pelanggan' => $data['data']['id_pelanggan'],
        //                 'tanggal_pembayaran' => date("Y-m-d"),
        //                 'bulan_bayar' => $date[1],
        //                 'biaya_admin' => '2500',
        //                 'total_bayar' => $total_bayar,
        //                 'id_user' => $session->get('user')['id_user'],
        //             ]);
        //     }
        // }
    }
}
