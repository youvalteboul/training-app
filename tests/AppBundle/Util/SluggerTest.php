<?php

namespace Tests\AppBundle\Util;

use AppBundle\Util\Slugger;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DefaultControllerTest extends WebTestCase
{
    public function testSlugify()
    {
        $slugger = new Slugger();

        $slug = $slugger->slugify('Advanced slug test title');
        $this->assertEquals('advanced-slug-test-title', $slug);
    }
}
