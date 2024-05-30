<?php

namespace App\View\Components;

use App\Models\Group;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class GroupSelectBox extends Component
{
    
    public int $groupId;
    /**
     * Create a new component instance.
     */
    public function __construct(int $groupId = 0)
    {
        $this->groupId = $groupId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {

        $groups = Group::all();
        return view('components.group-select-box')->with([
            'groups' => $groups,
            'groupId' => $this->groupId
        ]);
    }
}
