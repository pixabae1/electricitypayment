<?php

namespace App\Controllers\Dashboard;

use CodeIgniter\RESTful\ResourcePresenter;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class TagihanController extends ResourcePresenter
{
    protected $session;
    protected $user;
    protected $tagihanModel;
    protected $pelangganModel;

    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        $this->session = session();
        $this->user = $this->session->get('user');

        $this->tagihanModel = new \App\Models\TagihanModel;
        $this->pelangganModel = new \App\Models\PelangganModel;
    }

    /**
     * Present a view of resource objects.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $tagihan = [];

        if ($this->user['role'] === 'admin') {
            $tagihan = $this->tagihanModel->select('tagihan.*, pelanggan.id_pelanggan, pelanggan.nama_pelanggan, pelanggan.nomor_kwh')
                ->join('pelanggan', 'pelanggan.id_pelanggan = tagihan.id_pelanggan')
                ->findAll();
        } else {
            $tagihan = $this->tagihanModel->select('tagihan.*, pelanggan.id_pelanggan, pelanggan.nama_pelanggan, pelanggan.nomor_kwh')
                ->join('pelanggan', 'pelanggan.id_pelanggan = tagihan.id_pelanggan')
                ->where('tagihan.id_pelanggan', $this->user['id_pelanggan'])
                ->findAll();
        }

        return view('dashboard/tagihan', [
            'user' => $this->user,
            'tagihan' => $tagihan,
            'errors' => $this->session->getFlashdata('errors'),
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
        $is_success = $this->tagihanModel->skipValidation()->update($id, [
            'id_penggunaan' => $this->request->getPost('id-penggunaan'),
            'id_tagihan' => $this->request->getPost('id-tagihan'),
            'id_pelanggan' => $this->request->getPost('id-pelanggan'),
            'jumlah_meter' => $this->request->getPost('jumlah-meter'),
            'status' => $this->request->getPost('status'),
        ]);

        if (!$is_success) {
            $this->session->setFlashdata('errors', $this->tagihanModel->errors());

            return redirect()->to('dashboard/tagihan')->withInput();
        }

        return redirect()->to('dashboard/tagihan');
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
