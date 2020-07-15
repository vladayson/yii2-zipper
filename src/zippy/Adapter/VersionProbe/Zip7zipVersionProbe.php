<?php

namespace vladayson\zipper\zippy\Adapter\VersionProbe;

use Alchemy\Zippy\ProcessBuilder\ProcessBuilderFactoryInterface;
use Alchemy\Zippy\Adapter\VersionProbe\VersionProbeInterface;

/**
 * Class Zip7zipVersionProbe
 * @package vladayson\zipper\zippy\Adapter\VersionProbe
 */
class Zip7zipVersionProbe implements VersionProbeInterface
{
    /** @var bool */
    private $isSupported;

    /** @var ProcessBuilderFactoryInterface  */
    private $inflator;

    /** @var ProcessBuilderFactoryInterface  */
    private $deflator;

    /**
     * Zip7zipVersionProbe constructor.
     * @param ProcessBuilderFactoryInterface $inflator
     * @param ProcessBuilderFactoryInterface $deflator
     */
    public function __construct(ProcessBuilderFactoryInterface $inflator, ProcessBuilderFactoryInterface $deflator)
    {
        $this->inflator = $inflator;
        $this->deflator = $deflator;
    }

    /**
     * Set the inflator to zip
     *
     * @param  ProcessBuilderFactoryInterface $inflator
     * @return ZipVersionProbe
     */
    public function setInflator(ProcessBuilderFactoryInterface $inflator)
    {
        $this->inflator = $inflator;

        return $this;
    }

    /**
     * Set the deflator to unzip
     *
     * @param  ProcessBuilderFactoryInterface $deflator
     * @return ZipVersionProbe
     */
    public function setDeflator(ProcessBuilderFactoryInterface $deflator)
    {
        $this->deflator = $deflator;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getStatus()
    {
        
        if (null !== $this->isSupported) {
            return $this->isSupported;
        }

        if (null === $this->inflator) {
            return $this->isSupported = VersionProbeInterface::PROBE_NOTSUPPORTED;
        }


        $processInflate = $this
            ->inflator
            ->create()
            ->getProcess();

        $processInflate->run();

        if (false === $processInflate->isSuccessful()) {
            return $this->isSupported = VersionProbeInterface::PROBE_NOTSUPPORTED;
        }
        $output = $processInflate->getOutput();

        $inflatorOk = false !== stripos($output, '7-Zip');


        return $this->isSupported = ($inflatorOk) ? VersionProbeInterface::PROBE_OK : VersionProbeInterface::PROBE_NOTSUPPORTED;
    }
}
