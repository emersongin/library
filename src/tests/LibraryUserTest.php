<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use App\Library\Domain\LibraryUser;

final class LibraryUserTest extends TestCase {
  public function testCriarUsuarioDaBiblioteca(): void {
    $name = 'John Doe';
    $cpf = '123.456.789-00';

    $libraryUser = new LibraryUser($name, $cpf);

    $this->assertEquals($name, $libraryUser->getName());
    $this->assertEquals($cpf, $libraryUser->getCpf());
    $this->assertIsString($libraryUser->getId());
  }
}