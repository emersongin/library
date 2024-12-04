<?php

namespace App\Library\Infra\Repository;

use App\Library\Infra\Database\DatabaseSQL;
use App\Library\Domain\LibraryUser;

class LibraryUserRepositoryMemory implements LibraryUserRepository {
  private DatabaseSQL $db;

  public function __construct(DatabaseSQL $db) {
    $this->db = $db;
  }

  public function save(LibraryUser $libraryUser): void {
    $this->db->insert('library_users', $libraryUser->toArray());
  }

  public function findById(int $id): LibraryUser {
    $data = $this->db->select("library_users,{$id}");
    return new LibraryUser($data);
  }
}