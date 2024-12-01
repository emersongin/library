<?php

namespace App\Library\UseCase;

use App\Library\Domain\LibraryUser;

final class CreateLibraryUser {
  public function execute(array $input): array {
    $name = $input['name'];
    $cpf = $input['cpf'];

    $libraryUser = new LibraryUser($name, $cpf);

    return [
      'id' => $libraryUser->getId()
    ];
  }
}