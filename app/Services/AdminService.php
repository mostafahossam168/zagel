<?php

namespace App\Services;

use App\Interfaces\AdminInterface;

class AdminService
{
    public function __construct(private AdminInterface $repository) {}

    public function index()
    {
        return $this->repository->index();
    }

    public function create()
    {
        return $this->repository->create();
    }

    public function store($validated)
    {
        return $this->repository->store($validated);
    }

    public function edit($id)
    {
        return $this->repository->edit($id);
    }

    public function update($validated, $id)
    {
        return $this->repository->update($validated, $id);
    }

    public function delete($id)
    {
        return $this->repository->delete($id);
    }

    public function export()
    {
        return $this->repository->export();
    }

    public function toggleStatus($id)
    {
        return $this->repository->toggleStatus($id);
    }
}
