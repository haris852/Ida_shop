<?php

namespace App\Interfaces;

interface UserInterface {
    public function get();
    public function getById($id);
    public function delete($id);
}
