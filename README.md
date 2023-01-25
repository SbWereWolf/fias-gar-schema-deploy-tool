# FIAS GAR Schema Deploy Tool

Kit of templates and scripts to deploy FIAS GAR database

Федеральная Информационная Адресная Система
Государственный Адресный Реестр - ФИАС ГАР

## How to install

`composer require sbwerewolf/fias-gar-db-installer`

## How to use

First step is to create tables, second - indexes.

### Deploy tables

- Create .env file with DB credentials
- Copy-paste directory `test/template` to reachable location
- Copy-paste [install-storage.php](test/install-storage.php)
- Correct all paths into [install-storage.php](test/install-storage.php)
- Correct Templates list, remove unnecessary
- Run script [install-storage.php](test/install-storage.php)

### Create indexes

- Copy-paste [create-indexes.php](create-indexes.php)
- Correct all paths into [create-indexes.php](create-indexes.php)
- Correct Templates list, remove unnecessary
- Run script [create-indexes.php](create-indexes.php)

## Create templates and scripts on you own

Let explore source code and fill free to change it.

SQL was developed only for PostgreSQL, it is possible not suitable for
MySql and others DBMS.

## Contacts

```
Volkhin Nikolay
e-mail ulfnew@gmail.com
phone +7-902-272-65-35
Telegram @sbwerewolf
```

Chat with me via messenger

- [Telegram chat with me](https://t.me/SbWereWolf)
- [WhatsApp chat with me](https://wa.me/79022726535) 