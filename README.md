# Teste Netshow.me

##### __Pré-requisitos__  
- PHP 7.1^
- MongoDB
- Composer

<br>
<br>

#### __Configuração__ 


##### __Banco de dados__  

No arquivo ``config/autoload/doctrine.local.php`` ficam as configurações de conexão ao Bando de dados.  
- ``server`` IP do servidor do banco de dados;
- ``port`` Porta do banco de dados;
- ``user`` Usuário do banco de dados;
- ``password`` Senha do usuário do banco de dados;
- ``dbname`` Nome da database do banco de dados;

###### Exemplo de como ficaria a configuração  
```php
'connection' => [
    'odm_default' => [
        'server' => 'localhost',
        'port' => '27017',
        'user' => '',
        'password' => '',
        'dbname' => 'test-netshowme',
        'options' => []
    ],
],
```

<br>

##### __E-Mails__  

No arquivo ``config/autoload/mail.local.php`` ficam as configurações para envio de E-Mail.  

- ``originEmail`` Email de origem;
- ``originName`` Nome de origem;
- ``destinationEmail`` Email de destino;
- ``destinationName`` Nome de destino;

O item ``smtpOptions`` contém a configuração SMTP do servidor utilizado no envio dos E-Mails.
- ``name`` Nome do servidor de email;
- ``host`` Host SMTP do servidor de email;
- ``port`` Porta do servidor de email;
- ``username`` Usuário do servidor de email;
- ``password`` Senha do usuário do servidor de email;


###### Exemplo de como ficaria a configuração  

```php
"mail" => [
    "originEmail" => "email-origem@gmail.com",
    "originName" => "nome-origem",
    "smtpOptions" => [
        'name' => 'smtp.gmail.com',
        'host' => "smtp.gmail.com",
        'port' => 587,
        'connection_class' => 'login',
        'connection_config' => [
            'username' => 'emailorigem@gmail.com',
            'password' => 'yyyyyy',
            'ssl' => 'tls',
            'host'=>'localhost:8080',
        ]
    ],
    "destinationEmail" => "email-destino@hotmail.com",
    "destinationName" => "nome-destino"
]
```

<br>

#### __Executando o projeto__
Para executar o projeto primeiramente deve-se ter o Composer instalado - [composer](https://getcomposer.org)  
Subir o serviço do MongoDB, algo comoo comando abaixo.  
```bash
systemctl start mongodb
```

Com o Composer instalado, basta entrar no diretório raiz do projeto e roda o seguinte comando para instalar as dependências

```bash
composer install
```


Aguardar a instalação das dependências do projeto.  
Após instalado as dependêcnias, basta rodar o servidor *bult-in* do PHP:


```bash
composer serve
```


Nesse ponto já é possível acessar a URL ``localhost:8080/contact`` para  
acessar a página de contato.  


<br>


Para rodar os teste basta executar o seguinte comando no diretório raiz:
```bash
composer test
```