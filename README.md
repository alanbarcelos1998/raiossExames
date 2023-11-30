# Teste Raioss, Gerencia de Exames.

### Como testar

1. Primeiro rodar o ```composer update```
2. Após o composer update, rodar o comando:
```docker-compose up -d --build```
3. Após isso pode se acessar o **localhost:85** que irá conseguir acessar o projeto.

### Arquitetura:
A arquitetura deste código está baseada no MVC, incluindo alguns diretórios para auxiliar, os diretórios auxiliares são:

**app/Configuration**
        - Essa pasta contém o arquivo Connection, que abriga a classe de abertura de conexão com o banco de dados quando necessário.
    
**app/Core**
        - Nesse diretório se encontra o arquivo Core.php que por sua vez é o arquivo responsável pela lógica de direcionamento via url para os métodos das controllers.

**app/Template**
        - Nesse diretório tem-se o arquivo skeleton.html, que nada mais é que o esqueleto das páginas, contendo o Navbar e o trecho de código dinâmico.

### Tecnologias utilizadas
Neste ponto houve-se a necessidade de utilização de uma biblioteca de templates para que o código ficasse menos bagunçado e um pouco mais legível.

Optei por utilizar a biblioteca **Twig**.

O **bootstrap** foi utilizado via link cdn e se encontra no arquivo skeleton.html

Utilizei para conexão com o banco de dados o padrão de conexão **PDO**.

Para facilitar um pouco nos testes, optei por usar o **Docker**, criei um Dockerfile juntamente com um docker-compose, que inclui o mysql e o adminer caso queiram verificar a estrutura do banco de forma simplificada.

Utilizei o arquivo **env**, mas somente para fazer a comunicação com o docker-compose, nas conexões com o banco utilizei o arquivo config.php para passar as constantes.
