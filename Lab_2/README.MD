
# Отчет по лабораторной работе №2: HTTP-запросы и шаблонизация в Laravel

## Цель работы

Изучить основные принципы работы с HTTP-запросами в Laravel и шаблонизацию с использованием Blade на примере веб-приложения To-Do App для команд.

## Выполненные задания

### 1. Подготовка к работе и установка Laravel

- **Создание проекта Laravel:**  
  Выполнил команду для создания нового проекта:
  ```bash
  composer create-project laravel/laravel:^10 todo-app
  ```
- **Запуск встроенного сервера:**  
  Запустил сервер для локальной разработки:
  ```bash
  php artisan serve
  ```
- **Результат:**  
  В браузере на странице `http://localhost:8000` отображается стартовая страница Laravel, что подтверждает успешную установку.

### 2. Настройка окружения

- **Изменение файла `.env`:**  
  Настроил основные параметры приложения:
  ```ini
  APP_NAME=ToDoApp
  APP_ENV=local
  APP_DEBUG=true
  APP_URL=http://localhost:8000
  ```
- **Генерация ключа приложения:**  
  Сгенерировал ключ для шифрования данных:
  ```bash
  php artisan key:generate
  ```
- **Вопрос:**  
  Если данный ключ попадет в руки злоумышленника, он сможет расшифровать конфиденциальные данные приложения.

### 3. Основы работы с HTTP-запросами

#### 3.1. Создание маршрутов для главной страницы и страницы "О нас"

- **Создание контроллера `HomeController`:**  
  Создал контроллер для обработки запросов главной страницы:
  ```bash
  php artisan make:controller HomeController
  ```
- **Методы контроллера:**
  ```php
  // app/Http/Controllers/HomeController.php
  public function index()
  {
      return view('home');
  }

  public function about()
  {
      return view('about');
  }
  ```
- **Маршруты в `routes/web.php`:**
  ```php
  Route::get('/', [HomeController::class, 'index'])->name('home');
  Route::get('/about', [HomeController::class, 'about'])->name('about');
  ```

#### 3.2. Создание маршрутов для задач

- **Создание контроллера `TaskController`:**  
  Создал контроллер для управления задачами:
  ```bash
  php artisan make:controller TaskController
  ```
- **Методы контроллера:**
  ```php
  // app/Http/Controllers/TaskController.php
  namespace App\Http\Controllers;

  use Illuminate\Http\Request;

  class TaskController extends Controller
  {
      public function index()
      {
          $tasks = $this->getTasks();
          return view('tasks.index', ['tasks' => $tasks]);
      }

      public function show($id)
      {
          $task = $this->getTask($id);
          return view('tasks.show', ['task' => $task]);
      }

      private function getTasks()
      {
          return [
              [
                  'id' => 1,
                  'title' => 'Первая задача',
                  'description' => 'Описание первой задачи',
                  'status' => 'выполнена',
                  'priority' => 'высокий',
                  'assigned_to' => 'Иван Иванов'
              ],
              [
                  'id' => 2,
                  'title' => 'Вторая задача',
                  'description' => 'Описание второй задачи',
                  'status' => 'не выполнена',
                  'priority' => 'средний',
                  'assigned_to' => 'Петр Петров'
              ],
          ];
      }

      private function getTask($id)
      {
          $tasks = $this->getTasks();
          foreach ($tasks as $task) {
              if ($task['id'] == $id) {
                  return $task;
              }
          }
          return null;
      }
  }
  ```
- **Ресурсный маршрут:**
  ```php
  Route::resource('tasks', TaskController::class);
  ```
- **Вопрос:**  
  Ресурсный контроллер автоматически создает маршруты для всех операций CRUD, что упрощает настройку и улучшает читаемость кода.

### 4. Шаблонизация с использованием Blade

#### 4.1. Создание макета страницы

- **Создание макета `layouts/app.blade.php`:**  
  Макет с общими элементами страницы:
  ```php
  <!DOCTYPE html>
  <html lang="ru">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>@yield('title', 'ToDoApp')</title>
      <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  </head>
  <body>
      <header>
          <h1>{{ config('app.name') }}</h1>
          <nav>
              <ul>
                  <li><a href="{{ route('home') }}">Главная</a></li>
                  <li><a href="{{ route('about') }}">О нас</a></li>
                  <li><a href="{{ route('tasks.index') }}">Задачи</a></li>
              </ul>
          </nav>
      </header>
      <main>
          @yield('content')
      </main>
  </body>
  </html>
  ```

#### 4.2. Использование шаблонов Blade

- **Главная страница `home.blade.php`:**
  ```php
  @extends('layouts.app')

  @section('title', 'Главная')

  @section('content')
      <h2>Добро пожаловать в ToDoApp для команд</h2>
      <p>Управляйте задачами вашей команды эффективно.</p>
      <p>Этот инструмент поможет вам отслеживать статус и приоритет задач, а также назначать их участникам команды.</p>
  @endsection
  ```

- **Страница "О нас" `about.blade.php`:**
  ```php
  @extends('layouts.app')

  @section('title', 'О нас')

  @section('content')
      <h2>О нашем приложении ToDoApp</h2>
      <p>ToDoApp — это приложение для управления задачами внутри команды, аналогичное системе Github Issues.</p>
      <p>Наше приложение позволяет назначать задачи участникам команды, отслеживать их статус и приоритет.</p>
  @endsection
  ```

- **Список задач `tasks/index.blade.php`:**
  ```php
  @extends('layouts.app')

  @section('title', 'Список задач')

  @section('content')
      <h2>Задачи</h2>
      <ul>
          @foreach ($tasks as $task)
              <li>
                  <a href="{{ route('tasks.show', $task['id']) }}">{{ $task['title'] }}</a> - {{ $task['status'] }}
              </li>
          @endforeach
      </ul>
  @endsection
  ```

- **Отображение задачи `tasks/show.blade.php`:**
  ```php
  @extends('layouts.app')

  @section('title', 'Детали задачи')

  @section('content')
      <h2>{{ $task['title'] }}</h2>
      <p><strong>Описание:</strong> {{ $task['description'] }}</p>
      <p><strong>Статус:</strong> {{ $task['status'] }}</p>
      <p><strong>Приоритет:</strong> {{ $task['priority'] }}</p>
      <p><strong>Назначено:</strong> {{ $task['assigned_to'] }}</p>
  @endsection
  ```

### 5. Стилизация страниц

- **Создание CSS-файла `public/css/app.css`:**
  ```css
  body {
      font-family: Arial, sans-serif;
      padding: 20px;
      background-color: #f4f4f9;
  }

  header {
      background-color: #2c3e50;
      padding: 10px;
      color: #ecf0f1;
      border-bottom: 1px solid #34495e;
  }

  nav ul {
      list-style: none;
      padding: 0;
  }

  nav li {
      display: inline;
      margin-right: 10px;
  }

  nav a {
      color: #ecf0f1;
      text-decoration: none;
  }

  main {
      margin-top: 20px;
  }
  ```

### Заключение

В ходе выполнения лабораторной работы я изучил основные принципы работы с HTTP-запросами и шаблонизацию в Laravel. Реализовал приложение To-Do App для команд с использованием контроллеров, маршрутов и шаблонов Blade. Приложение теперь позволяет создавать и просматривать задачи с детальной информацией на русском языке.

