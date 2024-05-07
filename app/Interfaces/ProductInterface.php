<?php

namespace App\Interfaces;

interface ProductInterface
{
    public function getAll();
    public function getBySKU();
    public function create();
    public function update();
    public function delete();
}
