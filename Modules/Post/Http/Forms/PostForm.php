<?php

namespace Modules\Post\Http\Forms;

use Kris\LaravelFormBuilder\Form;
use Modules\Categories\Entities\Category;
use Modules\Post\Entities\PostType;
use Modules\Tag\Http\Forms\TagForm;

class PostForm extends Form
{

    public function buildForm()
    {

        $this->add('title', 'text', [
            'label' => 'Tiêu đề',
            'label_attr' => ['class' => 'control-label font-weight-semibold'],
            'rules' => 'required',
            'error_messages' => [
                'title.required' => 'The title field is mandatory.'
            ]
        ]);

        $postType = PostType::query()->pluck('name', 'id')->toArray();

        $selected_type = null;
        if ($this->model) {
            $selected_type = $this->model->type;
        }

        $this->add('type', 'select', [
            'choices' => $postType,
            'label' => 'Kiểu bài viết',
            'label_attr' => ['class' => 'control-label font-weight-semibold'],
            'selected' => $selected_type
        ]);

        $categories = Category::query()->where('type', 30)->pluck('name', 'id')->toArray();

        $this->add('category', 'choice', [
            'choices' => $categories,
            'empty_value' => '==== Chọn danh mục ===',
            'multiple' => true,
            'rules' => 'required',
            'error_messages' => [
                'category.required' => 'The title field is mandatory.'
            ]
        ]);

        $this->add('image', 'file', [
            'label' => 'Ảnh đại diện',
            'label_attr' => ['class' => 'control-label font-weight-semibold'],
            'attr' => ['class' => 'form-control', 'accept' => 'image/*'],
            'template' => 'core::partial.imageable_type'
        ]);

        $this->add('short_content', 'text', [
            'label' => 'Nội dung ngắn',
            'label_attr' => ['class' => 'control-label font-weight-semibold'],
        ]);

        $this->add('content', 'textarea', [
            'label' => 'Nội dung',
            'label_attr' => ['class' => 'control-label font-weight-semibold'],
        ]);

//        $this->add('tags', 'text', [
//            'label' => 'Thẻ tags',
//            'label_attr' => ['class' => 'control-label font-weight-semibold'],
//            'default_value' => 's'
//        ]);

        $this->add('tags', 'collection', [
            'type' => 'text',
            'property' => 'name',
            'options' => [
                'label' => false,
                'attr' => ['class' => 'tag']
            ],
        ]);
//
//        if (\Request::route()->getName() === 'categories.edit') {
//            $parameters = \Request::route()->parameters();
//            $category = $parameters['category'];
//            $categories = Category::query()
//                ->where('id', '<>', $category)
//                ->pluck('name', 'id')
//                ->toArray();
//        } else {
//            $categories = Category::query()
//                ->pluck('name', 'id')
//                ->toArray();
//        }
//
//        $this->add('parent_id', 'select', [
//            'choices' => $categories,
//            'attr' => ['class' => 'select2 pmd-select2 form-control'],
//            'selected' => $this->model ? $this->model->parent_id : \Request::get('parent_id'),
//            'label' => 'Danh mục cha',
//            'label_attr' => ['class' => 'control-label font-weight-semibold'],
//            'empty_value' => 'Chọn 1 danh mục cha'
//        ]);

        $this->add('submit', 'submit', [
            'label' => 'Lưu',
            'attr' => ['class' => 'btn btn-primary']
        ]);
    }

}
