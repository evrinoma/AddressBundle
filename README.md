# Installation

Добавить в kernel

    Evrinoma\AddressBundle\EvrinomaAddressBundle::class => ['all' => true],

Добавить в routes

    address:
        resource: "@EvrinomaAddressBundle/Resources/config/routes.yml"

Добавить в composer

    composer config repositories.dto vcs https://github.com/evrinoma/DtoBundle.git
    composer config repositories.dto-common vcs https://github.com/evrinoma/DtoCommonBundle.git
    composer config repositories.utils vcs https://github.com/evrinoma/UtilsBundle.git

# Configuration

преопределение штатного класса сущности

    address:
        db_driver: orm модель данных
        factory: App\Address\Factory\Address\Factory фабрика для создания объектов,
                 недостающие значения можно разрешить только на уровне Mediator
        entity: App\Address\Entity\Address сущность
        constraints: Вкл/выкл проверки полей сущности по умолчанию 
        dto: App\Address\Dto\AddressDto класс dto с которым работает сущность
        decorates:
          command - декоратор mediator команд адреса 
          query - декоратор mediator запросов адреса
        services:
          pre_validator - переопределение сервиса валидатора адреса
          handler - переопределение сервиса обработчика сущностей

# CQRS model

Actions в контроллере разбиты на две группы
создание, редактирование, удаление данных

        1. putAction(PUT), postAction(POST), deleteAction(DELETE)
получение данных

        2. getAction(GET), criteriaAction(GET)

каждый метод работает со своим менеджером

        1. CommandManagerInterface
        2. QueryManagerInterface

При переопределении штатного класса сущности, дополнение данными осуществляется декорированием, с помощью MediatorInterface


группы  сериализации

    1. API_GET_ADDRESS, API_CRITERIA_ADDRESS - получение адреса
    2. API_POST_ADDRESS - создание адреса
    3. API_PUT_ADDRESS -  редактирование адреса

# Статусы:

    создание:
        адрес создан HTTP_CREATED 201
    обновление:
        адрес обновлен HTTP_OK 200
    удаление:
        адрес удален HTTP_ACCEPTED 202
    получение:
        адрес(и) найдены HTTP_OK 200
    ошибки:
        если адрес не найден AddressNotFoundException возвращает HTTP_NOT_FOUND 404
        если адрес не уникален UniqueConstraintViolationException возвращает HTTP_CONFLICT 409
        если адрес не прошел валидацию AddressInvalidException возвращает HTTP_UNPROCESSABLE_ENTITY 422
        если адрес не может быть сохранен AddressCannotBeSavedException возвращает HTTP_NOT_IMPLEMENTED 501
        все остальные ошибки возвращаются как HTTP_BAD_REQUEST 400

# Constraint

Для добавления проверки поля сущности address нужно описать логику проверки реализующую интерфейс Evrinoma\UtilsBundle\Constraint\Property\ConstraintInterface и зарегистрировать сервис с этикеткой evrinoma.address.constraint.property

    evrinoma.address.constraint.property.custom:
        class: App\Address\Constraint\Property\Custom
        tags: [ 'evrinoma.address.constraint.property' ]

## Description
Формат ответа от сервера содержит статус код и имеет следующий стандартный формат
```text
    [
        TypeModel::TYPE => string,
        PayloadModel::PAYLOAD => array,
        MessageModel::MESSAGE => string,
    ];
```
где
TYPE - типа ответа

    ERROR - ошибка
    NOTICE - уведомление
    INFO - информация
    DEBUG - отладка

MESSAGE - от кого пришло сообщение
PAYLOAD - массив данных

## Notice

показать проблемы кода

```bash
vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.dist.php --verbose --diff --dry-run
```

применить исправления

```bash
vendor/bin/php-cs-fixer fix --config=.php-cs-fixer.dist.php
```

# Тесты:

    composer install --dev

### run all tests

    /usr/bin/php vendor/phpunit/phpunit/phpunit --bootstrap src/Tests/bootstrap.php --configuration phpunit.xml.dist src/Tests --teamcity

### run personal test for example testPost

    /usr/bin/php vendor/phpunit/phpunit/phpunit --bootstrap src/Tests/bootstrap.php --configuration phpunit.xml.dist src/Tests/Functional/Controller/ApiControllerTest.php --filter "/::testPost( .*)?$/" 

## Thanks

## Done

## License
    PROPRIETARY