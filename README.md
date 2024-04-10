# Documentação da API de Gerenciamento de Lugares

Esta API foi desenvolvida como parte do desafio do desenvolvedor backend para a construção de APIs simples para gerenciamento de lugares. A API permite realizar operações básicas de CRUD (Create, Read, Update, Delete) em lugares, além de fornecer a capacidade de filtrar os lugares por nome.

## Tecnologias Utilizadas

- Laravel 10
- PostgreSQL

## Configuração do Ambiente de Desenvolvimento

Para configurar o ambiente de desenvolvimento e executar a API localmente, siga as instruções abaixo:

### Pré-requisitos

Certifique-se de ter o seguinte instalado em sua máquina:

- Docker
- Docker Compose

### Instalação

1. Clone o repositório:

```
git clone <URL_DO_REPOSITÓRIO>
cd <NOME_DO_REPOSITÓRIO>
```

2. Crie um arquivo `.env` na raiz do projeto e configure suas variáveis de ambiente, incluindo a configuração do banco de dados PostgreSQL.

3. Execute o seguinte comando para iniciar o ambiente de desenvolvimento:

```
docker-compose up -d
```

4. Acesse a API em http://localhost:8000.

## Endpoints da API

### Criar um lugar

```
POST /api/places
```

Cria um novo lugar com os dados fornecidos no corpo da solicitação.

#### Parâmetros de Solicitação

- `name` (string, obrigatório): Nome do lugar.
- `slug` (string, obrigatório): Slug do lugar.
- `city` (string, obrigatório): Cidade do lugar.
- `state` (string, obrigatório): Estado do lugar.

#### Exemplo de Corpo da Solicitação

```json
{
    "name": "Local A",
    "city": "Cidade A",
    "state": "Estado A"
}
```

#### Exemplo de Resposta

```json
{
    "id": 1,
    "name": "Local A",
    "city": "Cidade A",
    "state": "Estado A",
    "created_at": "2024-04-10T12:00:00.000Z",
    "updated_at": "2024-04-10T12:00:00.000Z"
}
```

### Editar um lugar

```
PUT /api/places/{id}
```

Atualiza os dados de um lugar existente com base no ID fornecido.

#### Parâmetros de Solicitação

- `name` (string, opcional): Novo nome do lugar.
- `slug` (string, opcional): Novo slug do lugar.
- `city` (string, opcional): Nova cidade do lugar.
- `state` (string, opcional): Novo estado do lugar.

#### Exemplo de Corpo da Solicitação

```json
{
    "name": "Novo Local A"
}
```

#### Exemplo de Resposta

```json
{
    "id": 1,
    "name": "Novo Local A",
    "city": "Cidade A",
    "state": "Estado A",
    "created_at": "2024-04-10T12:00:00.000Z",
    "updated_at": "2024-04-10T12:10:00.000Z"
}
```

### Obter um lugar específico

```
GET /api/places/{id}
```

Retorna os detalhes de um lugar específico com base no ID fornecido.

#### Exemplo de Resposta

```json
{
    "id": 1,
    "name": "Novo Local A",
    "city": "Cidade A",
    "state": "Estado A",
    "created_at": "2024-04-10T12:00:00.000Z",
    "updated_at": "2024-04-10T12:10:00.000Z"
}
```

### Listar lugares e filtrá-los por nome

```
GET /api/places
```

Retorna uma lista de lugares. Você pode filtrar os lugares por nome, passando o parâmetro `name` na consulta.

#### Parâmetros de Consulta

- `name` (string, opcional): Filtra os lugares pelo nome.

#### Exemplo de Resposta

```json
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "name": "Novo Local A",
            "city": "Cidade A",
            "state": "Estado A",
            "created_at": "2024-04-10T12:00:00.000Z",
            "updated_at": "2024-04-10T12:10:00.000Z"
        }
    ],
    "first_page_url": "http://localhost:8000/api/places?page=1",
    "from": 1,
    "last_page": 1,
    "last_page_url": "http://localhost:8000/api/places?page=1",
    "links": [
        {
            "active": false,
            "label": "&laquo; Previous",
            "url": null
        },
        {
            "active": false,
            "label": "Next &raquo;",
            "url": null
        },
        {
            "active": true,
            "label": "1",
            "url": "http://localhost:8000/api/places?page=1"
        }
    ],
    "next_page_url": null,
    "path": "http://localhost:8000/api/places",
    "per_page": 10,
    "prev_page_url": null,
    "to": 1,
    "total": 1
}
```

## Observações

- Todas as respostas da API são em formato JSON.
- O banco de dados utilizado é o PostgreSQL.

## Testes

Os testes automatizados podem ser encontrados no diretório `tests` do projeto. Certifique-se de executar os testes após a configuração inicial da API para garantir que todas as funcionalidades estejam funcionando conforme esperado.

## Considerações Finais

A API foi desenvolvida seguindo boas práticas de programação e utilizando a estrutura e arquitetura recomendadas pelo Laravel. Se você tiver alguma dúvida ou encontrar problemas ao usar a API, não hesite em deixar o seu feedback.
