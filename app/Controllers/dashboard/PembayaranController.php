<?php

namespace App\Controllers\Dashboard;

use CodeIgniter\RESTful\ResourcePresenter;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class PembayaranController extends ResourcePresenter
{
    protected $session;
    protected $user;
    protected $pelangganModel;
    protected $pembayaranModel;

    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        $this->session = session();
        $this->user = $this->session->get('user');

        $this->pelangganModel = new \App\Models\PelangganModel;
        $this->pembayaranModel = new \App\Models\PembayaranModel;
    }

    /**
     * Present a view of resource objects.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $pembayaran = [];

        if ($this->user['role'] === 'admin') {
            $pembayaran = $this->pembayaranModel->select('pembayaran.*, pelanggan.nama_pelanggan, pelanggan.nomor_kwh, user.nama_admin')
                ->join('pelanggan', 'pelanggan.id_pelanggan = pembayaran.id_pelanggan')
                ->join('user', 'user.id_user = pembayaran.id_user')
                ->findAll();
        } else {
            $pembayaran = $this->pembayaranModel->select('pembayaran.*, pelanggan.nama_pelanggan, pelanggan.nomor_kwh, user.nama_admin')
                ->join('pelanggan', 'pelanggan.id_pelanggan = pembayaran.id_pelanggan')
                ->join('user', 'user.id_user = pembayaran.id_user')
                ->where('pembayaran.id_pelanggan', $this->user['id_pelanggan'])
                ->findAll();
        }

        return view('dashboard/pembayaran', [
            'user' => $this->user,
            'pembayaran' => $pembayaran,
            'pelanggan' => $this->pelangganModel->select('id_pelanggan, nama_pelanggan')->findAll(),
        ]);
    }

    /**
     * Present a view to present a specific resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        //
    }

    /**
     * Present a view to present a new single resource object.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        //
    }

    /**
     * Process the creation/insertion of a new resource object.
     * This should be a POST.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        //
    }

    /**
     * Present a view to edit the properties of a specific resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Process the updating, full or partial, of a specific resource object.
     * This should be a POST.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Present a view to confirm the deletion of a specific resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function remove($id = null)
    {
        //
    }

    /**
     * Process the deletion of a specific resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        //
    }
}
