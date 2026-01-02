# Changelog

All notable changes to `ralphjsmit/laravel-filament-activitylog` will be documented in this file.

## 2.0.5 - 2025-12-02

- Feat: support for Timeline `extraAttributes()` method

## 2.0.4 - 2025-11-27

- Fix: remove negative space at bottom of timeline

## 2.0.3 - 2025-09-30

- Fix: timeline placed on page with `ActionGroup`

## 2.0.2 - 2025-09-24

- Feat: allow formatting callbacks based on uncasted raw value

## 1.9.7 - 2025-09-24

- Feat: allow formatting callbacks based on uncasted raw value

## 2.0.1 - 2025-09-10

- Fix: do not automatically generate URLs for nested resources

## 1.9.6 - 2025-08-30

- Feat: ability to sort activities ascending instead of descending.
- Fix: changing a value to an empty field on a timeline without changes summary visible.

## 2.0.0-beta3 - 2025-08-08

- Feat: add icon enum support

## 2.0.0-beta2 - 2025-07-02

- Fix: prevent cut-offs of last activity on non-scrollable heights

## 2.0.0-beta1 - 2025-06-28

- Feat: Filament V4 support

## 1.9.5 - 2025-06-21

- Feat: ability to customize record URL generation.

## 1.9.4 - 2025-05-26

- Feat: ability to disable batches.

## 1.9.3 - 2025-03-28

- Feat: allow hiding old and/or new attribute values in changes summary on a per attribute basis.
- Chore: allow `CarbonInterface` timestampt.

## 1.9.2 - 2025-03-15

- Feat: let formatted `Carbon` instances adhere to current locale

## 1.9.1 - 2025-03-07

- Feat: ability to modify retrieved activities.

## 1.9.0 - 2025-02-25

- Feat: Laravel 12 support

## 1.8.5 - 2025-01-18

- Fix: remove duplicate unique check.

## 1.8.4 - 2025-01-18

- Fix: handle JsonSerializable contract returning a non-array value
- Fix: do not escape non-string array children values

## 1.8.3 - 2025-01-18

- Chore: add additional unique handling for custom selected `batch_uuid`s via `->modifyActivitiesQueryUsing()`.
- Fix: correctly applying escaping on attribute cast and value callbacks.

## 1.8.2 - 2024-12-26

- Feat: add CSS classes to target activitylog.

## 1.8.1 - 2024-12-26

- Feat: ability to modify event descriptions & set causer URL.
- Feat: add support for generating descriptions for blank original values.

## 1.8.0 - 2024-10-24

- Feat: add `->itemDateTimeTimezone()` method.
- Feat: ability to include previous/old attribute values in `updated` (and other) descriptions.
- Feat: add default translatable label to `TimelineAction`.
- Fix: improve timeline design with search bar.

## 1.7.1 - 2024-08-27

- Fix: sort inline batch links to be first to link to parent activity

## 1.7.0 - 2024-07-10

- Feat: add support for item badges.
- Feat: add ability to modify activities callback without overriding entire logic.
- Fix: event descriptions html.

## 1.6.5 - 2024-07-04

- Feat: optimize timeline items for deleted records

## 1.6.4 - 2024-07-02

- Fix: potential error when using timeline action within custom Livewire component.

## 1.6.3 - 2024-07-01

- Feat: add ability to provide callbacks for custom causer names.
- Fix: usage of timeline action within custom Livewire components.

## 1.6.2 - 2024-06-11

- Fix: use policy to check for related record url permissions.

## 1.6.0 - 2024-06-05

- Feat: show related record title, automatic resource links.
- Feat: allow hiding attribute values in changes summary.

## 1.5.14 - 2024-05-17

- Feat: update search bar input component

## 1.5.13 - 2024-05-17

- Fix: improve design of searchable input where focus ring sometimes partially got cut off.
- Fix: add fallback for when causer does not have a name.
- Fix: accessing wrong translation key for a relationship.

## 1.5.12 - 2024-05-15

- Fix: edge case with subject scopes and deleted subjects.

## 1.5.11 - 2024-05-13

- Apply fix for duplicate batch groups also to timelines with a custom activity query.

## 1.5.10 - 2024-05-13

- Fix: sometimes only latest items showing in timeline.

## 1.5.8 - 2024-04-29

- Fix: make subject calls nullable.

## 1.5.6 - 2024-04-19

- Fix: activity items can assume labels

## 1.5.4 - 2024-04-17

- Fix: date/datetime casts with arguments.

## 1.5.3 - 2024-04-13

- Feat: add support for items/attributes changed to `null`.

## 0.1.5 - 2024-04-09

- Fix: improve native handling of JSON/array/collection casts.

## 1.5.2 - 2024-04-09

- Fix: improve native handling of JSON/array/collection casts.

## 1.5.1 - 2024-04-03

- Fix: call to getModel() on infolist timelines.

## 1.5.0 - 2024-03-29

- Feat: add support for related models.

## 1.4.1 - 2024-03-29

- Feat: improve auto-formatting of date/time.

## 1.4.0 - 2024-03-21

- Laravel 11.x Compatibility.

## 1.3.2 - 2024-03-02

- Fix: styling of custom empty state icons.

## 0.1.4 - 2024-02-12

- Feat: update styling voor empty state & secondary color.

## 0.1.3 - 2024-02-12

- Fix: modelLabel port.

## 0.1.2 - 2024-02-12

- Fix: Heroicon name not available in V3.

## 0.1.1 - 2024-02-12

- Fix: access unavailable form attribute.

## 1.3.1 - 2024-02-12

- Fix: issue with model label on empty state.

## 0.1.0 - 2024-02-10

- Feat: initial Filament V2 support.

## 1.3.0 - 2024-02-10

- Feature: allow full attribute casting!
- Feature: add support for custom model labels.
- Fix: causer with only first name or last name.
- Fix: error arguments for infolists.
