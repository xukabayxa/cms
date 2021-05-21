<?php

namespace Modules\Categories\Http\Forms;

use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\Field;
use Modules\Categories\Entities\Category;

class CategoryForm extends Form
{
    public function buildForm()
    {

        $this->add('name', 'text', [
            'label' => 'Tên danh mục',
            'label_attr' => ['class' => 'control-label font-weight-semibold'],
        ]);

        $parent = null;
        $selected_type = Category::TYPE_COMMON;
        if (\Request::get('parent_id')) {
            $parent = Category::find(\Request::get('parent_id'));
            $selected_type = $parent->type;
        } elseif (\Request::get('type')) {
            $selected_type = \Request::get('type');
        }
        if ($this->model) {
            $selected_type = $this->model->type;
        }
        $this->add('type', 'select', [
            'choices' => [
                Category::TYPE_COMMON => 'Chung',
                Category::TYPE_PRODUCT => 'Sản phẩm',
                Category::TYPE_POST => 'Bài viết',
                Category::TYPE_SPECIAL => 'Đặc biệt'
            ],
            'label' => 'Kiểu danh mục',
            'label_attr' => ['class' => 'control-label font-weight-semibold'],
            'selected' => $selected_type
        ]);


        if ($selected_type == Category::TYPE_SPECIAL) {
            $this->add('display_at', 'select', [
                'choices' => [
                    Category::DISPLAY_AT_HOME => 'Trang chủ',
                    Category::DISPLAY_AT_BANNER => 'Banner'
                ],
                'label' => 'Hiển thị tại ',
                'label_attr' => ['class' => 'control-label font-weight-semibold'],
                'empty_value' => 'Chọn 1 kiểu hiển thị'
            ]);
        }

        $this->add('thumbnail', 'file', [
            'label' => trans('categories::category.form.thumbnail'),
            'label_attr' => ['class' => 'control-label font-weight-semibold'],
            'attr' => ['class' => 'form-control', 'accept' => 'image/*'],
            'template' => 'core::partial.imageable_type'
        ]);

        $this->add('description', 'text', [
            'label' => trans('categories::category.form.description'),
            'label_attr' => ['class' => 'control-label font-weight-semibold'],
        ]);

        if (\Request::route()->getName() === 'categories.edit') {
            $parameters = \Request::route()->parameters();
            $category = $parameters['category'];
            $categories = Category::query()
                ->where('id', '<>', $category)
                ->pluck('name', 'id')
                ->toArray();
        } else {
            $categories = Category::query()
                ->pluck('name', 'id')
                ->toArray();
        }

        $this->add('parent_id', 'select', [
            'choices' => $categories,
            'attr' => ['class' => 'select2 pmd-select2 form-control'],
            'selected' => $this->model ? $this->model->parent_id : \Request::get('parent_id'),
            'label' => 'Danh mục cha',
            'label_attr' => ['class' => 'control-label font-weight-semibold'],
            'empty_value' => 'Chọn 1 danh mục cha'
        ]);

        $this->add('submit', 'submit', [
            'label' => trans('core::core.form.save'),
            'attr' => ['class' => 'btn btn-primary']
        ]);
    }

}
