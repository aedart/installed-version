<?php

/**
 * LocationsTraitTest
 *
 * @group traits
 * @group locations-trait
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 */
class LocationsTraitTest extends TraitTestCase
{
    /**
     * @test
     */
    public function canInvokeMethods()
    {
        $locations = [
            $this->faker->word,
            $this->faker->word,
            $this->faker->word,
        ];

        $this->assertGetterSetterTraitMethods(
            \Aedart\Installed\Version\Traits\LocationsTrait::class,
            $locations,
            $locations
        );
    }
}