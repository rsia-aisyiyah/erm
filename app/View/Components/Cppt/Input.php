<?php

namespace App\View\Components\Cppt;

use Illuminate\View\Component;

class Input extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $id;
    public $name;
    public $placeholder;
    public $align;
    public $border;
    public $value;
    public $style;
    public function __construct(
        $id,
        $name,
        $placeholder = "",
        $align = 'text-left',
        $value = "",
        $border = "",
        $style = ""
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->align = $align;
        $this->border = $border;
        $this->value = $value;
        $this->style = $style;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cppt.input');
    }
}
