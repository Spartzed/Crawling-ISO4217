# Projeto Laravel com Controller de Crawling para Dados de Moedas

Este projeto Laravel utiliza um controller para realizar crawling na Wikipedia e obter informações sobre moedas com base no código ISO 4217. O controller suporta caching com Redis para evitar requisições repetidas.

## Pré-requisitos

- PHP >= 7.4
- Composer
- Servidor Redis (opcional, para caching)

## Instalação

1. **Clone o repositório:**

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
  
  - `code`: Pode ser um número ou uma string contendo um ou mais códigos separados por vírgula

  **Exemplo de Uso:**

  ```bash
  curl http://localhost:8000/currency/784

  php artisan crawl:currency 974,brl,971

## Road map

1. **Implementação dos tratamentos de erro**

    Alguns erros já estão sendo tratados, mas a alguns para melhorar a qualidade do codigo como, por exemplo, o codigo não estar no padrão ISO 4217

2. **Implementar Redis e Mysql**

    O Redis ira evitar que requisições iguais sejam processadas novamente num periodo de tempo, assim deixando a aplicação melhor, e guardar algumas informações no banco de dados para melhorara ainda mais a aplicação

3. **Teste Unitarios**

    Essencial para garantir a qualidade e funcionalidade do codigo

4. **Docker**

    Não tenho muita experiencia em realizar a criação de containers, mas pretendo realizar o quanto antes.
    

  