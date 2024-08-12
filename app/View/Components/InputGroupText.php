<?php

namespace App\View\Components;

use Illuminate\View\Component;

class InputGroupText extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public string $for;
    public string $label;
    public string $style;

    /**
     * Initializes a new instance of the InputGroupText component.
     *
     * @param string $label The label for the input group.
     * @param string $for   The for attribute for the input group.
     * @param string $style The style attribute for the input group.
     */
    public function __construct(string $label = '', string $for = '', string $style = '')
    {
        $this->for = $for;
        $this->label = $label;
        $this->style = $style;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input-group-text');
    }
}
