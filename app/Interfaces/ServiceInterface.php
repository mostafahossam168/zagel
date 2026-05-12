<?php

namespace App\Interfaces;

interface ServiceInterface
{
    public function index();
    public function store($validated);
    public function edit($id);
    public function update($validated, $id);
    public function delete($id);
}
