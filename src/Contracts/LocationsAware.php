<?php

namespace Aedart\Installed\Version\Contracts;

/**
 * Locations Aware
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\Installed\Version\Contracts
 */
interface LocationsAware
{
    /**
     * Set locations
     *
     * @param string[]|null $locations List of locations
     *
     * @return self
     */
    public function setLocations(?array $locations);

    /**
     * Get locations
     *
     * If no locations has been set, this method will
     * set and return a default locations, if any such
     * value is available
     *
     * @see getDefaultLocations()
     *
     * @return string[]|null locations or null if none locations has been set
     */
    public function getLocations(): ?array;

    /**
     * Check if locations has been set
     *
     * @return bool True if locations has been set, false if not
     */
    public function hasLocations(): bool;

    /**
     * Get a default locations value, if any is available
     *
     * @return string[]|null A default locations value or Null if no default value is available
     */
    public function getDefaultLocations(): ?array;
}