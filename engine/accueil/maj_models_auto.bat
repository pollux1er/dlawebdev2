php doctrine-cli.php orm:convert-mapping --from-database --namespace="Entities\intranet\\" yml models\Mappings --force

php doctrine-cli.php orm:generate-entities models

php doctrine-cli.php orm:generate-proxies

pause