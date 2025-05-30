# Configuração do Ambiente e Instalação - Sistema de Cursos Online

## Pré-requisitos

* **PHP** (versão >= 8.1, conforme compatibilidade do Laravel utilizado)
* **Composer** (gerenciador de dependências para PHP)
* **Node.js** e **NPM** (ou Yarn) (para dependências de frontend e compilação de assets)
* **PostgreSQL** (servidor de banco de dados)
* **Git** (para clonar o repositório)

## Passos para Instalação

1.  **Clonar o Repositório:**
    ```bash
    git clone <URL_DO_SEU_REPOSITORIO_GIT> sistema-cursos-online
    ```

2.  **Navegar para o Diretório do Projeto:**
    ```bash
    cd sistema-cursos-online
    ```

3.  **Instalar Dependências do PHP (Composer):**
    ```bash
    composer install
    ```

4.  **Instalar Dependências do Frontend (NPM/Yarn):**
    ```bash
    npm install
    ```

5.  **Configurar o Arquivo de Ambiente (.env):**
    Copie o arquivo de exemplo `.env.example` para um novo arquivo chamado `.env`. Este arquivo conterá as configurações específicas do seu ambiente.
    ```bash
    cp .env.example .env
    ```

6.  **Gerar a Chave da Aplicação Laravel:**
    ```bash
    php artisan key:generate
    ```

7.  **Configurar o Banco de Dados no Arquivo `.env`:**

    ```env
    DB_CONNECTION=pgsql
    DB_HOST=localhost
    DB_PORT=5432
    DB_DATABASE=sistemacursos
    DB_USERNAME=postgres
    DB_PASSWORD=postdba
    ```
    * 
        ```sql
        CREATE DATABASE sistemacursos;
        ```

8.  **Executar as Migrations do Banco de Dados:**
    As migrations criam as tabelas necessárias no seu banco de dados. 
    ```bash
    php artisan migrate
    ```

9.  **Criar o Link Simbólico para o Storage:**
    ```bash
    php artisan storage:link
    ```

10. **Compilar os Assets de Frontend (CSS/JS):**
        ```bash
        npm run dev
        ```

11. **Iniciar o Servidor de Desenvolvimento Laravel:**
    ```bash
    php artisan serve
    ```
