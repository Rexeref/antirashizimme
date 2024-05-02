<?php 

namespace App\Controllers;
use App\Models\AccountModel;

class Login extends BaseController {
    public function index()
    {
        $data = [
            'title' => 'Login',
            'error' => $this->request->getGet('e')
        ];

        return view('templates/header', $data)
                .view('v_login', $data)
                .view('templates/footer');
    }

    public function challengeResponse()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        if (empty($username))
        {
            return redirect()->to("/login?e=1"); // Nickname Vuoto
        }
        if (empty($password))
        {
            return redirect()->to("/login?e=2"); // Password Vuota
        }

        $model = model(AccountModel::class);
        $accountData = $model->checkNickPass($username, $password);

        if($accountData['username'] === null) // esegui se status == false
        {
            return redirect()->to("/login?e=3"); // Login Errato
        }
        else {
            $session = session();
            $session->active = $accountData['status'];
            $session->userId = $accountData['userId'];
            $session->userName = $accountData['username'];
            $session->livello = $accountData['livello'];
        }

        return redirect()->to("/");
    }

    public function registerForm()
    {
        $data = [
            'title' => 'Register',
            'error' => $this->request->getGet('e')
        ];

        return view('templates/header', $data)
                .view('v_register', $data)
                .view('templates/footer');
    }

    public function register()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        if ($username == '')
        {
            return redirect()->to("/register?e=1"); // Nickname Vuoto
        }
        if ($password == '')
        {
            return redirect()->to("/register?e=2"); // Password Vuota
        }

        $model = model(AccountModel::class);
        $status = $model->registerNewUser($username, $password);

        if(!$status) // esegui se status == false
        {
            return redirect()->to("/register?e=3"); // Se il nickname già esiste
        }

        return redirect()->to("login?e=4"); // Loggarsi con l'account creato
    }

    public function logout()
    {
        $session = session();
        $session->active = false;
        $session->userId = 0;
        $session->userName = "";
        $session->livello = 0;
        return redirect()->to("/");
    }
}