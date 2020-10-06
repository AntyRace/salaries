<?php

namespace App\Dictionary;

class Perk
{
    /**
     * Static perk name
     */
    const TYPE_STATIC = 'static';

    /**
     * Percentage perk name
     */
    const TYPE_PERCENTAGE = 'percentage';

    /**
     * All available types
     */
    const TYPES = [
        self::TYPE_STATIC,
        self::TYPE_PERCENTAGE,
    ];
}
