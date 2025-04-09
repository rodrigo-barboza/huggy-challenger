#!/bin/bash
cd frontend
cp .env.example .env

# instalar as dependências do frontend
npm install

cd ../backend
cp .env.example .env

# instalar as dependências do backend
composer install

# executar comandos do Laravel
php artisan key:generate
php artisan migrate
php artisan db:seed

# executa o ambiente de desenvolvimento (serve, queue, vite)
composer development
