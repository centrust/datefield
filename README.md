# Laravel Nova Custom Datefield with Flatpickr
#### This package provides a custom date field for Laravel Nova that utilizes the popular flatpickr library. The field allows for easy selection of dates and includes all flatpickr options as a meta that can be added in an array to be used by the flatpickr configuration.

### Requirements
###### PHP >= 8.0
###### Laravel Nova >= 4.0
###### vue-flatpickr-component >= 11.0

### Note
This Package extends the Native Nova Date Field. you can use all the options provided by Nova in addition to a customizable flatpickr config oprions

#### This package supports only English and Arabic Locales. Hope to find a good way to make it dynamic in the future
### Installation
###### You can install the package via Composer:


```
composer require centrust/datefield

```

### Usage
To use the custom date field in your Laravel Nova application, simply add it to your resource's fields method:

```
use Centrust\Datefield\Datefield;

class YourResource extends Resource
{
    // ...

    public function fields(Request $request)
    {
        return [
            // ...

            Datefield::make('Date', 'date_field')
                ->options([
                    'dateFormat' => 'Y-m-d',
                    'altInput' => true,
                    'altFormat' => 'F j, Y',
                ]),

            // ...
        ];
    }

    // ...
}


```

In the example above, the options method is used to pass an array of flatpickr options to the date field. You can add any available option to this array, including callbacks and hooks.

Available Options
The following flatpickr options are available for use with the custom date field:

* allowInput: boolean
* altFormat: string
* altInput: boolean
* altInputClass: string
* appendTo: HTMLElement
* ariaDateFormat: string
* clickOpens: boolean
* dateFormat: string
* defaultDate: string, Date, or number
* defaultHour: number
* defaultMinute: number
* disable: array or function
* disableMobile: boolean
* enable: array or function
* enableTime: boolean
* enableSeconds: boolean
* errorHandler: function
* getWeek: function
* hourIncrement: number
* ignoredFocusElements: NodeList
* inline: boolean
* maxDate: string, Date, or number
* minDate: string, Date, or number
* minuteIncrement: number
* mode: string
* nextArrow: string or HTMLElement
* noCalendar: boolean
* onChange: function
* onClose: function
* onDayCreate: function
* onDestroy: function
* onMonthChange: function
* onOpen: function
* onParseConfig: function
* onReady: function
* onValueUpdate: function
* parseDate: function
* plugins: array
* position: string or function
* prevArrow: string or HTMLElement
* roundMinutes: boolean
* shorthandCurrentMonth: boolean
* showMonths: number
* static: boolean
* time_24hr: boolean
* weekNumbers: boolean
* wrap: boolean

For more information on each option, see the [flatpickr](https://flatpickr.js.org/) documentation.

### Preset Options
The following preset options are added by default to the configuration:

* locale:  It will resolve to the current locale of the application. you need to add the locale file in the flatpickr folder in the public folder of your application
* This version only supports Arabic and English locales. Hope to find a good way to make it dynamic in the future (Any Contribution is welcome)

### Theme
* The system is using the default flatpickr themes Dark and Light. 
