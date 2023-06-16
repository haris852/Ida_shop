<?php

namespace App\Interfaces;

interface ProductInterface {
    public function get();
    public function getById($id);
    public function delete($id);
    public function update($id, $data);
    public function store($data);
    public function getCategories();
}
