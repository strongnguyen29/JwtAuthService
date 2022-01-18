# Hợp Long JWT Authentication Service

Quản lý xác thực nội bộ giữa các service

---

## Cấu hình

```dotenv
    # .env
    
    # Secret key validate admin jwt
    JWT_ADMIN_SECRET_KEY=
    
    # Secret key validate customer jwt
    JWT_CUSTOMER_SECRET_KEY=
```

---
## Api Middleware

Thêm middleware vào $routeMiddleware trong Kernel.php

```php
    // Kernel.php
    $routeMiddleware = [
        'auth.jwt' => \StrongNguyen\JwtAuthService\Http\Middleware\JwtAuthMiddleware::class
    ]; 
```
Sử dụng trong route

```php
    // route/api.php
    Route::middleware('auth.jwt:admin'); // for backend admin
    Route::middleware('auth.jwt:customer'); // for user
```

---
## Truy xuất thông tin JWT claim

#### Admin

```php
    (bool) JwtCustomer::isValid(); // Kiểm tra token tồn tại và có hợp lệ ko
    (array) JwtCustomer::getData(); // Lấy toàn bộ thông tin jwt payload
    (string) JwtCustomer::getFrom(); // Lấy thông tin service gửi
    (string) JwtCustomer::getAppCode(); // Lấy thông tin mã ứng dụng đang yêu cầu
    (int) JwtCustomer::getUserId(); // Lấy thông tin user ID
    (string) JwtCustomer::getUsername(); // Lấy thông tin username
    (string) JwtCustomer::createAdminToken(); // Tạo token test cho admin
```

#### Customer

```php
    (bool) JwtAdmin::isValid(); // Kiểm tra token tồn tại và có hợp lệ ko
    (array) JwtAdmin::getData(); // Lấy toàn bộ thông tin jwt payload
    (string) JwtAdmin::getFrom(); // Lấy thông tin service gửi
    (string) JwtAdmin::getAppCode(); // Lấy thông tin mã ứng dụng đang yêu cầu
    (int) JwtAdmin::getUserId(); // Lấy thông tin user ID
    (string) JwtAdmin::getGroupCode(); // Lấy mã nhóm khách hàng
    (string) JwtAdmin::getCompanyCode(); // Lấy mã khách hàng
    (int) JwtAdmin::getUserCoefficient(); // Lấy hệ số giá hiển thị của user
    (string) JwtAdmin::createCustomerToken(); // Tạo token test cho khách hàng, default: 100
```
