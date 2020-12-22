<?php

namespace Bernhardh\NovaIconSelect;

use Laravel\Nova\Fields\Select;

class NovaIconSelect extends Select
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'nova-icon-select';
    /**
     * @var bool
     */
    public $searchable = true;
    /**
     * @var IconProvider
     */
    protected $iconProvider;
    
    


//    /**
//     * Display values using their corresponding specified labels.
//     *
//     * @param bool $includeLabel
//     *
//     * @return $this
//     */
//    public function displayUsingIcons(bool $includeLabel = false) {
//        return $this->displayUsing(function ($value) use ($includeLabel) {
//            $first = collect($this->meta['options'])
//                       ->where('value', $value)
//                       ->first();
//
//            if($first) {
//                return call_user_func($this->renderIconCallback, $first) . ($includeLabel ? $first['label'] : '');
//            }
//
//            return $value;
//        });
//    }
    
    
    /**
     * @param string|IconProvider $iconProvider
     *
     * @return $this
     */
    public function setIconProvider($iconProvider) : self {
        if(is_string($iconProvider)) {
            $iconProvider = new $iconProvider();
        }
        $this->iconProvider = $iconProvider;
        
        $this->options($iconProvider->getOptions());
        
        return $this;
    }

//
//    /**
//     * @return $this
//     */
//    public function useFontAwesome() {
//        return $this->renderIconUsing(function($option) {
//            return '<i class="' . $option['icon'] . '"></i>';
//        });
//    }
//
//
//    /**
//     * @param callable $callback
//     *
//     * @return $this
//     */
//    public function renderIconUsing(callable $callback) {
//        $this->renderIconCallback = $callback;
//
//        return $this;
//    }
}
