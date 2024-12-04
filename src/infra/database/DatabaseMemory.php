<?php

namespace App\Library\Infra\Database;

class DatabaseMemory implements DatabaseSQL {
  private array $tables = [
    'library_users' => []
  ];

  public function select($query): array {
    $queryData = explode(',', $query);
    $tableName = $queryData[0];
    $id = $queryData[1];
    return $this->tables[$tableName][$id] ?? [];
  }

  public function insert($query, $data): bool {
    $queryData = explode(',', $query);
    $tableName = $queryData[0];
    $id = count($this->tables[$tableName] ?? []) + 1;
    $this->tables[$tableName][$id] = $data;
    return true;
  }
}