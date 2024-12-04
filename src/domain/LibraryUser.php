<?php

namespace App\Library\Domain;

use InvalidArgumentException;

final class LibraryUser {
  private string $id;
  private string $name;
  private string $cpf;

  public function __construct(string $name, string $cpf) {
    $this->setName($name);
    $this->setCPF($cpf);
    $this->id = uniqid();
  }

  private function setName($name) {
    if (strlen($name) < 6) {
      throw new InvalidArgumentException("Parâmetro nome de usuário invalido");
    }
    $this->name = $name;
  }

  private function setCPF($cpf) {
    if ($this->validarCPF($cpf) == false) {
      throw new InvalidArgumentException("Parâmetro CPF de usuário invalido");
    }
    $this->cpf = $cpf;
  }

  function validarCPF($cpf) {
    // Remove caracteres não numéricos
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    // Verifica se o CPF tem 11 dígitos
    if (strlen($cpf) !== 11) {
      return false;
    }

    // Verifica se todos os dígitos são iguais (ex: 111.111.111-11)
    if (preg_match('/^(\d)\1{10}$/', $cpf)) {
      return false;
    }

    // Calcula e verifica os dois dígitos verificadores
    for ($t = 9; $t < 11; $t++) {
      $soma = 0;
      for ($i = 0; $i < $t; $i++) {
          $soma += $cpf[$i] * (($t + 1) - $i);
      }
      $digito = ((10 * $soma) % 11) % 10;
      if ($cpf[$t] != $digito) {
        return false;
      }
    }
    return true;
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

  public function toArray(): array {
    return [
      'id' => $this->id,
      'name' => $this->name,
      'cpf' => $this->cpf
    ];
  }
}