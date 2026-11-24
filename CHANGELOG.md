# Changelog

## 2.0.0

Fork of `diablomedia/zendframework1-file`, published as `gizmocraft/zendframework1-file`.

### Breaking changes

- Requires PHP `>=8.5`. Tested on PHP 8.5 and 8.6.
- Package renamed from `diablomedia/zendframework1-file` to `gizmocraft/zendframework1-file`. It now requires `gizmocraft/zendframework1-exception` `^2.0.0`, `-loader` `^2.0.0`, `-filter` `^2.0.0`, `-progressbar` `^2.0.0`, `-translate` `^2.0.0`, `-validate` `^2.0.0` and `-validate-file` `^2.0.0`.

### Fixes

- PHP 8.6 throws a `ValueError` from `file_exists()`, `is_dir()` and `move_uploaded_file()` for paths containing NUL bytes. `Zend_File_Transfer_Adapter_Abstract` (`getHash()`, `getFileSize()`, `getMimeType()` and the size/mime detection when the adapter is built) treats such a file name as a missing file. `setDestination()` throws `Zend_File_Transfer_Exception` and `Zend_File_ClassFileLocator::__construct()` throws `InvalidArgumentException` for such a directory, as for any other invalid directory. `Zend_File_Transfer_Adapter_Http::receive()` reports a failed move.
- New protected method `Zend_File_Transfer_Adapter_Abstract::_fileExists()` (NUL-safe `file_exists()`). No existing public or protected signature changed.
- Test fix: `HttpTest::testNoUploadInProgress` compared a string against the whole status array (hidden by the skip).

### Deprecated

- `Zend_File_Transfer_Adapter_Http::getProgress()`, `isApcAvailable()` and `isUploadProgressAvailable()` rely on the `apc` and `uploadprogress` extensions, which have no releases for PHP 8.5/8.6. They are kept, documented and marked `@deprecated`; nothing was removed. The three progress tests are skipped when neither extension is installed, as upstream.

### Other changes

- Dev dependencies upgraded (PHPUnit 13, PHPStan 2.3, php-cs-fixer 3.95, GrumPHP 2.27). Dropped `composer-require-checker`, which has no release for PHP 8.6.
- Tests migrated to PHPUnit 13 attributes (`#[Group]`); `phpunit.xml.dist` fails on warnings and risky tests. Added `NullByteTest`.
- CI runs PHP 8.5 and 8.6.
