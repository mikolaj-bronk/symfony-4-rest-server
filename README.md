# symfony-4-rest-server


# Instalacja Projektu serwera

Po pobraniu repozytorium należy użyć komendy
```console
composer update
```
Aby serwer poprawnie komunikował się z bazą należy w pliku *.env* ustawić połączenie konfiguracyjne z bazą MySQL
```console
DATABASE_URL=mysql://root:password@127.0.0.1:3306/nazwa_bazy
```
Następnie należy wpisać kolejno:
```console
php bin/console doctrine:database:create
php bin/console doctrine:migrations:migrate
php bin/console doctrine:fixtures:load
```
Jeśli wszystko przebiegło pomyślnie możemy uruchomić serwer poleceniem
```console
php bin/console server:run
```


# Instalacja Projektu klienta
Po pobraniu repozytorium należy użyć komendy
```console
composer update
```
Zmieniamy w pliku *.env* adres uruchomionego serwera
```
API_URL=http://127.0.0.1:8000  
```
Uruchamiamy klienta poleceniem:
```console
php bin/console server:run
```



# Instalacja Paczki serwera

## Wymagania: 
- Utworzony projekt w frameworku *Symfony 4*
- *PHP* w wersji minimum 7.1
- *MySQL*

## Instalacja
W sekcji require w pliku *composer.json* należy umieścić:
```json
  "require": {
    "Bronk/Rest-bundle": "dev-master"
  },
```
W tym samym pliku w sekcji *repository* należy umieścić (jeżeli sekcja nie istnieje, to należy ją utworzyć):
```json
  "repositories": [
    { "type": "git", "url": "https://github.com/mikolaj-bronk/symfony-4-rest-server-bundle" }
  ]
```

Teraz aby composer pobrał paczkę z najnowszą wersją należy wpisać:
```console
composer update Bronk/Rest-bundle
```

w pliku *config/services.yaml* należy dopisać:
```yaml
imports:
    - { resource: "@BronkRestBundle/Resources/config/services.yaml" }
```

do pliku *config/routes.yaml* należy dopisać
```yaml
rest-bundle:
    resource: '@BronkRestBundle/Resources/config/routes.yaml'
 ```


# Curl
<table>
<tr>
<th>
Polecenie w konsoli
<th>
Cel
</th>
<th>
Metoda
</th>
</tr>

<tr>
<td>
curl -X GET http://127.0.0.1:8000/items
</td>
<td>
Pobranie wszystkich produktów
</td>
<td>
GET
</td>
</tr>

<tr>
<td>
curl -X GET http://127.0.0.1:8000/items/1
</td>
<td>
Pobranie produktu o id = 1
</td>
<td>
GET
</td>
</tr>

<tr>
<td>
curl -d "name=NAZWA&amount=ILOSC" -X POST http://127.0.0.1:8000/items
</td>
<td>
Utworzenie nowego produktu, gdzie NAZWA jest nazwą produktu, a ILOSC to liczba produktów
</td>
<td>
POST
</td>
</tr>


<tr>
<td>
curl -d "id=ID&name=NAZWA&amount=10" -X PUT http://127.0.0.1:8000/items
</td>
<td>
Edycja produktu, gdzie ID to id produtku, NAZWA jest nazwą produktu, a ILOSC to liczba produktów
</td>
<td>
PUT
</td>
</tr>

<tr>
<td>
curl -X DELETE http://127.0.0.1:8000/items/1
</td>
<td>
Usunięcie produktu o id = 1
</td>
<td>
DELETE
</td>
</tr>

<tr>
<td>
curl -X GET http://127.0.0.1:8000/available
</td>
<td>
Pobranie produktów znajdujących się na stanie
</td>
<td>
GET
</td>
</tr>

<tr>
<td>
curl -X GET http://127.0.0.1:8000/unavailable
</td>
<td>
Pobranie produktów, których ilość jest równa 0
</td>
<td>
GET
</td>
</tr>

<tr>
<td>
curl -X GET http://127.0.0.1:8000/available/5
</td>
<td>
Pobranie produktów, których ilość jest większa niż (5)
</td>
<td>
GET
</td>
</tr>




</tr>
</table>
