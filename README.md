## Proyecto Layer 7

### Rama principal: master

### Instalar dependencias:

```
composer install
```

### Para correr los assets del proyecto:

```
npm install && npm run dev
```

### Para que los archivos css y js esten en produccion:

```
npm run build
```

### Para generar la llave necesaria

```
php artisan key:generate
```

### Para copiar el environment

```
cp .env.example .env
```

### Para correr las pruebas:

```
php artisan test
```

### Para correr las migraciones y los seeders:

```
php artisan migrate
php artisan db:seed
```

### Usuario por defecto en el seeder test@example.com.
