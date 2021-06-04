<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TextareaInput extends Component
{
    public $name;
    public $title;
    /**
     * @var null
     */
    public $label_class;
    /**
     * @var null
     */
    public $textarea_class;
    /**
     * @var null
     */
    public $error_class;
    /**
     * @var false
     */
    public $isTiny;
    /**
     * @var null
     */
    public $id;
    /**
     * @var null
     */
    public $placeholder;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name,
                                $title,
                                $id = null,
                                $label_class = null,
                                $textarea_class = null,
                                $error_class = null,
                                $isTiny = false,
                                $placeholder = '')
    {
        $this->name           = $name;
        $this->title          = $title;
        $this->id             = $id ?? $name;
        $this->label_class    = $label_class ?? 'form-label';
        $this->textarea_class = $textarea_class ?? 'form-control';
        $this->error_class    = $error_class ?? 'invalid-feedback';
        $this->isTiny         = $isTiny;
        $this->placeholder    = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.textarea-input');
    }
}
