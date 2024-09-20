# Отчет по лабораторной работе

## Задание 1: Анализ HTTP-запросов

### 1. Анализ запросов с неверными данными

- **Метод HTTP**: `POST`
- **Заголовки запроса**:
  - `accept: */*`
  - `accept-encoding: gzip, deflate`
  - `accept-language: ru,en;q=0.9,ru-RU;q=0.8`
  - `content-type: application/x-www-form-urlencoded; charset=UTF-8`
  - `referer: http://sandbox.usm.md/login/`
  - `user-agent: Mozilla/5.0 ...`
  - `x-requested-with: XMLHttpRequest`
- **Параметры запроса**:
  - `username: student`
  - `password: studentpass`
- **Код состояния**: `401 Unauthorized`
- **Заголовки ответа**:
  - `connection: keep-alive`
  - `content-type: text/plain;charset=UTF-8`
  - `date: Fri, 20 Sep 2024 ...`
  - `server: nginx/1.24.0 (Ubuntu)`
  - `transfer-encoding: chunked`

### 2. Анализ запросов с правильными данными

- **Метод HTTP**: `POST`
- **Заголовки запроса**:
  - `accept: */*`
  - `accept-encoding: gzip, deflate`
  - `accept-language: ru,en;q=0.9,ru-RU;q=0.8`
  - `content-type: application/x-www-form-urlencoded; charset=UTF-8`
  - `referer: http://sandbox.usm.md/login/`
  - `user-agent: Mozilla/5.0 ...`
  - `x-requested-with: XMLHttpRequest`
- **Параметры запроса**:
  - `username: admin`
  - `password: password`
- **Код состояния**: `200 OK`
- **Заголовки ответа**:
  - `connection: keep-alive`
  - `content-type: text/plain;charset=UTF-8`
  - `date: Fri, 20 Sep 2024 ...`
  - `server: nginx/1.24.0 (Ubuntu)`
  - `transfer-encoding: chunked`

## Задание 2: Составление HTTP-запросов

### 1. GET-запрос к серверу

GET / HTTP/1.1  
Host: sandbox.com  
User-Agent: Михаил Червоный  

### 2. POST-запрос к серверу

POST /cars HTTP/1.1  
Host: sandbox.com  
Content-Type: application/x-www-form-urlencoded  

make=Toyota&model=Corolla&year=2020  

### 3. PUT-запрос к серверу

PUT /cars/1 HTTP/1.1  
Host: sandbox.com  
User-Agent: Михаил Червоный  
Content-Type: application/json  

{  
  "make": "Toyota",  
  "model": "Corolla",  
  "year": 2021  
}  

### 4. Вариант ответа сервера на POST-запрос

HTTP/1.1 201 Created  
Content-Type: application/json  
Location: http://sandbox.com/cars/1  

{  
  "message": "Car created successfully.",  
  "car": {  
    "make": "Toyota",  
    "model": "Corolla",  
    "year": 2020,  
    "id": 1  
  }  
}  

### 5. Возможные ситуации для HTTP-кодов состояния

- **200 OK**: Запрос был успешно выполнен.
- **201 Created**: Ресурс был успешно создан.
- **400 Bad Request**: Неверный синтаксис запроса.
- **401 Unauthorized**: Требуются учетные данные.
- **403 Forbidden**: Нет прав доступа к ресурсу.
- **404 Not Found**: Запрашиваемый ресурс не найден.
- **500 Internal Server Error**: Ошибка на стороне сервера.

