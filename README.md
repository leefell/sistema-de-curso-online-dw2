
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
