# Instalando o projeto

O projeto se utiliza de contêineres Docker, através do pacote Laravel Sail para facilitar a configuração do ambiente de desenvolvimento. Portanto, é necessário que já possua o Docker e o Docker Compose instalados na máquina.

### Passos para o rodar o projeto localmente:

- Faça um clone do projeto para sua máquina local
```shell
git clone https://github.com/MatheusCavalc/Plane-Tickets
```
- Navegue até o diretório raiz do projeto clonado e execute o comando abaixo para abrir a pasta frontend:
```shell
cd frontend
```
- Execute o comando abaixo para instalar as dependências do frontend:
```shell
npm install
```
- Execute o comando abaixo para compilar e subir o frontend:
```shell
npm run dev
```
- Volte para a raiz do projeto e vá para a pasta backend:
```shell
cd ..
```
```shell
cd backend
```
- Execute o comando abaixo para instalar as dependências do backend:
```shell
composer install
```
- Copie o arquivo .env.example, renomeie para .env e preencha com suas informações de banco de dados e outras configurações relevantes. Você pode fazer isso executando o seguinte comando:
```shell
cp .env.example .env
```
- Gere uma chave de aplicativo Laravel usando o seguinte comando:
```shell
php artisan key:generate
```
- Execute o comando abaixo para popular o banco de dados com as tabelas necessárias para a aplicação:
```shell
php artisan migrate
```
- Para iniciar o servidor do backend execute o comando em um terminal:
```shell
php artisan serve
```
- O servidor do backend deve ter o seguinte endereço:
```shell
http://127.0.0.1:8000/
```

Depois que os comandos acima forem executados, você poderá acessar a aplicação em http://localhost:5173/