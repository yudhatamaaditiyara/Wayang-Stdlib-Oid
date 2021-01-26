# 1.1.0 - 2021-01-27

- feat: add module `Wayang\Stdlib\Oid\Exception`
- feat: add static method `createFromString` and `createFromTimestamp`
- feat: add subclass interface `Wayang\Stdlib\StringableInterface` to `Wayang\Stdlib\Oid\OidInterface`
- refactor: change throw exception `InvalidArgumentException` to `Wayang\Stdlib\Oid\Exception\OidException`
- refactor: change throw exception `BadMethodCallException` to `Wayang\Stdlib\Oid\Exception\BadMethodCallException`
- build: upgrade PHP `>=7.2.5`
- docs: rename alt text `packagist` and `ci` badge
- docs: remove `license` badge

# 1.0.0 - 2019-12-03

- Initial release