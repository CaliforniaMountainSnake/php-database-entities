# Changelog
The format is based on [Keep a Changelog](http://keepachangelog.com/en/1.0.0/)
and this project adheres to [Semantic Versioning](http://semver.org/spec/v2.0.0.html).

## [Unreleased]
### Added
### Changed
### Deprecated
### Removed
### Fixed
### Security

## [1.0.11] - 2023-02-03
### Added
- Fix of the PHP8 support.

## [1.0.10] - 2023-02-03
### Added
- Added PHP8 support.

## [1.0.9] - 2021-04-30
### Added
- Added a DateFormats::UNIX_TIMESTAMP constant.

## [1.0.8] - 2021-04-30
### Added
- Added possibilities to customize casts in the BaseEntity::toArray().

## [1.0.7] - 2021-04-26
### Added
- Added some new values in the DateFormats interface.

## [1.0.6] - 2020-01-24
### Added
- Added the DateFormats interface contains various types of useful date constants.
### Changed
- Composer dependencies have been updated.

## [1.0.5] - 2019-11-20
### Changed
- The parameters have been returned to EntityInterface::toArray() method.

## [1.0.4] - 2019-11-20
### Fixed
- Fix of EntityInterface.

## [1.0.3] - 2019-11-20
### Added
- The method BaseEntity::toArray() now have the possibility to set $_is_exclude_null parameter. 

## [1.0.2] - 2019-08-01
### Added
- The method BaseEntity::fromJson() was improved.
### Changed
- The minimal php version was reduced to 7.1.
- Updated the Composer dependencies.

## [1.0.1] - 2019-07-10
### Changed
- Changed the behavior of EntityConvertUtils::createEntitiesListFromArray. It keeps the original array keys now.


## [1.0.0] - 2018-04-07
### Added
- Extracted classes and utils from the another project.
- Wrote a simple first test to check creation and conversion an entity from/to json/array.

[1.0.6]: https://github.com/CaliforniaMountainSnake/php-database-entities/compare/1.0.5...1.0.6
