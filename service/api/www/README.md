
1. Requerindo token de acesso
curl -i -H "Accept:application/json" -H "Content-Type:application/json" "http://localhost/alerts-tools/service/api/www/index.php/oauth2/token" -XPOST \
-d '{"grant_type":"password","username":"victor.leite@inmet.gov.br","password":"pumba123","client_id":"meucliente","client_secret":"minhasenha"}'

2. Requerindo token de acesso com scopo
curl -i -H "Accept:application/json" -H "Content-Type:application/json" "http://localhost/alerts-tools/service/api/www/index.php/oauth2/token" -XPOST \
-d '{"grant_type":"password","username":"victor.leite@inmet.gov.br","password":"pumba123","client_id":"meucliente","client_secret":"minhasenha","scope":"custom"}'

3 - Requerindo dados de usuário
curl -i -H "Accept:application/json" -H "Content-Type:application/json" "http://localhost/alerts-tools/service/api/www/index.php/v1/user/get-user?access_token={TOKEN_GERADO_NA_AUTENTICACAO}"
