<?php

namespace App\Library\Infra\Repository;

use App\Library\Domain\LibraryUser;

interface LibraryUserRepository {
  public function save(LibraryUser $libraryUser): void;
  public function findById(int $id): LibraryUser;
}