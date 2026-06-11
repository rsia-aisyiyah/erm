<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Select extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        public ?string $id = null,
        public ?string $name = null,
        public mixed $value = null,
        public ?string $placeholder = null,
        public bool $required = false,
        public bool $disabled = false,
    ) {
        $this->id ??= $this->name;
        $this->name ??= $this->id;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select');
    }
}
