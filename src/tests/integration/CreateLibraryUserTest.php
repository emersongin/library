<?php 
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Library\UseCase\CreateLibraryUser;
use App\Library\Infra\Database\DatabaseMemory;
use App\Library\Infra\Repository\LibraryUserRepositoryMemory;

final class CreateLibraryUserTest extends TestCase {
  public function testDeveCriarUmUsuarioDaBibliotecaEsuaIndentificacao(): void {
    //given/arrange/dados que
    $db = new DatabaseMemory();
    $libraryUserRepositoryMemory = new LibraryUserRepositoryMemory($db);
    $useCase = new CreateLibraryUser($libraryUserRepositoryMemory);

    //when/act/quando
    $input = [
      'name' => 'John Doe',
      'cpf'  => '123.456.789-00'
    ];
    $output = $useCase->execute($input);
    
    $userData = $db->select('library_users,1');
    $userId = $userData['id'];

    //then/assert/entao
    $this->assertEquals('John Doe', $userData['name']);
    $this->assertEquals('123.456.789-00', $userData['cpf']);
    $this->assertEquals($userId, $output['id']);
  }
}