# Xcoop Challenge

Challenge técnico para proceso de selección de la empresa Xcoop, realizado con Laravel 7, PHP 7.2 y un paquete de cigarrillos Chesterfield.

## Instalar las dependencias

```
composer install
```

## Copiar y renombrar archivo de variables de entorno

```
cp .env.example .env
```

## Configurar base de datos

En este caso utilice una base de datos MYSQL, para la cual cree un seeder y un factory de clientes y vouchers para generar todos los datos de prueba necesarios.

Una vez configurada correctamente la DB, correr el siguiente comando para levantar las migraciones y los seeders:

```
php artisan migrate --seed
```

## Endpoints del API 

En mi caso creé un virtual host para apuntar a la raiz de la API en **http://xcoop-challenge/api**, pero para comenzar rápidamente también se puede correr el comando **php artisan serve** para crear un servidor local en **http;//localhost:8000/api**

### Check Voucher

Suponiendo que se esta usando la segunda opción en el punto anterior, el primer endpoint se verá de la siguiente forma:

```
http://localhost:8000/api/vouchers/check?hash=XXXXX
```

**Parametros:** hash (El código hash del voucher)

**Valores de retorno:** Información que indica si el voucher ha vencido o no, además del objeto del voucher en sí.

### Get Client Vouchers

```
http://localhost:8000/api/client/{legal_doc}/vouchers
```

**Parametros:** legal_doc (El documento legal del cliente, disponible en la tabla clients como "legal_doc")

**Valores de retorno:** Información del cliente y sus vouchers relacionados


