<?php 
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use App\Library\UseCase\CreateLibraryUser;

final class CreateLibraryUserTest extends TestCase {
  public function testDeveCriarUmUsuarioDaBibliotecaEsuaIndentificacao(): void {
    $input = [
      'name' => 'John Doe',
      'cpf' => '123.456.789-00'
    ];

    $useCase = new CreateLibraryUser();
    $output = $useCase->execute($input);
    
    $this->assertIsArray($output);
    $this->assertArrayHasKey('id', $output);
  }
}