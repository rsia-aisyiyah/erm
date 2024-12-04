<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CheckboxGroup extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */

    public string $name;
    public array $checkboxes;

    public function __construct(string $name, array $checkboxes = [])
    {
        $this->name = $name;
        $this->checkboxes = $checkboxes;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.checkbox-group');
    }
}
