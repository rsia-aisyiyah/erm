<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */


    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public ?string $value = null,
        public ?string $type = null,
        public ?string $label = null,
        public ?string $placeholder = null,
    ) {

    }


    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input');
    }
}
