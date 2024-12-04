<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Library\UseCase\CreateLibraryUser;
use App\Library\Infra\Database\DatabaseMemory;
use App\Library\Infra\Repository\LibraryUserRepositoryMemory;

final class CreateLibraryUserTest extends TestCase 
{
  public function testDeveCriarUmUsuarioDaBibliotecaEsuaIndentificacao(): void {
    //given/arrange/dados que
    $db = new DatabaseMemory();
    $libraryUserRepositoryMemory = new LibraryUserRepositoryMemory($db);
    $useCase = new CreateLibraryUser($libraryUserRepositoryMemory);

    //when/act/quando
    $input = [
      'name' => 'John Doe',
      'cpf'  => '529.982.247-25'
    ];
    $output = $useCase->execute($input);

    $userData = $db->select('library_users,1');
    $userId = $userData['id'];

    //then/assert/então
    $this->assertEquals('John Doe', $userData['name']);
    $this->assertEquals('529.982.247-25', $userData['cpf']);
    $this->assertEquals($userId, $output['id']);
  }

  public function testDeveLancarUmErroQuandoNomeDeUsuarioEstiverIncorreto(): void {
    //then/assert/então
    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage("Parâmetro nome de usuário invalido");

    //given/arrange/dados que
    $db = new DatabaseMemory();
    $libraryUserRepositoryMemory = new LibraryUserRepositoryMemory($db);
    $useCase = new CreateLibraryUser($libraryUserRepositoryMemory);

    //when/act/quando
    $input = [
      'name' => 'John',
      'cpf'  => '529.982.247-25'
    ];
    $useCase->execute($input);
  }

  public function testDeveLancarUmErroQuandoCPFdeUsuarioEstiverIncorreto(): void {
    //then/assert/então
    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage("Parâmetro CPF de usuário invalido");

    //given/arrange/dados que
    $db = new DatabaseMemory();
    $libraryUserRepositoryMemory = new LibraryUserRepositoryMemory($db);
    $useCase = new CreateLibraryUser($libraryUserRepositoryMemory);

    //when/act/quando
    $input = [
      'name' => 'John Doe',
      'cpf'  => '123.456.789-00'
    ];
    $useCase->execute($input);
  }
}
