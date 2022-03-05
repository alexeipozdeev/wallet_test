Wallet Service
========

The wallet service


Installation to local environment
========
1. Clone the two git repositories
```
git clone https://github.com/alexeipozdeev/nginx-proxy.git
```
```
git clone https://github.com/alexeipozdeev/wallet_test.git
```
2. Move to the nginx docker directory
```
cd <my_project>/nginx-proxy/
```
3. Run the docker command
```
docker-compose up -d
```
4. Move to the docker directory
```
cd <my_project>/wallet_test/docker
```
5. Run the docker command
```
docker-compose up -d
```
6. Into to the wallet_test-app-1 docker container
```
docker exec -it wallet_test-app-1 bash
```
7. Run the composer command
```
composer install
```
8. Run the symfony console command
```
bin/console cache:clear
```
9. If everything is OK, this message will be shown.
```
[OK] Cache for the "dev" environment (debug=false) was successfully cleared.
```
10. Execute the databases migrations
```
bin/console doctrine:database:create
```
Note. Should be created "wallet_db" database
```
bin/console doctrine:migrations:migrate
```
After that we have three tables: "wallet", wallet_history", "currency_rate" \
And two wallet:
- id: 1, currency: RUB, balance: 0, client_id: 111
- id: 2, currency: USD, balance: 0, client_id: 222

11. Add to the "hosts" file (of Window). It is necessary for access to app via web
```
C:\Windows\System32\drivers\etc
```
address
```
127.0.0.1	wallet.loc
```


API endpoints
========
1. Get data of wallet
```
GET /wallet/{id}/balance
```
Body parameters: none
2. Change balance of wallet
```
PATCH /wallet/{id}/balance
```
Body parameters (required):
```
{
"type_transaction_code": "credit",
"reason_code": "refund",
"amount": 7400,
"currency_id": 810
}
```
SQL
========
```
SELECT SUM(amount) FROM wallet_history
WHERE wallet_id = 1
    AND reason_code = 'refund'
    AND created between NOW() - INTERVAL 7 DAY AND NOW()
ORDER BY wallet_id
```

