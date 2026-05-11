<?php

namespace App\Services;

use App\Interfaces\FaqInterface;

class FaqService
{
    public function __construct(private FaqInterface $repository) {}

    public function index(): array  { return $this->repository->index(); }
    public function store(array $data) { return $this->repository->store($data); }
    public function edit(string $id)   { return $this->repository->edit($id); }
    public function update(array $data, string $id) { return $this->repository->update($data, $id); }
    public function delete(string $id) { return $this->repository->delete($id); }
}
