<?php
namespace Aedart\Installed\Version\Contracts;

use Aedart\Model\Contracts\Arrays\LocationsAware;

/**
 * <h1>Installed Version Reader Interface</h1>
 *
 * Is able to read the version of a given package, provided
 * that the package exists (is installed).
 *
 * <br />
 *
 * How this reader searches and finds a given package's version,
 * is entirely depending upon implementation
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\Installed\Version\Contracts
 */
interface Reader extends LocationsAware
{
    /**
     * Default version that reader will return
     * if unable to get the version
     */
    const DEFAULT_VERSION = 'Unknown';

    /**
     * Get the version of an installed package
     *
     * <br />
     *
     * Method will search in the provided locations
     *
     * @see \Aedart\Model\Contracts\Arrays\LocationsAware::getLocations
     * @see \Aedart\Installed\Version\Contracts\Reader::DEFAULT_VERSION
     *
     * @param string $package Composer package
     *
     * @return string Returns version OR default version if unable
     *                to read package information.
     */
    public function getVersion($package);
}