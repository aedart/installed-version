<?php

use Aedart\Testing\GST\GetterSetterTraitTester;
use Aedart\Testing\TestCases\Unit\UnitTestCase;

/**
 * Trait Test-Case
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 */
abstract class TraitTestCase extends UnitTestCase
{
    use GetterSetterTraitTester;
}