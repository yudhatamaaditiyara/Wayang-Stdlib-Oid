# 1.1.1 - 2021-01-28

- fix: add return type
- docs: update `CHANGELOG.md`

# 1.1.0 - 2021-01-27

- feat: add class `Wayang\Stdlib\Oid\Exception\OidException`
- feat: add class `Wayang\Stdlib\Oid\Exception\BadMethodCallException`
- feat: add interface `Wayang\Stdlib\Oid\Exception\OidExceptionInterface`
- feat: add static method `createFromString` to `Wayang\Stdlib\Oid\Oid453` and `Wayang\Stdlib\Oid\Oid563`
- feat: add static method `createFromTimestamp` to `Wayang\Stdlib\Oid\Oid453` and `Wayang\Stdlib\Oid\Oid563`
- feat: add subclass interface `Wayang\Stdlib\StringableInterface` to `Wayang\Stdlib\Oid\OidInterface`
- refactor: change throw exception `InvalidArgumentException` to `Wayang\Stdlib\Oid\Exception\OidException`
- refactor: change throw exception `BadMethodCallException` to `Wayang\Stdlib\Oid\Exception\BadMethodCallException`
- build: upgrade php `>=7.2.5`
- docs: rename alt text `packagist` and `ci` badge
- docs: remove `license` badge

# 1.0.0 - 2019-12-03

- Initial release