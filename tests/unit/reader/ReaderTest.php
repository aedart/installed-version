<?php
use Aedart\Installed\Version\Contracts\Reader as ReaderInterface;
use Codeception\Util\Debug;

/**
 * ReaderTest
 *
 * @group reader
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 */
class ReaderTest extends ReaderUnitTestCase
{
    /********************************************************
     * Helpers
     *******************************************************/

    /**
     * Data provider
     *
     * @return array
     */
    public function fixtures()
    {
        return [
            'aedart/installed-version'  =>  ['aedart/installed-version', true],
            'illuminate/support'        =>  ['illuminate/support', true],
            'acme/bombs'                =>  ['acme/bombs', false, false, ReaderInterface::DEFAULT_VERSION],
            'phpunit/php-code-coverage' =>  ['phpunit/php-code-coverage', true],
        ];
    }

    /********************************************************
     * Actual tests
     *******************************************************/

    /**
     * @test
     */
    public function canObtainInstance()
    {
        $reader = $this->makeReader();

        $this->assertNotNull($reader);
    }

    /**
     * @test
     */
    public function hasDefaultLocations()
    {
        $reader = $this->makeReader();

        $this->assertNotEmpty($reader->getLocations());
    }

    /**
     * @test
     *
     * @dataProvider fixtures
     *
     * @param string $package
     * @param bool $expectedFound [optional]
     * @param bool $expectUnknownVersion [optional] Only tested if expected found is true
     * @param string|null $expectedVersion [optional]
     */
    public function canReadVersion($package, $expectedFound = true, $expectUnknownVersion = false, $expectedVersion = null)
    {
        $reader = $this->makeReader();

        $version = $reader->getVersion($package);

        Debug::debug($package . ' ' . $version);

        // Should a version be found
        if($expectedFound){
            $this->assertNotNull($version, 'Should had found version for ' . $package);

            // Should version be unknown?
            if($expectUnknownVersion){
                $this->assertSame(ReaderInterface::DEFAULT_VERSION, $version);
            } else {
                $this->assertNotEquals(ReaderInterface::DEFAULT_VERSION, $version);
            }
        }

        if(isset($expectedVersion)){
            $this->assertSame($expectedVersion, $version, 'Versions do not match!');
        }
    }
}