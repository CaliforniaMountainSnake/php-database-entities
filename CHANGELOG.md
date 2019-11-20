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
