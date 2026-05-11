<?php

namespace App\Services;

use App\Interfaces\CategoryInterface;

class CategoryService
{
    public function __construct(private CategoryInterface $repository) {}

    public function index()              { return $this->repository->index(); }
    public function store($validated)    { return $this->repository->store($validated); }
    public function edit($id)            { return $this->repository->edit($id); }
    public function update($data, $id)   { return $this->repository->update($data, $id); }
    public function delete($id)          { return $this->repository->delete($id); }
}
