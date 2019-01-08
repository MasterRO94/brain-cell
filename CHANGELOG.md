# CHANGELOG

### 2019-01-08

* Everything is strictly-typed. Good luck.
* A bunch of interfaces added for referencing instead of resources.
* `Brain\Cell\Enum\JobStatusEnum` has been removed in favour of `Brain\Cell\EntityResource\Job\JobStatusResource`.
* `Brain\Cell\Enum\JobBatchStatusEnum` has been removed in favour of `Brain\Cell\EntityResource\Job\JobBatchStatusResource`.
* `Brain\Cell\EntityResource\Stock\FinishingCategoryResource` has been removed in favour of `Brain\Cell\EntityResource\Stock\Finishing\FinishingCategoryResource`.
* `Brain\Cell\EntityResource\Stock\FinishingItemResource` has been removed in favour of `Brain\Cell\EntityResource\Stock\Finishing\FinishingItemResource`.
* `getIdOrThrow()` has been removed, make use of `hasId()` and `getId()`
