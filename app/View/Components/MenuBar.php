<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Mockery\Matcher\Any;

class MenuBar extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.menu-bar', ['menu' => $this->menu()]);
    }

    function menu()
    {
        return $data = [
            ['id' => 1, 'title' => 'Dashboard', 'url' => url('/v2'), 'icon' => 'ti ti-dashboard', 'active' => false, 'submenu' => []],
            [
                'id' => 2, 'title' => 'Registrasi', 'url' => "#", 'icon' => 'ti ti-file-pencil', 'active' => false,
                'submenu' => [
                    ['id' => '2.1', 'url' => url('/v2/ralan'), 'title' => 'Rawat Jalan', 'active' => false],
                    ['id' => '2.2', 'url' => url('/v2/ranap'), 'title' => 'Rawat Inap', 'active' => false]
                ],
            ],
        ];
    }
}
