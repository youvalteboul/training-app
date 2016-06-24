<?php

namespace AppBundle\Util;

class Slugger
{
    public function slugify($content)
    {
        $slug = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $content));
        return $slug;
    }
}
