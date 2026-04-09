# AGB Marketing ù contexto para agentes

- Stack: PHP puro, JS vanilla, Tailwind (build local).
- Documentos de marca na raiz: `AGB_Guia_da_Marca.pdf`, `AGB_BrandKit_v2.pdf`.
- Paleta: Burgundy `#6E0F2F`, Burgundy escuro `#4A0A20`, Gold `#D8BC67`, Ivory `#F7F2ED` / `#F6F1EC`, Charcoal `#2E2A33`, Soft `#E9E1DA`.
- Tipografia sugerida: Montserrat (tùtulos), Lato (corpo) ù carregadas via Google Fonts no layout.
- Entrada web: pasta `public/` (document root). Admin: `/admin`.
- Banco: migrations versionadas em `database/migrations/` + tabela `schema_migrations`. CLI: `php bin/migrate.php`. UI (sÛ admin): `/admin/database` (desligar com `DB_ADMIN_ENABLED=false` em produÁ„o).
- Exemplo produÁ„o: `.env.production.example`.
