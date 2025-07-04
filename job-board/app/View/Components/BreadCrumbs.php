<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BreadCrumbs extends Component
{
    /**
     * Create a new component instance.
     * Why?
     * Um die Variable $links zu definieren.
     * Denn im Blade-Template benutzen wir im Kurs {{$attributes}} um die z.B. die Klasse zu übernehmen
     * wie mb-4.
     * $links wird aber dazu benutzt um die Links im Breadcrumb
     * mit einer foreach Schleife zu abzubilden.
     */
    public function __construct(
        public array $links
    )
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.bread-crumbs');
    }
}
