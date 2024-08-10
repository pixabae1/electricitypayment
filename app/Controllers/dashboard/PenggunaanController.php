<?php

namespace App\Controllers\Dashboard;

use CodeIgniter\RESTful\ResourcePresenter;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use DateTime;
use Psr\Log\LoggerInterface;

class PenggunaanController extends ResourcePresenter
{
    protected $session;
    protected $user;
    protected $pelangganModel;
    protected $penggunaanModel;

    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        $this->session = session();
        $this->user = $this->session->get('user');

        $this->pelangganModel = new \App\Models\PelangganModel;
        $this->penggunaanModel = new \App\Models\PenggunaanModel;
    }

    /**
     * Present a view of resource objects.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $penggunaan = [];

        if ($this->user['role'] === 'admin') {
            $penggunaan = $this->penggunaanModel->select('penggunaan.*, pelanggan.nama_pelanggan, pelanggan.nomor_kwh')
                ->join('pelanggan', 'pelanggan.id_pelanggan = penggunaan.id_pelanggan')
                ->findAll();
        } else {
            $penggunaan = $this->penggunaanModel->select('penggunaan.*, pelanggan.nama_pelanggan, pelanggan.nomor_kwh')
                ->join('pelanggan', 'pelanggan.id_pelanggan = penggunaan.id_pelanggan')
                ->where('penggunaan.id_pelanggan', $this->user['id_pelanggan'])
                ->findAll();
        }

        return view('dashboard/penggunaan', [
            'user' => $this->user,
            'penggunaan' => $penggunaan,
            'pelanggan' => $this->pelangganModel->select('id_pelanggan, nama_pelanggan')->findAll(),
            'errors' => $this->session->getFlashdata('errors'),
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
        $penggunaanModelRules = $this->penggunaanModel->getValidationRules([
            'except' => ['id_penggunaan']
        ]);

        $penggunaan = [
            'id_pelanggan' => $this->request->getPost('id-pelanggan'),
            'bulan' => $this->request->getPost('bulan'),
            'meter_awal' => $this->request->getPost('meter-awal'),
            'meter_akhir' => $this->request->getPost('meter-akhir'),
        ];

        $date = explode('-', $penggunaan['bulan'] ?? '');
        $penggunaan['bulan'] = $date[1];
        $penggunaan['tahun'] = $date[0];

        if (!$this->validateData($penggunaan, $penggunaanModelRules)) {
            $this->session->setFlashdata('errors', $this->validator->getErrors());

            return redirect()->to('dashboard/penggunaan')->withInput();
        }

        $is_success = $this->penggunaanModel->skipValidation()->insert($penggunaan);

        if (!$is_success) {
            $this->session->setFlashdata('errors', $this->penggunaanModel->errors());

            return redirect()->to('dashboard/penggunaan')->withInput();
        }

        return redirect()->to('dashboard/penggunaan');
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
        $penggunaan = [
            'id_pelanggan' => $this->request->getPost('id-pelanggan'),
            'bulan' => $this->request->getPost('bulan'),
            'meter_awal' => $this->request->getPost('meter-awal'),
            'meter_akhir' => $this->request->getPost('meter-akhir'),
        ];

        $date = explode('-', $penggunaan['bulan'] ?? '');
        $penggunaan['bulan'] = $date[1];
        $penggunaan['tahun'] = $date[0];

        $is_success = $this->penggunaanModel->update($id, $penggunaan);


        if (!$is_success) {
            $this->session->setFlashdata('errors', $this->pelangganModel->errors());

            return redirect()->to('dashboard/penggunaan')->withInput();
        }

        return redirect()->to('dashboard/penggunaan');
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
        $this->penggunaanModel->delete($id);

        return redirect()->to('dashboard/penggunaan');
    }
}
