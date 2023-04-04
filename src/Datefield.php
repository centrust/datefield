<?php

namespace Centrust\Datefield;

use Laravel\Nova\Fields\Field;

class Datefield extends Field
{

    public function __construct($name, $attribute = null, callable $resolveCallback = null)
    {
        $Field = 'ok';
        parent::__construct($name, $attribute, $resolveCallback);
        $defaultOptions = [
            'enableTime' => false,
            'dateFormat' => 'Y-m-d',
            'altInput' => true,
            'altFormat' => 'Y-m-d',
            'defaultDate'=> $this->value,
            'time_24hr' => true,
            'allowInput' => true,
            'locale' => app()->getLocale(),
        ];
        $this->withMeta(['options' =>$defaultOptions]);
    }


    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'datefield';




    public function options(array $optons)
    {
        $optons['locale'] = $optons['locale']??app()->getLocale();

        return $this->withMeta(['options' => $optons]);
    }
}
