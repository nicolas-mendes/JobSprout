<p align="center">
  <h1 align="center">JobSprout</h1>
</p>

<p align="center">
  Uma plataforma de anúncios de vagas construída com Laravel, projetada para conectar empresas e pessoas em busca de emprego.

</p>

<p align="center">
  <img src="https://img.shields.io/badge/PHP-8.2%2B-blue" alt="PHP Version">
  <img src="https://img.shields.io/badge/Laravel-11.x-red" alt="Laravel Version">
  <img src="https://img.shields.io/badge/License-MIT-green" alt="License">
</p>

---

## 📋 Índice

- [Sobre o Projeto](#sobre-o-projeto)
- [Funcionalidades Principais](#funcionalidades-principais)
- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Demonstração Visual](#demonstração-visual)

## 📖 Sobre o Projeto

**JobSprout** é uma aplicação web full-stack desenvolvida para simplificar o processo de divulgação de vagas de emprego. A plataforma permite que empresas se cadastrem, publiquem suas vagas e alcancem candidatos qualificados. O fluxo para os candidatos é projetado para ser simples: eles visualizam a vaga e são redirecionados diretamente para o sistema de aplicação da empresa anunciante.

## ✨ Funcionalidades Principais

### Para Empresas (Recrutadores)
-   ✅ **Sistema de Autenticação Completo:** Cadastro, login e logout seguros para gerenciar o perfil da empresa.
-   🔐 **Autorização e Posse de Dados:** Uma empresa só pode editar e gerenciar as vagas que ela mesma criou, garantindo a segurança e a integridade dos dados.
-   💼 **Gerenciamento de Vagas (CRUD):** Funcionalidade completa para criar, listar, editar e remover anúncios de emprego.
-   📝 **Validação de Formulários:** Toda entrada de dados é rigorosamente validada no back-end para prevenir dados malformados e garantir a segurança.

### Para Candidatos (Visitantes)
-   🔍 **Listagem e Busca de Vagas:** Interface limpa para visualizar as vagas mais recentes e as que estão em destaque.
-   🏷️ **Filtragem por Tags:** Sistema de filtragem que permite aos usuários encontrar vagas por categoria (ex: "PHP", "Laravel", "Trainee").
-   🚀 **Redirecionamento Direto:** Ao clicar em uma vaga, o usuário é redirecionado para a URL externa fornecida pela empresa, agilizando o processo de candidatura.

## 🛠️ Tecnologias Utilizadas

Este projeto foi construído utilizando as seguintes tecnologias e ferramentas:

-   **Backend:** PHP, Laravel
-   **Frontend:** Tailwind CSS, Blade
-   **Banco de Dados:** MySQL
-   **Ferramentas de Desenvolvimento:** Vite, Composer, Git

## 🖼️ Demonstração Visual

Aqui estão algumas prévias da aplicação em funcionamento.

### Página Inicial
*Uma visão geral das vagas em destaque e da listagem principal.*

`![Página Inicial do JobSprout](URL_DA_IMAGEM_AQUI)`

### Formulário de Criação de Vaga
*A interface que as empresas usam para postar uma nova oportunidade (acessível apenas para usuários autenticados).*

`![Formulário de Criação de Vaga](URL_DA_IMAGEM_AQUI)`

### Página de Apresentação das vagas
*Exemplo de como os usuários podem filtrar vagas por uma categoria específica.*

`![Busca e Filtragem por Tags](URL_DA_IMAGEM_AQUI)`
