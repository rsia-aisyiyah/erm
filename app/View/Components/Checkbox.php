<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Checkbox extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $id;
    public $name;
    public $value;
    public $label;
    public $checked;
    public $onchange;
    public function __construct($id, $name, $value, $label, $checked = false, $onchange ='')
    {
        $this->id = $id;
        $this->name = $name;
        $this->value = $value;
        $this->label = $label;
        $this->checked = $checked;
        $this->onchange = $onchange;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.checkbox');
    }
}
