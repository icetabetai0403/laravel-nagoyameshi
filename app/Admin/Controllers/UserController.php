<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use App\Admin\Database\Administrator;

class UserController extends AdminController
{
    protected $title = 'Administrators';

    protected function grid()
    {
        $grid = new Grid(new Administrator());

        $grid->column('id', __('ID'))->sortable();
        $grid->column('username', __('Username'));
        $grid->column('name', __('Name'));
        $grid->column('email', __('Email')); // Emailフィールドを追加
        $grid->column('created_at', __('Created At'));
        $grid->column('updated_at', __('Updated At'));

        return $grid;
    }

    protected function detail($id)
    {
        $show = new Show(Administrator::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('username', __('Username'));
        $show->field('name', __('Name'));
        $show->field('email', __('Email')); // Emailフィールドを追加
        $show->field('created_at', __('Created At'));
        $show->field('updated_at', __('Updated At'));

        return $show;
    }

    protected function form()
    {
        $form = new Form(new Administrator());

        $form->display('id', __('ID'));
        $form->text('username', __('Username'))->rules('required');
        $form->text('name', __('Name'))->rules('required');
        $form->email('email', __('Email'))->rules('required|email'); // Emailフィールドを追加
        $form->password('password', __('Password'))->rules('required|confirmed');
        $form->password('password_confirmation', __('Password confirmation'))->rules('required')
            ->default(function ($form) {
                return $form->model()->password;
            });
        $form->ignore(['password_confirmation']);

        return $form;
    }
}
