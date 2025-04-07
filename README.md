## Versões utilizadas nestes projeto

- PHP 8.4
- Laravel 12

## Passos
Implementar front
[ x ] Cadastro de um novo cliente;
[ x ] Atualização das informações de um cliente;
[ x ] Exclusão de um cliente
[ x ] Busca por clientes
[   ] Botão para ligação via VOIP para contatos com números de telefones cadastrados
[ v ] Visualização de gráficos com dados dos contatos

Implementar backend
[ x ] Criação de uma API com um CRUD de clientes;
[ x ] Todos os dados devem ser armazenados em uma banco de dados relacional;
[ x ] Implementação de webhooks para envio de informações externas como:
nome, email, telefone, endereço (cidade/estado), foto, idade ;
[ x ] Criação de serviço para tarefas agendadas como: email de boas vindas após
30 minutos que um novo contato foi adicionado;
[ x ] Adicionar busca na rota index de clientes
[ v ] Receber dados do flow da Huggy e salvar na base de dados
[   ] Integração com provedor VOIP para possibilitar realizar ligações caso o
contato tenha um número de telefone adicionado
[ v ] Implementação de relatório com uso de gráficos para exibir insights sobre as
informações dos contatos. Exemplos: segmentar por quantidade de contatos por cidade, idade e etc.

SEG: 
1 - Visualização de gráficos com dados dos contatos
3 - Implementação de relatório com uso de gráficos
2 - Receber dados do flow da Huggy e salvar na base de dados

TER:
1 - Integração com provedor VOIP
2 - Arrumar documentação e github
