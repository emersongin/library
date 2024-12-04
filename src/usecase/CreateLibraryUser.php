<?php

namespace App\Library\UseCase;

use App\Library\Domain\LibraryUser;
use App\Library\Infra\Repository\LibraryUserRepository;

final class CreateLibraryUser {
  private LibraryUserRepository $libraryUserRepository;

  public function __construct(LibraryUserRepository $libraryUserRepository) {
    $this->libraryUserRepository = $libraryUserRepository;
  }

  public function execute(array $input): array {
    $name = $input['name'];
    $cpf = $input['cpf'];

    $libraryUser = new LibraryUser($name, $cpf);
    $this->libraryUserRepository->save($libraryUser);

    return [
      'id' => $libraryUser->getId()
    ];
  }
}