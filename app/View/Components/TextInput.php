<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TextInput extends Component
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
    public $input_class;
    /**
     * @var null
     */
    public $error_class;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name,
                                $title,
                                $label_class = null,
                                $input_class = null,
                                $error_class = null)
    {
        $this->name        = $name;
        $this->title       = $title;
        $this->label_class = $label_class ?? 'form-label';
        $this->input_class = $input_class ?? 'form-control';
        $this->error_class = $error_class ?? 'invalid-feedback';
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.app.text-input');
    }
}
