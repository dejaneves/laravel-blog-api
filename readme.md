# APIs de blog em PHP usando MongoDB

> Esse projeto tem como finalidade as seguintes ações:

1. Exibir uma lista de posts, autores e seus comentários.
2. Exibir um único post sendo identificado pelo seu ID, autor e os comentários do post.
3. Criar um novo post

## Pré-requisitos

Para executar esse projeto algumas tecnologias precisam já está instalada na sua máquina, são elas:

* MongoDB
* Composer
* PHP 7.2.16
* Laravel Framework para acesso aos dados no MongoDB

## Instalação e Configuração


### Clonando o projeto

```bash
$ git clone https://github.com/dejaneves/api-blog-php.git
```

### Instalando as Dependêcias

Após baixar o projeto entre na pasta `api-blog-php`.

```bash
$ cd api-blog-php
```
e execute o sequinte comando, para instalar as dependências.

```bash
$ composer install
```

### Configurando sua base de dados

Vá para o arquivo que se encontra em `config/database.php` na seção *connections* e altera as configurações do **mongodb** de acordo com as configuraçõs locais do seu banco.

```php

'mongodb' => [
  'driver'   => 'mongodb',
  'host'     => env('DB_HOST', '127.0.0.1'),
  'port'     => env('DB_PORT', 27017),
  'database' => env('DB_DATABASE', 'blog'),
  'username' => env('DB_USERNAME'),
  'password' => env('DB_PASSWORD'),
  'options' => [
      'db' => 'admin' // Sets the authentication database required by mongo 3
  ]
],

```

### Executando o Projeto

```bash
$ php artisan serve
```

## Rotas *(end-poinst)*

#### Exibir todos os posts.

```http
GET:

/api/v1/posts
```

#### Exibir um post passando como paramentro seu {ID}.
```http
GET:

/api/v1/posts/:id
```

#### Criar um novo post.

```http
POST:

/api/v1/posts
```


## Tecnologias e Ferramanetas Usadas

* MongoDB
* PHP 7.2.16
* Laravel Framework
* Composer