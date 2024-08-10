<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function register()
    {
        $method = $this->request->getMethod();

        if ($method == 'POST') {
            helper('generateRandomNumber');

            $pelangganModel = new \App\Models\PelangganModel;

            $pelangganModelRules = $pelangganModel->getValidationRules([
                'except' => ['id_pelanggan', 'nomor_kwh', 'id_tarif']
            ]);

            $pelanggan = [
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
                'nama_pelanggan' => $this->request->getPost('nama-pelanggan'),
                'alamat' => $this->request->getPost('alamat'),
            ];

            if (!$this->validateData($pelanggan, $pelangganModelRules)) {
                return view('auth/register', ['errors' => $this->validator->getErrors()]);
            }

            $pelanggan['password'] = password_hash($pelanggan['password'] ?? '', PASSWORD_DEFAULT);
            $pelanggan['nomor_kwh'] = generateRandomNumber();
            $pelanggan['id_tarif'] = 1;

            $is_success = $pelangganModel->skipValidation()->insert($pelanggan);

            if (!$is_success) {
                return view('auth/register', ['errors' => $pelangganModel->errors()]);
            }

            $session = session();

            $pelanggan['role'] = 'pelanggan';
            unset($pelanggan['password']);

            $session->set('user', $pelanggan);

            return redirect()->to('dashboard');
        }

        return view('auth/register');
    }

    public function login()
    {
        $method = $this->request->getMethod();

        if ($method == 'POST') {
            $user = [
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
            ];

            if (!$this->validateData(['username' => $user['username']], ['username' => 'required|alpha'])) {
                return view('auth/login', ['errors' => $this->validator->getErrors()]);
            }

            $model = new \App\Models\UserModel;
            $modelValidationRules = [
                'username' => 'required|alpha|max_length[16]',
                'password' => 'required|alpha_numeric_punct|max_length[64]',
            ];

            $account = $model->where('username', $user['username'])->first();
            $role = 'admin';

            if (!$account) {
                $model = new \App\Models\PelangganModel;

                $account = $model->where('username', $user['username'])->first();

                if (!$account) {
                    return redirect()->to('register')->with('account', 'Username not found, please register first');
                }

                $role = 'pelanggan';
            }

            if (!$this->validateData($user, $modelValidationRules)) {
                return view('auth/login', ['errors' => $this->validator->getErrors()]);
            }

            $is_verified = password_verify($user['password'] ?? '', $account['password']);

            if (!$is_verified) {
                return view('auth/login', ['errors' => ['password' => 'Wrong password']]);
            }

            $session = session();

            $account['role'] = $role;
            unset($account['password']);

            $session->set('user', $account);

            return redirect()->to('dashboard');
        }

        return view('auth/login');
    }

    public function logout()
    {
        $session = session();
        $session->destroy();

        return redirect()->to('login');
    }
}
