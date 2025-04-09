# Huggy Challenger

## 📋 Requisitos de Sistema

### Backend
- **PHP 8.4** (algumas features específicas do 8.4 foram utilizadas)
- **Composer** (última versão)
- **Banco de Dados** (qualquer banco de dados relacional)

### Frontend
- **Node.js 22+** (versão 22.13 utilizada em desenvolvimento)
- **npm** ou **yarn**

## 🛠 Tecnologias Utilizadas

### Backend
- **Laravel 12**
- **Twilio** (como provedor VoIP)

### Frontend
- **Nuxt 3**
- **Vue.js 3** (Composition API)
- **TailwindCSS**

### Ferramentas Adicionais
- **Postman** (para testes de API)

## 🚀 Inicialização do Projeto

Para subir a aplicação, execute o seguinte comando:

```bash
./setup.sh
```

Este script irá:

- Instalar todas as dependências do backend (via Composer)
- Instalar as dependências do frontend (via npm/yarn)
- Configurar o ambiente de desenvolvimento
- Iniciar os servidores necessários
- Após a execução, os serviços estarão disponíveis em:
    - API: http://localhost:8000
    - Frontend: http://localhost:3000

### Testando a API

Para testar os endpoints da API, você pode importar a collection do Postman [clicando aqui](https://documenter.getpostman.com/view/43805633/2sB2cX7gHd).

## 📂 Estrutura do Projeto

```
project-root/
├── backend/          # Código Laravel
├── frontend/         # Aplicação Nuxt.js
├── setup.sh          # Script de inicialização
└── README.md         # Documentação
```

## 🧪 Testando o Frontend

### Credenciais de Acesso
Ao chamar a rota de registro da collection do Postman, um usuário de teste é criado automaticamente com as seguintes credenciais:

```json
{
    "email": "rodrigo-sx@mail.com",
    "password": "12345678"
}
```

Acesse a aplicação em: [http://localhost:3000](http://localhost:3000)

## 🧪 Testando o Frontend

### 1. Listagem de Contatos Iniciais
- Ao executar `./setup.sh`, uma seeder cria **50 contatos** na base de dados
- Após login, esses contatos serão exibidos na página inicial, verifique se a lista é carregada corretamente

---

### 2. Cadastro de Novos Contatos
Para testar essa funcionalidade, certifique-se de que a fila esteja em execução (a menos que o seu .env esteja configurado com QUEUE_CONNECTION=sync).
Garanta também que as credenciais de um servidor SMTP estejam corretamente configuradas para os testes — recomendo o uso do Mailtrap.
Além disso, ajuste a variável APP_WELCOME_MAIL_DELAY no arquivo .env do backend para 1, pois, caso contrário, o e-mail será enviado apenas após 30 minutos.

Importante: os jobs responsáveis por disparar as requisições via webhook irão falhar, pois a URL cadastrada atualmente não existe. Caso queira testar em uma aplicação que exista, crie pelo tinker um registro utilizando o model Webhook com o evento de criação de contato.

1. Clique no botão azul **"Adicionar Contato"**
2. Preencha todos os campos obrigatórios no modal

**Verifique se:**
- [ ] O contato é salvo com sucesso
- [ ] A lista é atualizada automaticamente
- [ ] O novo contato aparece no topo da lista

---

### 3. Visualização de Detalhes
- Clique em qualquer contato para ver:
  - Todas as informações cadastradas
  - Três ações disponíveis:
    - ✏️ Editar contato
    - 🗑️ Excluir contato
    - 📞 Ligar para o contato

---

### 4. Edição de Contatos
1. Clique em "Editar Contato"
2. Modifique qualquer campo no modal

**Verifique se:**
- [ ] As alterações são persistidas
- [ ] A lista é atualizada com os novos dados
- [ ] Validações de campo funcionam corretamente

---

### 5. Exclusão de Contatos
1. Clique em "Excluir Contato"
2. Confirme a ação na caixa de diálogo

**Verifique se:**
- [ ] O contato é removido permanentemente (sem soft delete)
- [ ] A lista é atualizada imediatamente
- [ ] Mensagens de sucesso/erro são exibidas adequadamente

---

### 6. Funcionalidade de Chamada (Twilio)
⚠️ **Requer configuração adicional:**

```env
# .env (Backend)
TWILIO_SID={account_sid}           # Dashboard Twilio
TWILIO_AUTH_TOKEN={auth_token}     # Dashboard Twilio
TWILIO_PHONE_NUMBER={phone_number} # Número Twilio (pago)
TWILIO_AGENT_PHONE_NUMBER={agent_phone_number} # Número verificado
TWILIO_CALL_TIMEOUT=20             # Tempo máximo de espera (segundos)
```

## ⚙️ Configuração para Desenvolvimento

### 1. Expondo a API com ngrok
Para testar a funcionalidade de chamadas, você precisará expor sua API local:

```bash
ngrok http 8000
```

### 2. Atualizando Variáveis de Ambiente

Após iniciar o ngrok, atualize estas variáveis:

```env
# Arquivo .env do Backend
APP_URL=https://seu-subdomínio.ngrok.io

# Arquivo .env do Frontend
NUXT_PUBLIC_API_BASE=https://seu-subdomínio.ngrok.io
```


### 3. Testando a Funcionalidade de Chamada

**Verifique se:**
- O toast de inicialização de chamada aparece ao clicar em "Ligar"
- A chamada é iniciada corretamente (verifique o número verificado ou comprado pela Twilio)
- O status da chamada é atualizado na interface


**Nota:** Para testes completos da integração com Twilio, recomenda-se:

- Criar uma conta gratuita em twilio.com
- Verificar números de telefone para testes

## Testando o Flow da Huggy

Foi criado um flow de teste no painel da Huggy para capturar dados dos contatos durante as interações no chat e enviá-los para a API.

Você pode [baixar o flow de teste aqui](https://drive.google.com/file/d/1sDwPbpiE4jl9Qvodu6JEtalp8lN0s7m7/view?usp=sharing).

### Como utilizar:
1. Importe o flow no seu painel da Huggy.
2. Edite a etapa "Enviar requisição" e atualize a URL com o seu endereço do **ngrok**.
3. Crie um canal do tipo **Conversation Page** e associe o canal ao flow importado.
4. Acesse a página do chat pelo link gerado.
5. Inicie a interação preenchendo os campos solicitados.
6. Ao finalizar, verifique se o contato foi criado, acessando:
   - A listagem de contatos no frontend, ou
   - Diretamente pela rota de listagem de contatos no Postman.

> **Observação:** Caso ocorra algum erro, um log será enviado automaticamente para o canal **huggy-flow**.

---

## Visualizando insights dos contatos cadastrados

1. Clique no ícone de **gráfico**, localizado no canto superior direito da tela, para acessar a página de insights.
2. Nesta tela, você encontrará dois gráficos:
   - Contatos segmentados por estado.
   - Contatos com e sem número de telefone.
3. Ao passar o mouse em uma sessão você poderá visualizar a quantidade de contatos em cada categoria.

---

## Testando a responsividade

- Acesse a aplicação pelo celular, ou
- Utilize as ferramentas do navegador para simular a visualização em dispositivos móveis.

Verifique se todos os elementos da interface se adaptam corretamente à tela menor.

---

## Executando os testes do backend

Você também pode executar os testes automatizados do backend com o seguinte comando:

```shell
./vendor/bin/phpunit
```

**Observação:** Certifique-se de executar o comando dentro da pasta backend.

