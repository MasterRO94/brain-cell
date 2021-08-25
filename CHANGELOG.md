# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [0.5.9] - 2021-08-25
### Fixed
- `JobBatchResource::createdAt` and `JobBatchResource::updatedAt` were
  incorretly returning arrays. They will now return `DateResource` object as
  per their method signatures.

## [0.5.8] - 2021-08-25
### Added
- `JobBatchResource` uses `CreatedAtTrait` and `JobBatchResourceInterface` 
  implements `CreatedAtInterface`.
- `JobBatchResource` uses `UpdatedAtTrait` and `JobBatchResourceInterface`
  implements `UpdatedAtInterface`.

## [0.5.7] - 2021-07-09
### Added
- `JobClientResource` implements `ResourceIdentityInterface`.

## [0.5.6] - 2021-06-24
### Fixed
- Fixed method `getMetaData` on `AbstractNoteResource` to match method signature.
  Method will always return an array.

## [0.5.5] - 2021-06-11
### Added
- Support for sending unstructured meta data on `AbstractNoteResource`.

## [0.5.4] - 2021-05-18
### Added
- Support for `productionPagesPerSheet` on `JobComponentResource`.

## [0.5.3] - 2021-04-19
## Added
- Support for `quantityMultiplier` on `JobResource` to optimise JobGroup support

## [0.5.2] - 2021-03-18
### Added
- `ArtifactResourceInterface`.

### Changed
- `ArtifactResource` now implements `ArtifactResourceInterface`.
- `ArtifactResource` uses `ResourceIdentityTrait`
- `getArtifacts` method added to `JobResourceInterface` and `JobResource`

### Fixed
- Fixed method `getArtifact` on `JobResource`. It can now return null.

## 0.5.1 - 2021-02-10
### Changed
- Support for `metaData` on `ArtifactResource`. 

## [0.5.0] - 2021-01-05
### Added
- Gang client for public usage - `GangDelegateClient.php`, `BrainClient.php`, `BrainClientInterface.php`, `ServiceContainerBuilder.php`.
- Gang Resource - `GangResource`, `GangResourceInterface`.

## [0.4.1] - 2020-09-29
### Added
- Support for overriding production house in job submission.
- Support for setting dimensions on a `JobComponentResource`.

## [0.4.0] - 2020-05-15
### Added
- Support availability in `StockFinishingsResource`.
- Exposed Production House in `StockFinishingsResource` and `DeliveryOptionResource`.

## [0.3.2] - 2020-04-02
### Added
- Exposed Jobs within a `JobGroupResource`.

## [0.3.1] - 2020-04-01
### Changed
- Created JobGroup client for public usage.

## [0.3.0] - 2020-04-01
### Added
- Added `JobGroup` for multiversion shop support.

## [0.2.1] - 2020-03-10
### Added
- Support for Custom Sizes in `ProductResource`.

## [0.2.0]
### Added
- DeliveryDelegateClientHelper
- BrainClientFactory. Use the factory instead of instantiating the client in your code.

### Changed
- [Breaking change] `BrainClient::__construct()` param list change. Use the `BrainClientFactory` instead. 
- [Breaking change] `ClientConfiguration::(get|set|has)ResourceHandler()` removed. 
- [Breaking change] `DeliveryJobBatchResource` renamed to `GetDeliveryOptionsArgs`.
- [Breaking change] `DeliveryDelegateClient::getDeliveryOptions()` param list change.

## 2019-01-08 (un-versioned)

* Everything is strictly-typed. Good luck.
* A bunch of interfaces added for referencing instead of resources.
* `Brain\Cell\Enum\JobStatusEnum` has been removed in favour of `Brain\Cell\EntityResource\Job\JobStatusResource`.
* `Brain\Cell\Enum\JobBatchStatusEnum` has been removed in favour of `Brain\Cell\EntityResource\Job\JobBatchStatusResource`.
* `Brain\Cell\EntityResource\Stock\FinishingCategoryResource` has been removed in favour of `Brain\Cell\EntityResource\Stock\Finishing\FinishingCategoryResource`.
* `Brain\Cell\EntityResource\Stock\FinishingItemResource` has been removed in favour of `Brain\Cell\EntityResource\Stock\Finishing\FinishingItemResource`.
* `getIdOrThrow()` has been removed, make use of `hasId()` and `getId()`
