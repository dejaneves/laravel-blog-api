# APIs de blog em PHP usando MongoDB

> Esse projeto tem como finalidade as seguintes ações:

1. Exibir uma lista de posts, autores e seus comentários.
2. Exibir um único post sendo identificado pelo seu ID, autor e os comentários do post.
3. Criar um novo post

## Pré-requisitos

* [Composer](https://getcomposer.org/download/)
* [Docker](https://docs.docker.com/)

## Instalação e Configuração

### Clonando o projeto

```bash
$ git clone https://github.com/dejaneves/api-blog-php.git
```

### Executando o Projeto

Após baixar o projeto entre na pasta `api-blog-php`.

```bash
$ cd api-blog-php
```
abra o arquivo `.env` e verifique se a variável *DB_HOST*, deixe assim: `DB_HOST=mongodb`. 


```bash
$ docker-compose up -d
```

**Importante**
Se o docker da sua máquina estiver para o usuário *root* não esqueça de acrescentar o comando *sudo* : 

Exemplo:

`sudo docker-compose up -d`

OBS.: a opção `-d` é para aplicação rodar em background.

## Rotas *(end-points)*

Todas as rotas criadas para o projeto se encontram no diretório `routes/api.php`.

### Exibir todos os posts.

```http
GET:

http://localhost:8080/api/v1/posts
```

### Exibir um post passando como paramentro seu {ID}.
```http
GET:

http://localhost:8080/api/v1/posts/:id
```

### Criar um novo post.

```http
POST:

http://localhost:8080/api/v1/posts
```

#### Exemplo:

Cria um novo post passando um autor que já existe no banco de dados.

```javascript

{
  "title": "Lorem ipsum dolor sit amet.",
  "body": "Quisque at tristique sem. Vestibulum a pellentesque metus.",
  
  // ID do autor cadastrado no seu banco de dados
  "author_id" : 10
}
```

Cria um novo post, mas adicionando um novo autor.

```javascript

{
  "title": "Lorem ipsum dolor sit amet.",
  "body": "Quisque at tristique sem. Vestibulum a pellentesque metus.",

  // Dados do novo autor
  "author_name":"Jaime Neves",
  "author_username":"jaimeneves",
  "author_email":"jaime@gmail.com",
  "author_phone":"92 981255658",
  "author_website":"jaimeneves.com.br"
}
```

Na hora de inserir um novo post o método checa se existe uma *key* chamada **author_id** se ela for encontrada no corpo da requisição, o método não checa os outros dados do autor e pega o valor dessa *key* como sendo o próprio autor do post.

