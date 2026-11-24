Zend Framework 1 - File
============================
[![Build](https://github.com/gizmocraftcom/zf1-file/workflows/Build/badge.svg?event=push)](https://github.com/gizmocraftcom/zf1-file/actions?query=workflow%3ABuild+event%3Apush)
[![codecov](https://codecov.io/gh/gizmocraftcom/zf1-file/branch/master/graph/badge.svg)](https://codecov.io/gh/gizmocraftcom/zf1-file)
[![Latest Stable Version](https://poser.pugx.org/gizmocraft/zendframework1-file/v/stable)](https://packagist.org/packages/gizmocraft/zendframework1-file)
[![Total Downloads](https://poser.pugx.org/gizmocraft/zendframework1-file/downloads)](https://packagist.org/packages/gizmocraft/zendframework1-file)
[![License](https://poser.pugx.org/gizmocraft/zendframework1-file/license)](https://packagist.org/packages/gizmocraft/zendframework1-file)


This is just the Zend_File component extracted from our fork of the Zend Framework 1 repo (https://github.com/gizmocraftcom/zf1).

Originally forked from the upstream repository https://github.com/diablomedia/zf1-file. Copyright and license of the original authors are kept in LICENSE.txt.

Requires PHP 8.5 or newer (tested on 8.5 and 8.6). See CHANGELOG.md for changes compared to upstream.

## Progress adapters (APC, uploadprogress)

`Zend_File_Transfer_Adapter_Http::getProgress()`, `isApcAvailable()` and `isUploadProgressAvailable()` use the `apc` and `uploadprogress` PHP extensions. Neither extension has a release for PHP 8.5 or 8.6. The methods are kept and marked `@deprecated`; without one of the extensions `getProgress()` throws `Zend_File_Transfer_Exception`. The three progress tests are skipped when no extension is installed, as upstream.
