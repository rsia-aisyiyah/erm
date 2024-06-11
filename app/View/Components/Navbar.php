<?php

namespace App\View\Components;

use App\Models\Setting;
use Illuminate\View\Component;

class Navbar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    protected $setting;
    public function __construct()
    {
        $this->setting = new Setting();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.navbar', ['data' => $this->setting->first()]);
    }
}
