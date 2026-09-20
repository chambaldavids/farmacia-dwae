# Sistema de Gestão de Farmácia (DWAE — Avaliação III)

Sistema Web empresarial para gestão de uma farmácia: medicamentos, categorias,
fornecedores, clientes e vendas, com autenticação de utilizadores, CRUD completo,
base de dados relacional, interface responsiva, validação de formulários e
controlo de erros.

- **Estudante:** 21241251
- **Curso:** Gestão de Sistemas de Informação — UniSCED
- **Disciplina:** Desenvolvimento de Aplicativos Web Empresariais (DWAE)
- **Tecnologia:** PHP 8.2+ / Laravel 11 / MySQL / Bootstrap 5

## Estrutura deste repositório

Este repositório contém apenas os ficheiros **específicos da aplicação**
(Models, Controllers, Requests, Migrations, Seeders, rotas e views). O
esqueleto do Laravel (ficheiros de configuração, bootstrap, `public/index.php`,
etc.) é gerado pelo instalador oficial do Laravel, conforme os passos abaixo —
é assim que qualquer projeto Laravel é normalmente iniciado.

```
app/
  Models/                Categoria, Fornecedor, Medicamento, Cliente, Venda, ItemVenda, User
  Http/Controllers/      Controllers de CRUD + Auth
  Http/Requests/         Form Requests (validação)
database/
  migrations/            Criação das tabelas
  seeders/                Dados iniciais (utilizador admin + exemplos)
routes/web.php           Rotas da aplicação
resources/views/         Blade templates (layout + CRUD de cada entidade)
```

## Como correr o projeto localmente

### 1. Pré-requisitos
- PHP >= 8.2, Composer, MySQL (ou MariaDB), Node.js (opcional, só para assets)

### 2. Criar o esqueleto Laravel e copiar os ficheiros deste projeto
```bash
composer create-project laravel/laravel:^11.0 farmacia-dwae
cd farmacia-dwae
```
Copiar as pastas `app/`, `database/`, `routes/` e `resources/views/` deste
repositório para dentro do projeto Laravel recém-criado, substituindo os
ficheiros por defeito (ex.: `routes/web.php`).

### 3. Configurar o ambiente
```bash
cp .env.example .env
php artisan key:generate
```
Editar `.env` e configurar a ligação à base de dados MySQL:
```
DB_CONNECTION=mysql
DB_DATABASE=farmacia_dwae
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Criar a base de dados e correr as migrações + seeders
```bash
php artisan migrate --seed
```
Isto cria todas as tabelas e insere:
- Um utilizador administrador: **email:** `admin@farmacia.co.mz` / **password:** `password`
- Categorias, fornecedores e medicamentos de exemplo

### 5. Instalar assets front-end (opcional — o layout usa Bootstrap via CDN)
```bash
npm install && npm run build
```

### 6. Arrancar o servidor
```bash
php artisan serve
```
Aceder a `http://127.0.0.1:8000`, iniciar sessão com o utilizador administrador.

## Funcionalidades principais

- **Autenticação:** login/registo de utilizadores (sessões, hashing bcrypt), rotas
  protegidas pelo middleware `auth`.
- **CRUD completo:** Categorias, Fornecedores, Medicamentos, Clientes e Vendas.
- **Vendas:** formulário dinâmico para adicionar vários medicamentos a uma venda,
  cálculo automático de subtotal/total e **dedução automática do stock**, dentro
  de uma transação de base de dados (garante integridade caso ocorra um erro).
- **Alertas de stock:** medicamentos com stock abaixo do mínimo são assinalados
  no dashboard.
- **Validação:** Form Requests do Laravel em todos os formulários (campos
  obrigatórios, tipos, tamanhos, unicidade, datas).
- **Controlo de erros:** páginas de erro 404/500 personalizadas, mensagens de
  validação inline, mensagens *flash* de sucesso/erro, transações com rollback.
- **Interface responsiva:** Bootstrap 5 (grelha responsiva, navbar colapsável).

## Estrutura da base de dados (resumo)

`categorias` 1—N `medicamentos` N—1 `fornecedores`
`clientes` 1—N `vendas` N—1 `users`
`vendas` 1—N `itens_venda` N—1 `medicamentos`

Ver diagrama de classes e modelo relacional no relatório (`21241251.docx`).

## Autor

David Samuel Chambal — Estudante nº 21241251 — Curso de Gestão de Sistemas de Informação, UniSCED.
