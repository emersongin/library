<?php

namespace App\Library\Domain;

final class LibraryUser {
  private string $id;
  private string $name;
  private string $cpf;

  public function __construct(string $name, string $cpf) {
    $this->name = $name;
    $this->cpf = $cpf;
    $this->id = uniqid();
  }

  public function getName(): string {
    return $this->name;
  }

  public function getCpf(): string {
    return $this->cpf;
  }

  public function getId(): string {
    return $this->id;
  }
}