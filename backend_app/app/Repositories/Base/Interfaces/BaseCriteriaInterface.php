<?php

namespace App\Repositories\Base\Interfaces;

use App\Repositories\Base\BaseCriteria;

interface BaseCriteriaInterface
{
    public function skipCriteria($status = true);

    public function getCriteria();

    public function getByCriteria(BaseCriteria $criteria);

    public function pushCriteria(BaseCriteria $criteria);

    public function applyCriteria();
}
