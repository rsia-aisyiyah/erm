<?php

namespace App\View\Components\Cppt;

use Illuminate\View\Component;

class Textarea extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $id;
    public $name;
    public $cols;
    public $rows;
    public $value;
    public function __construct($id, $name, $rows = 5, $cols = 30, $value = "-")
    {
        $this->id = $id;
        $this->name = $name;
        $this->cols = $cols;
        $this->rows = $rows;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.cppt.textarea');
    }
}
