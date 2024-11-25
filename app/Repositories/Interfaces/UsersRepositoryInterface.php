<?php
    namespace App\Repositories\Interfaces;

    interface UsersRepositoryInterface
    {
        public function getAll();
        public function getById($id);
        public function getClients();
        public function create(array $data);
        public function update($id, array $data);
        public function delete($id);
    }
