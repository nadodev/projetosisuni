# 📦 Projeto Laravel 10 com Blade, Livewire e MySQL

Este projeto é desenvolvido em **Laravel 10** usando **Blade templates**, **Livewire** para componentes dinâmicos, além de HTML, CSS e JavaScript puro.  
Banco de dados utilizado: **MySQL**.

## 🧰 Tecnologias e ferramentas
- **Laravel 10** – framework PHP principal
- **MySQL** – armazenamento de dados
- **Blade** – engine de templates
- **Laravel Livewire** – componentes reativos sem necessidade de escrever muito JavaScript
- **HTML, CSS e JavaScript** – para o frontend
- **Composer** – gerenciador de dependências PHP
- **npm** – build de assets (opcionalmente com Laravel Mix ou Vite)

---

## 📂 Estrutura geral
app/ # Código da aplicação (Models, Http, Providers, etc)
resources/
views/ # Blade templates (.blade.php)
views/livewire/ # Componentes Livewire
css/ # Estilos customizados
js/ # Scripts customizados
routes/ # Definição das rotas (web.php, api.php)
database/ # Migrations, Seeders, Factories
public/ # Document root (assets compilados ficam aqui)




🧠 Instruções para uso de IA (ChatGPT, Copilot, etc.)
Quando pedir sugestões de código ou ajuda para IA, informe:

Que o projeto usa Laravel 10

Banco de dados MySQL

Frontend baseado em Blade, HTML, CSS, JS e Livewire

Estrutura MVC padrão do Laravel

Que os templates são arquivos .blade.php

Componentes reativos estão em resources/views/livewire

Exemplo de prompt para IA:

"Gere um componente Livewire chamado UserTable que exibe usuários paginados, permite busca pelo nome e ordenação por e-mail. O projeto está em Laravel 10, usa Blade e MySQL."

✅ Boas práticas do projeto
Usar migrations, seeders e factories para preparar o banco de dados

Seguir a estrutura MVC

Reutilizar componentes Blade e Livewire para evitar duplicidade de código

Validar sempre os dados (no Controller ou no Component)

Seguir PSR-12 para padronização de código PHP