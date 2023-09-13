# Nexx

[![CI](https://github.com/lobofoltran/nexx/workflows/CI/badge.svg)](https://github.com/lobofoltran/nexx/actions)
[![Testing](https://github.com/lobofoltran/nexx/workflows/Test%20Workflow/badge.svg)](https://github.com/lobofoltran/nexx/actions)
[![GitHub License](https://badgen.net/github/license/lobofoltran/nexx)](https://github.com/lobofoltran/nexx/blob/master/LICENSE)
[![GitHub Latest Commit](https://badgen.net/github/last-commit/lobofoltran/nexx)](https://github.com/lobofoltran/nexx/commit/)

Um projeto desenvolvido como parte do meu Trabalho de Conclusão de Curso (TCC). 

## Descrição do Projeto

O Nexx é um sistema de automação comercial projetado para oferecer suporte a operações multimodulares, multiempresa e multifilial. Ele foi desenvolvido como um Software como Serviço (SaaS) para atender às necessidades complexas do setor de negócios.

# Como testar a aplicação

Existe uma versão em produção, alocado no endereço: https://nexx.lobofoltran.com

## Pré-requisitos

São necessários as seguintes tecnologias intaladas na máquina local para testar a aplicação:

Tecnologia    | Versão
------------- | -------------
PHP           | ^8.1
Composer      | ^2.5
Node.js       | ^18.15

## Passo a passo

1. Clone o repositório
```bash
git clone git@github.com:lobofoltran/nexx.git
```
2. Instale as dependências do projeto
```bash
cd nexx
composer install
npm install
npm run dev
```

3. Copie o arquivo `.env.example` e renomeie para `.env`:
```bash
cp .env.example .env
```

5. Crie o banco de dados em sqlite e insira dados de exemplo:
```bash
php artisan migrate --seed
```

5. Crie uma chave para o projeto:
```bash
php artisan key:generate
```

6. Inicie o servidor local:
```bash
php artisan serve --port=8000
```

O servidor local ficará disponível em `http://127.0.0.1:8000`

## Autenticação

Foi criado um usuário através dos seeders (funciona em produção):

```bash
Usuário: gustavoql
Senha: 1234
```
## Desenvolvimento Orientado por Testes (TDD)

Foram preparados uma cadeia de testes para testar e garantir que a aplicação após futuras releases continuem funcionando como era antes.

Para testar, execute os comandos:

```bash
php artisan migrate --seed --env=testing
php artisan test --env=testing
```
O retorno esperado é que todos os testes estejam assertivos.

