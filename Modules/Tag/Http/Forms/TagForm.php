<?php

namespace Modules\Tag\Http\Forms;

use Kris\LaravelFormBuilder\Form;

class TagForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text', [
                'label' => 'Tag name',
            ]);

    }

}
