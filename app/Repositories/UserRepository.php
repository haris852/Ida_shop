<?php

namespace App\Repositories;

use App\Interfaces\UserInterface;
use App\Models\User;

class UserRepository implements UserInterface
{
    private $user;

    public function __construct(User $user) {
        $this->user = $user;
    }

    public function get()
    {
        return $this->user->get();
    }

    public function getById($id)
    {
        return $this->user->find($id);
    }

    public function delete($id)
    {
        $user = $this->user->find($id);

        if (!$user) {
            return false; // Jika data tidak ditemukan, kembalikan false atau lakukan penanganan lain sesuai kebutuhan
        }

        return $user->delete();
        }
}
