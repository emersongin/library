<?php

namespace App\Library\Infra\Database;

interface DatabaseSQL {
  public function select(string $query): array;
  public function insert(string $query, array $data): bool;
}
