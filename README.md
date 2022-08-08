# Sistema de Enquetes

Feito com [Laravel](https://laravel.com/), [TailwindCSS](https://tailwindcss.com/) e [Docker](https://www.docker.com/)

## Rodar Localamente

Clone o repositorio e copie o arquivo .env.example para .env.

```
git clone https://github.com/luanfstack/laravote.git

cd laravote/

cp .env.example .env
```

Adicione as chaves do [Pusher](https://pusher.com/) no arquivo .env

```
PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=
```

Instale as dependencias e empacote o CSS/JS

```
composer install

npm install

npm run build
```

Suba os containers e roda as migrações

```
./vendor/bin/sail up

docker exec -i <CONTAINER ID> php artisan migrate
```
