<?php

namespace Bernhardh\NovaIconSelect;

class IconProvider {
    /**
     * @var array
     */
    protected $options = [];
    
    
    /**
     * @return static
     */
    public static function make(): self {
        return new static();
    }
    
    
    /**
     * @param string      $label
     * @param string      $value
     * @param string|null $icon
     * @param array       $search
     *
     * @return IconProvider
     */
    public function addOption(string $label, string $value, ?string $icon, array $search = []): self {
        if(!$icon) $icon = $value;
        
        $new = [
            "label" => $label,
            "value" => $value,
            "icon" => $icon,
        ];
        
        if($search) {
            $new["search"] = $search;
        }
        
        $this->options[] = $new;
    
        return $this;
    }
    
    
    /**
     * @param array $options
     *
     * @return $this
     */
    public function setOptions($options): self {
        $this->options = [];
        
        foreach($options AS $key => $option) {
            if(is_string($option)) {
                $this->addOption(
                    $option,
                    $key
                );
            }
            else {
                $this->addOption(
                    $option["label"],
                    isset($option["value"]) ? $option["value"] : $key,
                    isset($option["icon"]) ? $option["icon"] : $option["value"],
                    isset($option["search"]) ? $option["search"] : []
                );
            }
        }
        
        return $this;
    }
    
    
    /**
     * @return array
     */
    public function getOptions() {
        return $this->options;
    }
}
