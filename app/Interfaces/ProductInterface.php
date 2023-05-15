<?php

namespace App\Interfaces;

interface ProductInterface {
    public function get();
    public function getById($id);
    public function delete($id);
}
