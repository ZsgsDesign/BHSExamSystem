<?php

namespace App\Admin\Controllers;

use App\Models\UserModel;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\Facades\Hash;
use App\Admin\Extensions\Tools\UploadUserButton;
use Illuminate\Http\Request;
use Encore\Admin\Facades\Admin;

class UserController extends Controller
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
            ->header('用户管理')
            ->description('所有用户')
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
            ->header('用户详情')
            ->description('用户的详情')
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
            ->header('编辑用户')
            ->description('编辑用户')
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
            ->header('创建用户')
            ->description('创建一个新用户')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $exams=UserModel::exams();
        $grid = new Grid(new UserModel);
        $grid->tools(function ($tools) {
            $tools->append(new UploadUserButton());
        });
        $grid->id('UID')->sortable();
        $grid->name("姓名")->editable();
        $grid->email("学号");
        foreach($exams as $e){
            $grid->column($e["exam_name"])->display(function () use($e) {
                return UserModel::findExam($this->id, $e["eid"]);
            });
        }
        $grid->filter(function (Grid\Filter $filter) {
            $filter->disableIdFilter();
            $filter->like('name');
            $filter->like('email');
        });
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
        $show = new Show(UserModel::findOrFail($id));
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new UserModel);
        $form->model()->makeVisible('password');
        $form->tab('Basic', function (Form $form) {
            $form->display('id');
            $form->text('name')->rules('required');
            $form->text('email')->rules('required');
            $form->display('created_at');
            $form->display('updated_at');
        })->tab('Password', function (Form $form) {
            $form->password('password')->rules('confirmed');
            $form->password('password_confirmation');
        });
        $form->ignore(['password_confirmation']);
        $form->saving(function (Form $form) {
            if ($form->password && $form->model()->password != $form->password) {
                $form->password = bcrypt($form->password);
            }
        });
        return $form;
    }

    public function upload(Request $request)
    {
        $method = $request->method();

        if ($method == 'POST'){
            $name = time().'.xls';
            $path = $request->file('upfile')->storeAs('public',$name);
            $url = storage_path().'/app/'.$path;
            $file = \PHPExcel_IOFactory::load($url);
            $re = $file->getSheet(0)->toArray(null,false,false,true);
            $re[0] = '';
            $header = ["email"];
            $recounts = count($re);
            for ($i=2;$i<$recounts;$i++){
                DB::table('user')->insert([
                    "email"=>$re[1],
                    "name"=>$re[1],
                    "password"=>Hash::make($re[1]),
                    'email_verified_at' => date("Y-m-d H:i:s"),
                    'avatar' => "/static/img/avatar/default.png"
                ]);
            }
            $success = new MessageBag([
                'title'   => '成功',
                'message' => '导入成功',
            ]);
            return back()->with(compact('success'));

        }
        if ($method == 'GET')
        {
            return Admin::content(function (Content $content) {

                $content->header('用户导入');
                $content->description('从excel导入数据');
                $content->body(view('tools.UserUpload'));
            });
        }
    }
}
