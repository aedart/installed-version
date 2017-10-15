<?php
declare(strict_types=1);

namespace Aedart\Installed\Version\Traits;

/**
 * LocationsTrait
 *
 * @see \Aedart\Installed\Version\Contracts\LocationsAware
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\Installed\Version\Traits
 */
trait LocationsTrait
{
    /**
     * List of locations
     *
     * @var string[]|null
     */
    protected $locations = null;

    /**
     * Set locations
     *
     * @param string[]|null $locations List of locations
     *
     * @return self
     */
    public function setLocations(?array $locations)
    {
        $this->locations = $locations;

        return $this;
    }

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
    public function getLocations(): ?array
    {
        if (!$this->hasLocations()) {
            $this->setLocations($this->getDefaultLocations());
        }
        return $this->locations;
    }

    /**
     * Check if locations has been set
     *
     * @return bool True if locations has been set, false if not
     */
    public function hasLocations(): bool
    {
        return isset($this->locations);
    }

    /**
     * Get a default locations value, if any is available
     *
     * @return string[]|null A default locations value or Null if no default value is available
     */
    public function getDefaultLocations(): ?array
    {
        return null;
    }
}