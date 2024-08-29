# Projeto Laravel com Docker

Este projeto é uma aplicação Laravel que utiliza Docker Compose para facilitar o desenvolvimento e a implantação. O projeto inclui funcionalidades para integração com AWS S3 e busca de livros no Google Books API.

## Como Iniciar o Projeto

1. **Clone o Repositório:**

    ```bash
    git clone https://github.com/Casmei/tecnovix-teste.git
    cd tecnovix-teste
    ```

2. **Certifique-se de que os seguintes requisitos estão instalados:**
    - [Docker](https://www.docker.com/)

3. **Configure o Ambiente:**

    Crie um arquivo `.env` a partir do arquivo de exemplo fornecido:

    ```bash
    cp .env.example .env
    ```

    Edite o arquivo `.env` conforme necessário para ajustar configurações específicas, como credenciais do AWS S3, detalhes do banco de dados e as credenciais do google api.
   | Eu já deixei configurado as envs do banco ☺️

5. **Inicie o Projeto com Docker Compose:**

    ```bash
    docker compose up --build
    ```

    Este comando inicia todos os serviços definidos no arquivo `docker-compose.yml`.

6. **Preparando o banco:**

    ```bash
    docker exec -it laravel_app bash
    php artisan migrate --seed
    ```

7. **Acesse a Aplicação:**

    Abra o navegador e vá para `http://localhost:8080`.

## Api para busca ou cadastro de livro

Abra o navegador e vá para `http://localhost:8080/books/find-isbn?isbn=856583719X`

## Débitos Técnicos

1. **Integração com AWS S3:** A implementação do AWS S3 foi relativamente simples. No entanto, houve dificuldades na busca de livros na Google Books API, especificamente em como obter e utilizar a URL da imagem para enviar e persistir no bucket S3.

2. **Exceções Personalizadas no Laravel:** Enfrentei dificuldades ao lidar com exceções personalizadas no Laravel, principalmente devido a mudanças entre as versões 10 e 11. Não consegui descobrir a tempo como alterar o código de status da exceção conforme necessário.

3. **Swagger:** Tentei configurar o Swagger para documentação da API, mas encontrei problemas técnicos. Decidi priorizar a entrega inicial e realizar ajustes adicionais após a entrega.

## Vou Implementar

- **Documentação com Swagger:** Resolver os problemas encontrados com o Swagger e configurar a documentação da API para facilitar a utilização e o entendimento da API.
