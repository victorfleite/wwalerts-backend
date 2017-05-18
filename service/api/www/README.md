
1. Token access required
curl -i -H "Accept:application/json" -H "Content-Type:application/json" "http://localhost/alerts-tools/service/api/www/index.php/oauth2/token" -XPOST \
-d '{"grant_type":"password","username":"victor.leite@inmet.gov.br","password":"minhasenha","client_id":"meucliente","client_secret":"minhasenha"}'

2. Token access required with scope
curl -i -H "Accept:application/json" -H "Content-Type:application/json" "http://localhost/alerts-tools/service/api/www/index.php/oauth2/token" -XPOST \
-d '{"grant_type":"password","username":"victor.leite@inmet.gov.br","password":"minhasenha","client_id":"meucliente","client_secret":"minhasenha","scope":"custom"}'

3 - User data required
curl -i -H "Accept:application/json" -H "Content-Type:application/json" "http://localhost/alerts-tools/service/api/www/index.php/v1/user/get-user?access_token={TOKEN_GERADO_NA_AUTENTICACAO}"
