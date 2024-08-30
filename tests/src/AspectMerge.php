<?php

/**
 * for test
 */

namespace __Test;

use Ytake\LaravelAspect\Annotation\Cacheable;
use Ytake\LaravelAspect\Annotation\CacheEvict;

/**
 * Class AspectMerge
 */
class AspectMerge implements AspectMergeInterface
{
    /**
     *
     * @CacheEvict(tags={"testing1","testing2"},key={"#id"})
     * @Cacheable(tags={"testing1","testing2"},key={"#id"})
     * @param           $id
     * @return mixed
     */
    public function caching($id)
    {
        return $id;
    }
}
