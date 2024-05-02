<?php

namespace App\Models;
use CodeIgniter\Model;

class AccountModel extends Model
{
    protected $table = 'user';

    public function getList()
    {
        return $this->findAll();
    }

    public function isNickUnique($value)
    {
        return $this->db->table('user')->where('username', $value)->countAllResults() ==  0;
    }

    public function registerNewUser($nickname, $password)
    {

        $data = [
            "username" => hash('sha256', $nickname),
            "password" => password_hash($password, PASSWORD_DEFAULT),
            "role_id" => 3,
        ];

        $status = false;

        if( $this->isNickUnique($data['username']) )
        {
            $this->db->table('user')->insert($data);
            $status = true;
        }

        return $status;
    }

    public function checkNickPass(string $nickname, string $password): array
    {

        $nicknameHash = hash('sha256', $nickname);

        $account = $this->table('user')->join("role", "user.role_id = role.id")->where('username', $nicknameHash)->first();

        $data = [
            'status' => false,
            'userId' =>  0,
            'username' => null,
            'livello' => 0
        ];

        if ( isset($account) && password_verify($password, $account['password'])) { 
            $data['status'] = true;
            $data['userId'] = $account['id'];
            $data['username'] = $nickname;
            $data['livello'] = $account['livello'];
        }

        return $data;
    }

}