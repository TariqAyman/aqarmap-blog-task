Simple Blog Symfony
======

### Installation Procedure

Install the vendors of the project running:

```sh
composer install
```

Create database, schema and default datafixtures:

```sh
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```

Now run the server:

```sh
symfony server:start
```

you can browse the site in http://localhost:8000

**Enjoy developing!**
