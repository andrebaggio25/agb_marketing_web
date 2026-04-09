# AGB Marketing — site institucional

Site em **PHP** (sem framework), **JavaScript** vanilla e **Tailwind CSS**, com landing de captação e painel administrativo (páginas, blog, mídia, leads, usuários, configurações e seções editáveis da home).

## Requisitos

- PHP 8.2+
- MySQL 8+ (ou MariaDB compatível)
- Node.js 18+ (apenas para compilar o CSS do Tailwind)

## Configuração

1. Copie `.env.example` para `.env` e ajuste banco de dados, `APP_URL` e e-mail (`MAIL_LEAD_TO` para receber leads).

2. Crie o banco (MySQL) e rode as migrations:

```bash
mysql -u root -p -e "CREATE DATABASE IF NOT EXISTS agb_marketing CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
php bin/migrate.php
php bin/seed.php
```

Use uma base **vazia** ou dedicada a este projeto: se já existir uma tabela `users` de outro sistema com estrutura diferente, o `CREATE TABLE IF NOT EXISTS` não a substitui e as FKs podem falhar.

3. Exemplo de variáveis para produção: copie [`.env.production.example`](.env.production.example) como referência ao montar o `.env` no servidor.

4. **Gerenciamento do banco pela interface:** após logar como administrador, acesse **Admin → Banco de dados** (`/admin/database`) para ver conexão, tabelas (estimativa de linhas) e **aplicar migrations pendentes**. Em produção, defina `DB_ADMIN_ENABLED=false` no `.env` após as migrations, se quiser desativar essa tela.

5. Instale dependências Node e gere o CSS:

```bash
npm install
npm run build:css
```

6. Servidor de desenvolvimento (PHP embutido):

```bash
cd public && php -S localhost:8080 router.php
```

Acesse `http://localhost:8080`. Painel: `http://localhost:8080/admin` — após o seed, o admin é `andrebaggio25@outlook.com` (definido em `SeedService`).

## Produção

- Aponte o **document root** do servidor web para a pasta `public/`.
- Use Apache com `AllowOverride` para o `.htaccess` ou configure Nginx com `try_files` para `index.php`.
- Mantenha `APP_DEBUG=false` e credenciais fortes.
- **Setup após Git:** com `DEPLOY_SETUP_TOKEN` no `.env`, abra uma vez `https://seudominio.com.br/deploy-setup.php?token=...` para aplicar migrations e seed (ver [DEPLOY.md](DEPLOY.md)).

## Documentação de marca

PDFs na raiz do projeto: `AGB_Guia_da_Marca.pdf`, `AGB_BrandKit_v2.pdf`. Substitua `/assets/img/logo-mark.svg` e configure `logo_path` / `favicon_path` em **Admin → Configurações** após enviar os PNGs em **Mídia**.
