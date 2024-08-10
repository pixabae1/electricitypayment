<?php

namespace App\Controllers\Dashboard;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class OverviewController extends BaseController
{
    protected $session;
    protected $user;
    protected $pelanggan;

    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        $this->session = session();
        $this->user = $this->session->get('user');

        $this->pelanggan = new \App\Models\PelangganModel;
    }

    public function get()
    {
        $tarif = new \App\Models\TarifModel;
        $penggunaan = new \App\Models\PenggunaanModel;
        $tagihan = new \App\Models\TagihanModel;
        $pembayaran = new \App\Models\PembayaranModel;

        $data = [
            'user' => $this->user,
            'tarif' => $tarif->countAllResults(),
        ];

        if ($this->user['role'] === 'admin') {
            $data = [
                ...$data,
                'penggunaan' => $penggunaan->countAllResults(),
                'tagihan' => $tagihan->countAllResults(),
                'pembayaran' => $pembayaran->countAllResults(),
            ];
        } else {
            $data = [
                ...$data,
                'penggunaan' => $penggunaan->where('id_pelanggan', $this->user['id_pelanggan'])->countAllResults(),
                'tagihan' => $tagihan->where('id_pelanggan', $this->user['id_pelanggan'])->countAllResults(),
                'pembayaran' => $pembayaran->where('id_pelanggan', $this->user['id_pelanggan'])->countAllResults(),
            ];
        }


        return view('dashboard/overview', $data);
    }
}
