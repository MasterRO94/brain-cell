# Changelog
All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [0.5.25] - 2022-05-11
### Added
- GetDeliveryOptionsOptionsResource::$endOfProductionDictatedByShop

### Changed
- Backwards compatibility: DeliveryOptionResource::getLifetimeFinishDate() -- continue not returning null, even though
  the value in question is now nullable.

## [0.5.24] - 2022-02-02
### Added
- The following getters that are already defined on `JobResource` to `JobResourceInterface`
  - `getQueries(): ResourceCollection`
  - `getPhase(): ?PhaseResource`
  - `getPreflightFailurePolicy(): string`
  - `getStatus(): JobStatusResource`
  - `getClients(): ResourceCollection`
  - `getDimensions(): ThreeDimensionalResource`
  - `getArtifact(): ?ArtifactResource`
  - `getClonedFrom(): ?JobResource`


## [0.5.23] - 2022-01-28
### Added
- GetDeliveryOptionsOptionsResource::$extraProductionTimeDays

## [0.5.22] - 2022-01-24
### Changed
- Added filter support for JobQueryNoteSuggestions API call.

## [0.5.21] - 2022-01-13
### Added
- Endpoint for retrieving JobQueryNoteSuggestions.

## [0.5.20] - 2022-01-13
### Added
- `JobQueryNoteSuggestionResource`
- `JobQueryNoteSuggestionResourceInterface`
- `JobQueryDelegateClient::postJobQueryNoteSuggestion`
- `JobQueryNoteResource::getNoteSuggestions`, `JobQueryNoteResource::setNoteSuggestions`
- `JobQuerySummaryResource::getNoteSuggestions`
- `JobQuerySummaryResourceInterface::getNoteSuggestions`

## [0.5.19] - 2021-12-02
### Added
- Support for adding additional artifacts to a Job.

## [0.5.18] - 2021-11-25
### Changed
- `ClientWorkflowResource` implements `ClientWorkflowResourceInterface`
- `TransitionResource` implements `TransitionResourceInterface`
- `ClientWorkflowDelegateClient` so that `getClientWorkflow` and 
  `postClientWorkflow` return `ClientWorkflowResourceInterface`

### Added
- `ClientWorkflowResourceInterface`
- `TransitionResourceInterface`
- transitions to client workflow 
  `ClientWorkflowResource::ClientWorkflowResource`, `ClientWorkflowResource::setTransitions`

### Removed
- transitions from phase 
  `PhaseResource::getTransitions`, `PhaseResource::setTransitions` 

### Fixed
- `ClientWorkflowResource::getStatus` return a string. It was incorrectly
  returning `JobStatusResource`.

## [0.5.17] - 2021-11-25
### Fixed
- Fixed incorrect return type for `JobQueryResource::getAssignee()` as Queries can be unassigned.

## [0.5.16] - 2021-11-11
### Added
- Add support for the TurnaroundResource

### Deprecated
- ProductionStrategyResource

## [0.5.15] - 2021-11-10
### Added
- Add support for the new Brain api error type: CommonClientError.

## [0.5.14] - 2021-11-09
### Fixed
- Fixed issue with incorrect payload data being sent for async.
- Added missing Content-Type header.

## [0.5.13] - 2021-11-08
### Added
- Add ability to set the primaryProductionHouse option for the delivery/options endpoint.

## [0.5.12] - 2021-11-01
### Added
- Support for async job status transition API calls.

## [0.5.11] - 2021-11-01
### Added
- Support for async job resource API calls.

### Changed
- Updated `JobComponentResourceInterface` to better match the implementation.

## [0.5.10] - 2021-09-27
### Changed
- `JobResourceInterface` extends:
  - `UpdatedAtInterface`
  - `CreatedAtInterface`

## [0.5.9] - 2021-08-25
### Fixed
- `JobBatchResource::createdAt` and `JobBatchResource::updatedAt` were
  incorrectly returning arrays. They will now return `DateResource` object as
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
