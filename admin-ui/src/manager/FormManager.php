<?php

namespace Tadm\ui\manager;



use Tadm\ui\component\form\driver\Arrays;
use Tadm\ui\component\form\driver\File;
use Tadm\ui\component\form\Form;
use Tadm\ui\contract\FormAbstract;


class FormManager extends Manager
{
    public function setDriver($repository,$component)
    {
        if (is_array($repository)) {
            $this->driver = new Arrays();
        } elseif ($repository instanceof FormAbstract) {
            $this->driver = $repository;
        } elseif (is_string($repository) && is_file($repository)){
            $this->driver = new File();
        }
    }
}
