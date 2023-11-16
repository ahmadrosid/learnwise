<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ChapterItem extends Component
{
    public $chapter;

    public function __construct($chapter)
    {
        $this->chapter = $chapter;
    }

    public function render(): View|Closure|string
    {
        return view('components.chapter-item');
    }
}
