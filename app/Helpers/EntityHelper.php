<?php

namespace App\Helpers;

use App\Models\Clinicaltrial;
use App\Models\Company;
use App\Models\Event;
use App\Models\Focus;
use App\Models\Investor;
use App\Models\Location;
use App\Models\Person;
use App\Models\Research;

class EntityHelper
{
    /**
     * @var array
     */
    private static $entities = [
        'clinicaltrials' => Clinicaltrial::class,
        'organizations'  => Company::class,
        'events'         => Event::class,
        'focus'          => Focus::class,
        'investors'      => Investor::class,
        'locations'      => Location::class,
        'people'         => Person::class,
        'research'       => Research::class,
    ];

    /**
     * @return array
     */
    public static function getEntities()
    {
        return self::$entities;
    }

    /**
     * @param string $alias
     * @return string|bool
     */
    public static function getClassByAlias(string $alias)
    {
        return isset(self::$entities[$alias]) ? self::$entities[$alias] : false;
    }

    /**
     * @param string $class
     * @return string|bool
     */
    public static function getAliasByClass(string $class)
    {
        return array_search($class, self::$entities);
    }

    /**
     * @param string $class
     * @return string|bool
     */
    public static function getImageSettingsByClass(string $class)
    {
        $mapping = [
            Person::class => [
                'field' => 'photo',
                'folder'  => 'people',
            ],
            Company::class  => [
                'field' => 'logo',
                'folder'  => 'logos',
            ],
            Investor::class => [
                'field' => 'logo',
                'folder'  => 'logos',
            ],
            Event::class    => [
                'field' => 'image',
                'folder'  => 'events',
            ],
        ];

        return isset($mapping[$class]) ? $mapping[$class] : false;
    }
}
