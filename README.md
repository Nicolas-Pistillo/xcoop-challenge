# Xcoop Challenge

Challenge técnico para proceso de selección de la empresa Xcoop, realizado con Laravel 9 y PHP 8.

## Instalar las dependencias

```
composer install
```

## Copiar y renombrar archivo de variables de entorno

```
cp .env.example .env
```

## Configurar base de datos

En este caso utilice una base de datos MYSQL, para la cual cree un seeder y un factory de clientes y vouchers para generar todos los datos de prueba necesarios. Mas especificamente el seeder generará 20 clientes los cuales poseen 4 vouchers cada uno.

Una vez configurada correctamente la DB, correr el siguiente comando para levantar las migraciones y los seeders:

```
php artisan migrate --seed
```

## Endpoints del API 

En mi caso creé un virtual host para apuntar a la raiz de la API en **http://xcoop-challenge/api**, pero para comenzar rápidamente también se puede correr el comando **php artisan serve** para crear un servidor local en **http;//localhost:8000/api**

Para esta ocación, decidi proteger la ruta de vouchers de un cliente usando un metodo de autenticación basado en JWT (JSON Web Tokens).

### Check Voucher

Suponiendo que se esta usando la segunda opción en el punto anterior, este primer endpoint que no requiere autenticación por JWT se encargara de devolver el estado activo de un voucher, y se verá de la siguiente forma:

```
http://localhost:8000/api/vouchers/check?hash=XXXXX
```

**Parametros:** hash (El código hash del voucher)

**Valores de retorno:** Información que indica si el voucher ha vencido o no, además del objeto del voucher en sí.

### Create Token

```
http://localhost:8000/api/auth/token
```

**Parametros:** legal_doc y PIN de 4 digitos del cliente

**Valores de retorno:** Si estas 2 credenciales son correctas, se retornara un token JWT

### Get Client Vouchers

```
http://localhost:8000/api/client/vouchers
```

**Parametros:** Ninguno

**Authorization:** Se debe enviar el token generado en el endpoint **Create Token** como un token Bearer en el encabezado de autorizacion. Este token estara asociado directamente con el cliente que nos interesa.

**Valores de retorno:** Información del cliente y sus vouchers relacionados


