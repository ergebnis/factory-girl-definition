# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/), and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## Unreleased

For a full diff see [`2.0.1...master`][2.0.1...master]

## [`2.0.1`][2.0.1]

For a full diff see [`2.0.0...2.0.1`][2.0.0...2.0.1].

### Fixed

* Removed an inappropriate `replace` configuration from `composer.json` ([#76]), by [@localheinz]

## [`2.0.0`][2.0.0]

For a full diff see [`1.3.0...2.0.0`][1.3.0...2.0.0].

### Changed

* Added return type declarations ([#71]), by [@localheinz]
* Renamed vendor namespace `Localheinz` to `Ergebnis` after move to [@ergebnis] ([#73]), by [@localheinz]

  Run

  ```
  $ composer remove localheinz/factory-girl-definition
  ```

  and

  ```
  $ composer require ergebnis/factory-girl-definition
  ```

  to update.

  Run

  ```
  $ find . -type f -exec sed -i '.bak' 's/Localheinz\\FactoryGirl\\Definition/Ergebnis\\FactoryGirl\\Definition/g' {} \;
  ```

  to replace occurrences of `Localheinz\FactoryGirl\Definition` with `Ergebnis\FactoryGirl\Definition`.

  Run

  ```
  $ find -type f -name '*.bak' -delete
  ```

  to delete backup files created in the previous step.

### Fixed

* Required `breerly/factory-girl-php` and `fzaninotto/faker` ([#69]), by [@localheinz]

## [`1.3.0`][1.3.0]

For a full diff see [`1.2.0...1.3.0`][1.2.0...1.3.0].

## [`1.2.0`][1.2.0]

For a full diff see [`1.1.0...1.2.0`][1.1.0...1.2.0].

## [`1.1.0`][1.1.0]

For a full diff see [`1.0.0...1.1.0`][1.0.0...1.1.0].

## [`1.0.0`][1.0.0]

For a full diff see [`0.2.0...1.0.0`][0.2.0...1.0.0].

## [`0.2.0`][0.2.0]

For a full diff see [`0.1.1...0.2.0`][0.1.1...0.2.0].

### Fixed

* Raised minimum stability to default levels ([#4]), by [@localheinz]

## [`0.1.1`][0.1.1]

For a full diff see [`0.1.0...0.1.1`][0.1.0...0.1.1].

### Fixed

* Ignored definitions with `private` constructors ([#3]), by [@localheinz]

## [`0.1.0`][0.1.0]

For a full diff see [`740095e...0.1.0`][740095e...0.1.0].

### Added

* Added interface and finder ([#1]), by [@localheinz]

[0.1.0]: https://github.com/ergebnis/factory-girl-definition/tag/0.1.0
[0.1.1]: https://github.com/ergebnis/factory-girl-definition/tag/0.1.1
[0.2.0]: https://github.com/ergebnis/factory-girl-definition/tag/0.2.0
[1.0.0]: https://github.com/ergebnis/factory-girl-definition/tag/1.0.0
[1.1.0]: https://github.com/ergebnis/factory-girl-definition/tag/1.1.0
[1.2.0]: https://github.com/ergebnis/factory-girl-definition/tag/1.2.0
[1.3.0]: https://github.com/ergebnis/factory-girl-definition/tag/1.3.0
[2.0.0]: https://github.com/ergebnis/factory-girl-definition/tag/2.0.0
[2.0.1]: https://github.com/ergebnis/factory-girl-definition/tag/2.0.1

[740095e...0.1.0]: https://github.com/ergebnis/factory-girl-definition/compare/740095e...0.1.0
[0.1.0...0.1.1]: https://github.com/ergebnis/factory-girl-definition/compare/0.1.0...0.1.1
[0.1.1...0.2.0]: https://github.com/ergebnis/factory-girl-definition/compare/0.1.1...0.2.0
[0.2.0...1.0.0]: https://github.com/ergebnis/factory-girl-definition/compare/0.2.0...1.0.0
[1.0.0...1.1.0]: https://github.com/ergebnis/factory-girl-definition/compare/1.0.0...1.1.0
[1.1.0...1.2.0]: https://github.com/ergebnis/factory-girl-definition/compare/1.1.0...1.2.0
[1.2.0...1.3.0]: https://github.com/ergebnis/factory-girl-definition/compare/1.1.0...1.3.0
[1.3.0...2.0.0]: https://github.com/ergebnis/factory-girl-definition/compare/1.3.0...2.0.0
[2.0.0...2.0.1]: https://github.com/ergebnis/factory-girl-definition/compare/2.0.0...2.0.1
[2.0.1...master]: https://github.com/ergebnis/factory-girl-definition/compare/2.0.1...master

[#1]: https://github.com/ergebnis/factory-girl-definition/pull/1
[#3]: https://github.com/ergebnis/factory-girl-definition/pull/3
[#4]: https://github.com/ergebnis/factory-girl-definition/pull/4
[#69]: https://github.com/ergebnis/factory-girl-definition/pull/69
[#71]: https://github.com/ergebnis/factory-girl-definition/pull/71
[#73]: https://github.com/ergebnis/factory-girl-definition/pull/73
[#76]: https://github.com/ergebnis/factory-girl-definition/pull/76

[@ergebnis]: https://github.com/ergebnis
[@localheinz]: https://github.com/localheinz
