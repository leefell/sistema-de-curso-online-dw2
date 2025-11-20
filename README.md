
# Configuração do Ambiente e Instalação - Sistema de Cursos Online

## Pré-requisitos

* **PHP** (versão **>= 8.2**)
* **Composer** (gerenciador de dependências para PHP)
* **Node.js** e **NPM** (para dependências de frontend e compilação de assets)
* **PostgreSQL** (servidor de banco de dados)
* **Git** (para clonar o repositório)
* **Apache2** (servidor web usado em produção)

## Passos para Instalação

1. **Clonar o Repositório:**
   ```bash
   git clone https://github.com/leefell/sistema-de-curso-online-dw2.git
   cd sistema-de-curso-online-dw2
   ```

2. **Instalar Dependências PHP:**
   ```bash
   composer install
   ```

3. **Instalar Dependências Frontend:**
   ```bash
   npm install
   ```

4. **Copiar o arquivo `.env` e configurar:**
   ```bash
   cp .env.example .env
   ```

5. **Gerar a chave da aplicação:**
   ```bash
   php artisan key:generate
   ```

6. **Configurar o banco de dados no arquivo `.env`:**
   ```env
   DB_CONNECTION=pgsql
   DB_HOST=localhost
   DB_PORT=5432
   DB_DATABASE=sistemacursos
   DB_USERNAME=postgres
   DB_PASSWORD=postdba
   ```

7. **Criar o banco no PostgreSQL:**
   ```sql
   CREATE DATABASE sistemacursos;
   ```

8. **Executar as migrations:**
   ```bash
   php artisan migrate --force
   ```

9. **Criar link simbólico para arquivos públicos do storage:**
   ```bash
   php artisan storage:link
   ```

10. **Compilar os assets de frontend:**
    ```bash
    npm run build
    ```

11. **Permissões (necessário em ambiente Linux):**
    ```bash
    sudo chown -R www-data:www-data storage/ bootstrap/cache
    sudo chmod -R 775 storage/ bootstrap/cache
    ```

## Considerações para Produção (ex: EC2 com Apache)

* Aponte o **DocumentRoot** do Apache para o diretório `public/`.
* Após reiniciar a máquina, somente o Apache precisa estar rodando.
* Não é necessário rodar `npm run dev` ou `php artisan serve` em produção.
* O conteúdo do build frontend (`npm run build`) fica em `public/`, onde o Apache acessa normalmente.

## Como Rodar o Projeto (Usando Docker)

Este projeto utiliza Docker e Docker Compose para facilitar a configuração do ambiente de desenvolvimento local e também para implantação em servidores como EC2.

### Pré-requisitos

*   Certifique-se de ter o Docker e o Docker Compose instalados e em execução em sua máquina.

### Configuração e Execução

Siga os passos abaixo para colocar o projeto em funcionamento:

1.  **Crie o arquivo de ambiente:**
    ```bash
    cp .env.example .env
    ```
    *O arquivo `.env.example` já está configurado com os padrões do Docker Compose e do PostgreSQL. Você só precisará editar o `APP_URL` e `APP_KEY` após o passo 4.*

2.  **Construa as imagens e inicie os serviços:**
    ```bash
    docker-compose up -d --build
    ```
    Este comando irá construir as imagens Docker e iniciar os contêineres para a aplicação Laravel (Apache/PHP) e o banco de dados PostgreSQL em segundo plano.

3.  **Configure a aplicação Laravel:**

    *   **Gere a chave da aplicação (APP_KEY):**
        ```bash
        docker-compose exec app php artisan key:generate
        ```
        Este comando é **essencial** para a segurança da sua aplicação e irá preencher `APP_KEY` no seu arquivo `.env`.

    *   **Execute as migrações do banco de dados:**
        ```bash
        docker-compose exec app php artisan migrate
        ```
        Este comando criará todas as tabelas necessárias no seu banco de dados.

### Acessar a Aplicação

Após todos os passos acima, sua aplicação estará acessível:

*   **Localmente:** Em seu navegador, vá para `http://localhost`.
*   **Na AWS EC2:** Acesse o endereço IP público da sua instância EC2. Lembre-se de verificar se o Security Group da sua instância permite tráfego na **porta 80 (HTTP)**.

