<?php

namespace App\View\Components;

use App\Models\Position;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PositionSelectBox extends Component
{
    /**
     * Create a new component instance.
     */

    public int $positionId;

    public function __construct(int $positionId = 0)
    {
        $this->positionId = $positionId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $positions = Position::all();
        return view('components.position-select-box')->with([
                'positions'=>$positions, 
                'positionId'=>$this->positionId
            ]);
    }
}
