<?php

namespace Bernhardh\NovaIconSelect\IconProviders;

use Bernhardh\NovaIconSelect\IconProvider;

class FontAwesomeIconProvider extends IconProvider {
    
    public function __construct() {
        $this->setOptions(config("nova-icon-select-fontawesome", []));
    }
}
