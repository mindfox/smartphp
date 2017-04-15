<?php
namespace SmartPHP\Interfaces;

interface DataSourceInterface
{

    public function fetch(int $startRow, int $endRow): array;

    public function add(array $data): array;

    public function update(array $data, array $oldValues): array;

    public function remove(array $data): array;
}
