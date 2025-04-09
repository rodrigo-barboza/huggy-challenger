<?php

namespace Tests\Unit\App\Dtos;

use App\Dtos\ContactDto;
use PHPUnit\Framework\TestCase;

class ContactDtoTest extends TestCase
{
    public function testCreatesDtoWithRequiredFields(): void
    {
        $dto = new ContactDto(
            name: 'Nuno Maduro',
            email: 'nuno@example.com',
            phone: '11999999999',
            cellphone: '11988888888'
        );

        $this->assertEquals('Nuno Maduro', $dto->name);
        $this->assertEquals('nuno@example.com', $dto->email);
        $this->assertEquals('11999999999', $dto->phone);
        $this->assertEquals('11988888888', $dto->cellphone);
        $this->assertNull($dto->address);
        $this->assertNull($dto->neighborhood);
        $this->assertNull($dto->state);
    }

    public function testCreatesDtoWithOptionalFields(): void
    {
        $dto = new ContactDto(
            name: 'Jane Smith',
            email: 'jane@example.com',
            phone: '21999999999',
            cellphone: '21988888888',
            address: '123 Main St',
            neighborhood: 'Downtown',
            state: 'SP'
        );

        $this->assertEquals('Jane Smith', $dto->name);
        $this->assertEquals('jane@example.com', $dto->email);
        $this->assertEquals('21999999999', $dto->phone);
        $this->assertEquals('21988888888', $dto->cellphone);
        $this->assertEquals('123 Main St', $dto->address);
        $this->assertEquals('Downtown', $dto->neighborhood);
        $this->assertEquals('SP', $dto->state);
    }

    public function testToArrayMethod(): void
    {
        $this->assertEquals([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'phone' => '11999999999',
                'cellphone' => '11988888888',
                'address' => '456 Side St',
                'neighborhood' => 'Uptown',
                'state' => 'RJ',
            ], new ContactDto(
                name: 'Test User',
                email: 'test@example.com',
                phone: '11999999999',
                cellphone: '11988888888',
                address: '456 Side St',
                neighborhood: 'Uptown',
                state: 'RJ'
            )->toArray()
        );
    }

    public function testToArrayMethodWithNullOptionalFields(): void
    {
        $this->assertEquals([
                'name' => 'Test User',
                'email' => 'test@example.com',
                'phone' => '11999999999',
                'cellphone' => '11988888888',
                'address' => null,
                'neighborhood' => null,
                'state' => null,
            ], new ContactDto(
                name: 'Test User',
                email: 'test@example.com',
                phone: '11999999999',
                cellphone: '11988888888'
            )->toArray()
        );
    }

    public function testDtoIsImmutable(): void
    {
        $dto = new ContactDto(
            name: 'John Doe',
            email: 'john@example.com',
            phone: '11999999999',
            cellphone: '11988888888'
        );

        $this->expectException(\Error::class);
        $this->expectExceptionMessage('Cannot modify readonly property App\Dtos\ContactDto::$name');

        $dto->name = 'New Name'; // Tentativa de modificar propriedade readonly
    }
}
