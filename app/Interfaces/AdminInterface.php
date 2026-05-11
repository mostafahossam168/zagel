<?php

namespace App\Interfaces;

interface AdminInterface
{
    public function index();
    public function create();
    public function store($validated);
    public function edit($id);
    public function update($validated, $id);
    public function delete($id);
    public function export();
    public function toggleStatus($id);
}
