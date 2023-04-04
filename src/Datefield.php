<?php

namespace Centrust\Datefield;

use Laravel\Nova\Fields\Field;

class Datefield extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'datefield';




    public function format($format)
    {
        return $this->withMeta(['format' => $format]);
    }
}
