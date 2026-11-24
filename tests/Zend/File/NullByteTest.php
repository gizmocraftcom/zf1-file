<?php
/**
 * Paths containing NUL bytes must be handled as non-existing files. PHP 8.6 throws a ValueError
 * from file_exists(), is_dir() and similar functions for such paths.
 */

use PHPUnit\Framework\Attributes\Group;

#[Group('Zend_File')]
class Zend_File_NullByteTest extends PHPUnit\Framework\TestCase
{
    public function tearDown(): void
    {
        $_FILES = array();
    }

    public function testHttpAdapterTreatsFileNameWithNulByteAsMissing(): void
    {
        $_FILES = array(
            'txt' => array(
                'name'     => "te\0st.txt",
                'type'     => 'plain/text',
                'size'     => 8,
                'tmp_name' => "/tmp/php\0upload",
                'error'    => 0));

        $adapter = new Zend_File_Transfer_Adapter_Http();
        $adapter->setOptions(array('ignoreNoFile' => false));

        $this->assertNull($adapter->getFileInfo('txt')['txt']['size']);
        $this->assertNull($adapter->getFileInfo('txt')['txt']['type']);

        $this->expectException(Zend_File_Transfer_Exception::class);
        $this->expectExceptionMessage('does not exist');
        $adapter->getHash('crc32', 'txt');
    }

    public function testSetDestinationWithNulByteThrowsTransferException(): void
    {
        $_FILES  = array();
        $adapter = new Zend_File_Transfer_Adapter_Http();

        $this->expectException(Zend_File_Transfer_Exception::class);
        $this->expectExceptionMessage('not a directory');
        $adapter->setDestination("/tmp\0x");
    }

    public function testClassFileLocatorWithNulByteInDirectoryThrowsInvalidArgumentException(): void
    {
        $this->expectException(InvalidArgumentException::class);
        new Zend_File_ClassFileLocator("/tmp\0x");
    }
}
