# Clurook 🇧🇷

Este projeto é uma aplicação Laravel que utiliza Docker Compose para facilitar o desenvolvimento e a implantação. O projeto inclui funcionalidades para integração com AWS S3 e busca de livros no Google Books API.

## Como Iniciar o Projeto

1. **Clone o Repositório:**

    ```bash
    git clone https://github.com/Casmei/tecnovix-teste.git
    ```
    Clone o projeto do Github

    ```bash
    cd tecnovix-teste
    ```
    Entre na pasta gerada

3. **Configure o Ambiente:**

    ```bash
    cp .env.example .env
    ```
   Crie um arquivo `.env` a partir do arquivo de exemplo fornecido.

    Edite o arquivo `.env` conforme necessário para ajustar configurações específicas, como credenciais do AWS S3, detalhes do banco de dados e as credenciais do google api.
   | Eu já deixei configurado as envs do banco ☺️

5. **Inicie o Projeto com Docker Compose:**

    ```bash
    docker compose up --build
    ```

    Este comando inicia todos os serviços definidos no arquivo `docker-compose.yml`.

6. **Preparando o ambiente:**

    ```bash
    docker exec -it laravel_app bash
    ```
    Para entrar dentro do container da aplicação

    ```bash
    composer install
    ```
    Instalar as dependências do Laravel

    ```bash
    php artisan migrate --seed
    ```
    Realizar as migrações das tabelas para o banco e popula-lo com dados falsos
   
8. **Acesse a Aplicação:**

    Abra o navegador e vá para `http://localhost:8080`.

## Api para busca ou cadastro de livro

Abra o navegador e vá para `http://localhost:8080/books/find-isbn?isbn=856583719X`

## S3 ERRO
Caso você tenha seguido todas os passos corretamente, mas ainda sim, ao tentar acessar a página se deparou com o erro a baixo, não se preocupe (ou me desqualifique rsrs), isso acontece pois as credenciais de acesso da AWS para o S3 não foram configuradas, para isso, basta entrar no `.env` e alterar os dados nas envs corretas.


Caso você tenha alterado as envs, porém o erro continua, talvez seja por que o laravel tenha realizado cache desses dados, para resolver esse problema, siga os passos a baixo:
```bash
docker exec -it laravel_app bash
```
Para entrar dentro do container da aplicação

```bash
php artisan config:cache
```
Para criar um snapshot das configurações atuais

```bash
php artisan cache:clear
```
Para limpar as configurações 

Pronto, com esses passos, o Laravel vai olhar para os novos dados inseridos na env!

> Imagem do erro
![image](https://github.com/user-attachments/assets/b598c22a-1261-46ae-aa7b-a692a763fff8)

## Débitos Técnicos
1. **Integração com AWS S3:** A implementação do AWS S3 foi relativamente simples. No entanto, houve dificuldades na busca de livros na Google Books API, especificamente em como obter e utilizar a URL da imagem para enviar e persistir no bucket S3.

2. **Exceções Personalizadas no Laravel:** Enfrentei dificuldades ao lidar com exceções personalizadas no Laravel, principalmente devido a mudanças entre as versões 10 e 11. Não consegui descobrir a tempo como alterar o código de status da exceção conforme necessário.

3. **Env:** Hoje, temos o problema de, uma modificação na env não refletir no projeto, resultando nos passos descritos no erro do S3.

