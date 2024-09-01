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

    Eu edite o arquivo conforme o necessário, adicionando as credenciais do AWS S3, banco de dados e Google Books.
   | Eu já deixei configurado as envs do banco de dados e do AWS S3 (Minio) ☺️

5. **Inicie o Projeto com Docker Compose:**

    ```bash
    docker compose up --build
    ```

    Este comando inicia todos os serviços definidos no arquivo `docker-compose.yml`.
---

## Possíveis erros 
### Por que o processo do docker compose morre após determinado tempo?

Isso acontece por que o container `minio-create-bucket` tem uma única função, automatizar a criação de um bucket no Minio, e após isso, o seu processo é finalizado, gerendo a mensagem a baixo por conta do seu healthcheck, mas não se preocupe, todos os outros processos continuam normalmente.

> Imagem mostrando o processo morto
    <img width="1792" alt="image" src="https://github.com/user-attachments/assets/35e0fe9e-7774-409c-8d02-c485172b5f63">
> Imagem mostrando os processos funcionando normalmente
    <img width="1087" alt="image" src="https://github.com/user-attachments/assets/e2f39ba7-fea0-4ae4-b1c0-e93a1c130f8b">

### Por que, ao tentar adicionar um livro, eu me deparo com um erro de Api Key Missing?
Ao tentar usar o buscador de livros, o sistema utiliza a Api do Google Books, o mesmo precisa de uma api key única para funcionar, o erro é decorrente a ausência desse key em seu projeto, para contonar o problema, siga os passos:
- Altere a env do projeto
- Salve as novas envs no projeto
  ```bash
    docker compose up app
  ```
- Reinicie o container
>Imagem da mensagem de erro da Api Key
    <img width="1792" alt="image" src="https://github.com/user-attachments/assets/21e066fb-75f7-4c7c-9473-4f80c134d8bb">


8. **Acesse a Aplicação:**

    Abra o navegador e vá para `http://localhost:8080`.

## Api para busca ou cadastro de livro

Abra o navegador e vá para `http://localhost:8080/books/find-isbn?isbn=856583719X`

## Débitos Técnicos
1. **Integração com AWS S3:** A implementação do AWS S3 foi relativamente simples. No entanto, houve dificuldades na busca de livros na Google Books API, especificamente em como obter e utilizar a URL da imagem para enviar e persistir no bucket S3.

2. **Exceções Personalizadas no Laravel:** Enfrentei dificuldades ao lidar com exceções personalizadas no Laravel, principalmente devido a mudanças entre as versões 10 e 11. Não consegui descobrir a tempo como alterar o código de status da exceção conforme necessário.

3. **Env:** Hoje, temos o problema de, uma modificação na env não refletir no projeto, resultando nos passos descritos no erro do S3.

