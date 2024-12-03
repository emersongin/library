<?php
//ruim
//alto acoplamneto e baixa coesão
//bom
// baixo acoplamento e alta coesão

//encapsulamento
//herança
//polimorfismo
//abstração

class Address {
  private string $street;
  private string $number;
  private string $city;
  private string $state;
  private string $country;
  private string $zipCode;
}

class Phone implements PersonPhoneInterface {
  private string $number;
  private string $areaCode;
  private string $countryCode;

  public function __construct(string $number, string $areaCode, string $countryCode) {
    // 
  }

  public function getPhoneNumber(): string {
    return $this->number;
  }
}

interface PersonPhoneInterface {
  public function getPhoneNumber(): string;
}

class Person {
  private string $name;
  private int $age;
  private PersonPhoneInterface $phone;
  private Address $address;

  public function __construct(string $name, int $age, PersonPhoneInterface $phone, Address $address) {
    $this->name = $name;
    $this->age = $age;
    $this->phone = $phone;
    $this->address = $address;
  }

  public function getPhoneNumber(): string {
    return $this->phone->getPhoneNumber();
  }
}

$phone = new Phone('999999999', '11', '55');
$person = new Person('John Doe', 30, $phone, new Address());