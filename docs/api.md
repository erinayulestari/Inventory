# Inventory System API v1

Base URL

http://localhost:8000/api/v1

---

## Authentication

### Register

POST /register

Body:

```json
{
  "name": "Erin",
  "email": "erin@gmail.com",
  "password": "password",
  "password_confirmation": "password"
}
```

Response:

```json
{
  "success": true,
  "message": "User registered",
  "data": {
    "user": {},
    "token": "..."
  }
}
```

---

### Login

POST /login

Body:

```json
{
  "email": "erin@gmail.com",
  "password": "password"
}
```

Response:

```json
{
  "success": true,
  "message": "Login berhasil",
  "data": {
    "token": "..."
  }
}
```

---

## Categories

### Get All Categories

GET /categories

Header:

Authorization: Bearer {token}

### Create Category

POST /categories

Body:

```json
{
  "name": "Elektronik"
}
```

### Get Category By ID

GET /categories/{id}

### Update Category

PUT /categories/{id}

Body:

```json
{
  "name": "Elektronik Baru"
}
```

### Delete Category

DELETE /categories/{id}

Admin Only

---

## Items

### Get All Items

GET /items

### Get Items By Category

GET /items?category_id={id}

Contoh:

GET /items?category_id=2

Response:

```json
{
  "success": true,
  "message": "Berhasil menarik semua data Item",
  "data": [
    {
      "id": 1,
      "name": "Laptop",
      "quantity": 10,
      "price": 8500000,
      "category_id": 2
    }
  ]
}
```

Jika kategori tidak memiliki item:

```json
{
  "success": true,
  "message": "Berhasil menarik semua data Item",
  "data": []
}
```