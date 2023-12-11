<?php

namespace App\Interfaces;

use App\Models\Template;

interface TemplateRepositoryInterface
{
    public function create(array $data): Template;

    public function update(Template $template, array $data): Template;

    public function dataTable($offset, $limit, $search, $order = []): array;

    public function syncProperties(Template $template, array $properties): bool;
}
