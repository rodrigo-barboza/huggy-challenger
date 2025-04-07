<?php

declare(strict_types=1);

namespace App\Dtos;

final readonly class ContactDto
{
    public function __construct(
        public string $name = '',
        public string $email = '',
        public string $phone = '',
        public string $cellphone = '',
        public ?string $address = null,
        public ?string $neighborhood = null,
        public ?string $state = null,
    ) {}

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'cellphone' => $this->cellphone,
            'address' => $this->address,
            'neighborhood' => $this->neighborhood,
            'state' => $this->state,
        ];
    }
}
