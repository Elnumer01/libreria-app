<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UsersRepositoryInterface;

class UserRepository implements UsersRepositoryInterface
{
    public function getAll()
    {
        return User::select('users.id','users.name','users.email','roles.rol as roles')
        ->join('roles','users.rol_id','=','roles.id')
        ->get();
    }

    public function getById($id)
    {
        return User::findOrFail($id);
    }

    public function getClients(){
        return User::select('users.id','users.name','users.email','roles.rol')
        ->join('roles','users.rol_id','=','roles.id')
        ->where('users.rol_id','=','2')
        ->get();
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update($id, array $data)
    {
        $user = $this->getById($id);
        $user->update($data);
        return $user;
    }

    public function delete($id)
    {
        $user = $this->getById($id);
        $user->delete();
        return true;
    }
}

