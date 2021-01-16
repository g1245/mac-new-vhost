<?php

print "** Vamos adicionar um novo projeto ao vhost **\n";

$domain = readline("Qual o dominio do projeto?\n");
$diretorio = readline("Qual o diretorio do projeto?\n");
$vhost_file = "/usr/local/etc/httpd/sites-enabled/{$domain}.conf";

/*
 * Criando o vhost
 */

$vhost = "<VirtualHost *:80>
DocumentRoot \"/Users/faustoschneider/Sites/{$diretorio}\"
ServerName {$domain}
</VirtualHost>";

file_put_contents($vhost_file, $vhost);

if(is_file($vhost_file))
    echo "Arquivo criado com sucesso." . PHP_EOL;

/*
 * Reiniciando o serviço
 */

echo "Reiniciando o procesos do apache..." . PHP_EOL;
echo shell_exec('apachectl restart');

/*
 * Criando o alias nos hosts
 */

file_put_contents("/etc/hosts", "127.0.0.1 {$domain}\n", FILE_APPEND);