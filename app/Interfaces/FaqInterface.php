<?php

namespace App\Interfaces;

interface FaqInterface
{
    public function index(): array;
    public function store(array $data);
    public function edit(string $id);
    public function update(array $data, string $id);
    public function delete(string $id);
}
