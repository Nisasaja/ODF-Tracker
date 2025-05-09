<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Attribute tambahan untuk input.
     *
     * @var string|null
     */
    public $type;

    /**
     * Create a new component instance.
     *
     * @param string $type
     * @return void
     */
    public function __construct($type = 'text')
    {
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.input');
    }
}
