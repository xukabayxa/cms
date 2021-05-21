<?php

namespace Modules\SystemResource\Http\Forms;

use Kris\LaravelFormBuilder\Form;

class SystemResourceForm extends Form
{
    public function buildForm()
    {

        $this->add('file', 'file', [
            'label' => trans('systemresources::category.form.thumbnail'),
            'label_attr' => ['class' => 'control-label font-weight-semibold'],
            'attr' => ['class' => 'form-control', 'accept' => 'image/*'],
            'template' => 'core::partial.imageable_type'
        ]);
//        <input  type="hidden" id="img" name="img">
//                                <input  type="hidden" id="source" name="source">



        $this->add('submit', 'submit', [
            'label' => trans('core::core.form.save'),
            'attr' => ['class' => 'btn btn-primary']
        ]);
    }

}
