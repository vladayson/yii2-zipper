<?php

namespace vladayson\zipper\zippy\FileStrategy;

use Alchemy\Zippy\FileStrategy\AbstractFileStrategy;

class Zip7zipFileStrategy extends AbstractFileStrategy
{
 
    /**
     * {@inheritdoc}
     */
    protected function getServiceNames()
    {
        return array(
            'Victor78\\ZippyExt\\Adapter\\Zip7zipAdapter',
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getFileExtension()
    {
        return '7zip';
    }
}
