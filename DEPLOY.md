# Deploy em produção — AGB Marketing (site)

Passo a passo para publicar o projeto num servidor com PHP e MySQL (ex.: hospedagem compartilhada tipo Hostinger).

## Pré-requisitos no servidor

- **PHP 8.2+** com extensões usuais (`pdo_mysql`, `mbstring`, `json`, `session`, etc.).
- **MySQL / MariaDB** com uma base de dados já criada (no painel da hospedagem).
- **Node.js** apenas na sua máquina local (ou numa CI) para gerar o CSS — não é obrigatório no servidor se você enviar o ficheiro `public/assets/css/app.css` já compilado.

## 1. Base de dados

1. No painel da hospedagem, crie a base e o utilizador MySQL (ou use os que já existem).
2. Anote: **host** (muitas vezes `127.0.0.1` ou `localhost` quando o PHP corre no mesmo servidor), **porta** (geralmente `3306`), **nome da base**, **utilizador** e **palavra-passe**.
3. **Não** precisa importar SQL manualmente se for usar migrations (passo 5).

## 2. Ficheiros no servidor

1. Envie o projeto completo (FTP, SFTP, Git deploy, etc.), mantendo a estrutura de pastas.
2. O **document root** do domínio deve apontar para a pasta **`public/`** (não para a raiz do repositório).
   - Em Apache, use o `.htaccess` já existente em `public/`.
   - Em Nginx, configure `root` para `.../public` e `try_files` para `index.php` conforme o teu snippet habitual para PHP.

## 3. Variáveis de ambiente (`.env`)

O PHP carrega **`/.env`** na raiz do projeto (ao lado de `app/`, `public/`, `bootstrap.php`). O ficheiro **`.env.production`** no repositório é só referência local — **no servidor o nome tem de ser `.env`**.

1. Na raiz do projeto no servidor, crie o ficheiro **`.env`**.
2. Copie o conteúdo de **`.env.production.example`** ou do teu **`.env.production` local** e ajuste:
   - `APP_URL` — URL pública do site, com `https://`.
   - `APP_DEBUG=false` e `APP_ENV=production`.
   - `DB_*` — host, base, utilizador e palavra-passe reais.
   - Se a palavra-passe tiver caracteres especiais (ex.: `@`), podes envolvê-la em aspas: `DB_PASSWORD="..."`.
   - `MAIL_*` e `SMTP_*` — e-mail de envio e destino dos leads (`MAIL_LEAD_TO`).

3. Garante que **`.env` não é acessível pela web** (com document root em `public/`, o `.env` fica fora e não deve ser servido).
4. Define **`DEPLOY_SETUP_TOKEN`** (um segredo longo, ex.: `openssl rand -hex 24`). É usado só pelo script de setup inicial (`public/deploy-setup.php`).

## 3.1 Deploy via Git (ex.: Hostinger) + base de dados num único passo

Fluxo típico quando o repositório liga ao servidor e o **document root** aponta para `public/`:

1. **Ligar o repositório Git** no painel (Deploy / Git) para a pasta do site.
2. Criar/editar o ficheiro **`.env` na raiz do projeto** (não dentro de `public/`), com `DB_*`, `APP_URL`, `MAIL_*` e **`DEPLOY_SETUP_TOKEN`** preenchido.
3. **Antes do primeiro acesso público**, na tua máquina, compila o CSS e faz commit do ficheiro gerado:
   ```bash
   npm install && npm run build:css
   git add public/assets/css/app.css && git commit -m "build:css" && git push
   ```
4. Abre **uma única vez** no browser (ou usa SSH se existir):
   ```text
   https://seudominio.com.br/deploy-setup.php?token=O_MESMO_DEPLOY_SETUP_TOKEN_DO_ENV
   ```
   O script:
   - testa a ligação MySQL;
   - aplica **todas as migrations** pendentes;
   - corre o **seed** (admin `andrebaggio25@outlook.com`, settings, secções, páginas base);
   - cria o ficheiro **`.deploy_setup_complete`** na raiz para **não voltar a executar** por acidente.

5. **Segurança:** altera a password do admin, remove ou esvazia `DEPLOY_SETUP_TOKEN` no `.env`, e (opcional) apaga `public/deploy-setup.php` quando já não precisares.

**Repetir o setup** (novas migrations após um pull): apaga `.deploy_setup_complete` na raiz **ou** chama  
`deploy-setup.php?token=...&force=1` (ou CLI `php public/deploy-setup.php --token=... --force`).

**Nota:** o script **não cria** a base MySQL — a base tem de existir no painel da hospedagem.

## 4. CSS (Tailwind)

Antes de enviar ou no pipeline de deploy:

```bash
npm install
npm run build:css
```

Confirma que existe **`public/assets/css/app.css`** atualizado no servidor.

## 5. Migrations e seed (alternativa manual)

Se **não** usares `deploy-setup.php`, na **raiz do projeto** (com PHP CLI):

```bash
php bin/migrate.php
php bin/seed.php
```

- Use uma base **vazia** ou dedicada: conflitos com tabelas antigas (ex.: `users`) podem quebrar FKs.
- O **seed** cria utilizador admin inicial e conteúdo base — altera a password do admin em produção.

Se o plano **não tiver SSH/CLI** e não quiseres abrir `deploy-setup.php`, podes usar **`DB_ADMIN_ENABLED=true`**, aplicar migrations em **Admin → Banco de dados**, depois `DB_ADMIN_ENABLED=false` (o seed terá de ser feito por CLI ou outro meio).

## 6. Permissões e uploads

- Pasta **`public/uploads/`** deve ser gravável pelo utilizador do servidor web (para mídia no admin).
- Verifica que `public/uploads/.htaccess` (se existir) continua a impedir execução de scripts onde aplicável.

## 7. Segurança pós-deploy

1. Confirme a password do utilizador admin (definida no seed em `SeedService`).
2. Confirma **`APP_DEBUG=false`** em produção.
3. Recomenda-se **`DB_ADMIN_ENABLED=false`** depois de todas as migrations aplicadas (desativa o painel `/admin/database`).
4. Mantém **`.env`** e **`.env.production` local** fora do Git (já estão no `.gitignore`).

## 8. Verificação

- Site público: o valor de `APP_URL` (ex.: `https://agbmarketing.com.br`)
- Admin: mesma origem + `/admin`
- Formulário de contacto na landing e receção de e-mail (`MAIL_LEAD_TO` / SMTP).

## Checklist rápido

| Item                         | Feito |
|-----------------------------|-------|
| Document root → `public/`   | ☐     |
| `.env` no servidor          | ☐     |
| `APP_URL` e `DB_*` corretos | ☐     |
| `npm run build:css`         | ☐     |
| `deploy-setup.php?token=…` ou `migrate`+`seed` | ☐     |
| Password admin alterada     | ☐     |
| `DB_ADMIN_ENABLED=false`    | ☐     |
| Teste de lead + e-mail      | ☐     |
