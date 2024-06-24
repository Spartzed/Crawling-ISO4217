# Projeto Laravel com Controller de Crawling para Dados de Moedas

Este projeto Laravel utiliza um controller para realizar crawling na Wikipedia e obter informações sobre moedas com base no código ISO 4217. O controller suporta caching com Redis para evitar requisições repetidas.

## Pré-requisitos

- PHP >= 7.4
- Composer
- Servidor Redis (opcional, para caching)

## Instalação

1. **Clone o repositório:**

   ```bash
   git clone https://github.com/seu-usuario/seu-projeto.git
   cd seu-projeto

2. **Instale as dependências do Composer::**

   ```bash
    composer install

3. **Configure as variáveis de ambiente:**

    Renomeie o arquivo .env.example para .env e configure as variáveis de ambiente, incluindo a conexão com o Redis se desejar utilizar caching

4. **Gere a chave da aplicação:**

   ```bash
    php artisan key:generate

5. **Execute as migrações (em Desenvolimento):**

   ```bash
    php artisan migrate

## Utilização

### Rotas Disponíveis

- **GET `/currency/{code}`**

  Retorna os dados das moedas correspondentes ao código ISO 4217 especificado.

  **Parâmetros:**
  
  - `code`: Pode ser um número ou uma string contendo um ou mais códigos separados por vírgula. Exemplo: `784` ou `784,BRL`.

  **Exemplo de Uso:**

  ```bash
  curl http://localhost:8000/currency/784
  curl http://localhost:8000/currency/784,971
  php artisan crawl:currency 974,brl,971
  