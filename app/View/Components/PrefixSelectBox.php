<?php

namespace App\View\Components;

use App\Models\Prefix;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PrefixSelectBox extends Component
{
    public int $prefixId;


    /**
     * Create a new component instance.
     */
    public function __construct(int $prefixId = 0)
    {
        $this->prefixId = $prefixId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $prefixs = Prefix::all();
        return view('components.prefix-select-box')->with([
            'prefixs' => $prefixs,
            'prefixId' => $this->prefixId
        ]);
    }
}
