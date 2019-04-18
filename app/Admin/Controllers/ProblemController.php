<?php

namespace App\Admin\Controllers;

use App\Models\ProblemModel;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ProblemController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('试题管理')
            ->description('所有试题')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('详情')
            ->description('试题详情')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('编辑')
            ->description('编辑试题')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('创建')
            ->description('创建试题')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new ProblemModel);
        $grid->pid('PID')->sortable();
        $grid->desc("题目")->editable();
        $grid->eid("EID")->editable();
        $grid->available("题目开启")->editable();
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(ProblemModel::findOrFail($id));
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new ProblemModel);
        $form->tab('Basic', function (Form $form) {
            $form->display('eid');
            $form->text('desc')->rules('required');
            $form->text('choiceA')->rules('required');
            $form->text('choiceB')->rules('required');
            $form->text('choiceC')->rules('required');
            $form->text('choiceD')->rules('required');
            $form->text('correctAns')->rules('required');
            $form->number('eid');
            $form->number('available');
        });
        return $form;
    }
}
