<?php

namespace Tadm\ui\manager;




use Tadm\ui\contract\EchartAbstract;

class EchartManager extends Manager
{
    public function setDriver($repository,$component)
    {
        if ($repository instanceof EchartAbstract) {
            $this->driver = $repository;
        }
    }
}
