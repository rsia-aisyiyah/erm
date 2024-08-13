<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RadioGroup extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public string $name;
    public array $radios;
    public function __construct(string $name, array $radios = [])
    {
        $this->name = $name;
        $this->radios = $radios;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.radio-group');
    }
}
