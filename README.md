# REST API на Laravel 9 + Vue 3 (Composition API)

## Описание
Этот проект представляет собой REST API для управления списком постов, реализованный на Laravel 9 (Backend) и Vue 3 (Composition API) (Frontend). Включает следующие функции:
- Получение списка постов
- Создание нового поста
- Редактирование существующего поста
- Удаление поста

## Установка и настройка

### 1. Клонирование репозитория
sh
git clone https://github.com/your-repo/project.git
cd project


### 2. Установка зависимостей
#### Backend (Laravel 9)
sh
composer install
cp .env.example .env
php artisan key:generate

Настроить подключение к базе данных в файле .env.

#### Запуск миграций
sh
php artisan migrate --seed


#### Запуск сервера
sh
php artisan serve


#### Frontend (Vue 3 + Vite)
sh
cd frontend
npm install
npm run dev

