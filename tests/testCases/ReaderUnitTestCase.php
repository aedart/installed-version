<?php

use Aedart\Installed\Version\Reader;
use Aedart\Testing\TestCases\Unit\UnitTestCase;

/**
 * Reader Unit TestCase
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 */
abstract class ReaderUnitTestCase extends UnitTestCase
{

    /**
     * Returns a new Reader instance
     *
     * @return Reader
     */
    public function makeReader()
    {
        return new Reader();
    }

}