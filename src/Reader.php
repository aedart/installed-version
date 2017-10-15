<?php
declare(strict_types=1);

namespace Aedart\Installed\Version;

use Aedart\Installed\Version\Contracts\Reader as ReaderInterface;
use Aedart\Installed\Version\Traits\LocationsTrait;
use Composer\Factory as ComposerFactory;

/**
 * <h1>Installed Version Reader</h1>
 *
 * Searches for matching package in composer's "installed.json"
 * file inside the local or global vendor directory. If a version
 * is defined, it is returned. Otherwise, a default "unknown"
 * version is returned.
 *
 * @see \Aedart\Installed\Version\Contracts\Reader
 *
 * @author Alin Eugen Deac <aedart@gmail.com>
 * @package Aedart\Installed\Version
 */
class Reader implements ReaderInterface
{
    use LocationsTrait;

    /**
     * List of installed packages
     *
     * @var array
     */
    protected $installedPackages = [];

    /**
     * {@inheritdoc}
     */
    public function getVersion(string $package) : string
    {
        $locations = $this->getLocations();

        foreach ($locations as $location){
            $version = $this->readVersionFromLocation($location, $package);
            if(isset($version)){
                return $version;
            }
        }

        // If reached here, then we found nothing. Therefore, we make one last
        // attempt to read the composer file inside the current work directory
        // - the package we search for might just match it!
        // This will only be true during development!
        $composerFile = getcwd() . '/composer.json';
        if(!file_exists($composerFile)){
            return self::DEFAULT_VERSION;
        }

        $version = $this->readFromSource($this->loadJsonFile($composerFile), $package);
        if(isset($version)){
            return $version;
        }

        // Finally, nothing was found and we must therefore use fallback...
        return self::DEFAULT_VERSION;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultLocations() : ?array
    {
        $composerConfig = ComposerFactory::createConfig(null, getcwd());

        return [
            // Local vendor dir
            $composerConfig->get('vendor-dir') . '/composer/',

            // Global vendor dir
            ComposerFactory::createConfig(null, $composerConfig->get('home'))->get('vendor-dir') . '/composer/'
        ];
    }

    /**
     * Attempts to read the version from the given location
     *
     * @param string $location
     * @param string $package
     * @return null|string Version or null if no version found for package
     */
    protected function readVersionFromLocation(string $location, string $package) : ?string
    {
        // Get the installed packages
        $installed = $this->getInstalledPackages($location);
        if(empty($installed)){
            return null;
        }

        // Search for package
        foreach ($installed as $installedPackage){
            $version = $this->readFromSource($installedPackage, $package);
            if(isset($version)){
                return $version;
            }
        }

        // Nothing found in this package
        return null;
    }

    /**
     * Attempts to read a "version" property on the source
     * and return it.
     *
     * @param array $source Composer file or installed package
     * @param string $package Name of package we are looking for
     *
     * @return string|null Version or null if not found
     */
    protected function readFromSource(array $source, string $package) : ?string
    {
        // Abort if no name property
        if(!isset($source['name'])){
            return null;
        }

        // Abort if name is not the same a package name
        if($source['name'] != $package){
            return null;
        }

        // At this point it means that the package matches.
        // We check for a version property.
        if(isset($source['version'])){
            return $source['version'];
        }

        // This means that no version property existed - which
        // could mean that the source is an actual composer file.
        // Therefore, we check if there is an branch alias
        // specified. (dev-master assumed)
        if(isset($source['extra']['branch-alias']['dev-master'])){
            return $source['extra']['branch-alias']['dev-master'];
        }

        // Sadly, if reached here then there is no version available
        // nor a branch alias. Therefore, we can only return a default
        // version...
        return self::DEFAULT_VERSION;
    }

    /**
     * Returns the "installed" packages found at the given
     * location
     *
     * @param string $location
     *
     * @return array
     */
    protected function getInstalledPackages(string $location) : array
    {
        if(isset($this->installedPackages[$location])){
            return $this->installedPackages[$location];
        }

        $installedFile = $location . 'installed.json';
        if(!file_exists($installedFile)){
            return [];
        }

        return $this->installedPackages[$location] = $this->loadJsonFile($installedFile);
    }

    /**
     * Loads and decodes a json file
     *
     * @param string $file
     *
     * @return array
     */
    protected function loadJsonFile(string $file) : array
    {
        return json_decode(file_get_contents($file), true);
    }
}