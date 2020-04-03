<?php

namespace App;

class CalendController extends Controller {

    public function index()
    {
        if (!Auth::isAuth())
        {
            $this->setFlash('danger', 'Для доступа вы должны быть авторизованы!');
            $this->redirect('/login');
        }

        $tpl = new Template('templates/header');
        $tpl->set('title', 'Tasks');
        $tpl->render();

        $tpl = new Template('main_title');
        $tpl->render();

        if (Auth::isAllow('upload'))
        {
            $tpl = new Template('main_upload');
            $tpl->render();
        }

        $this->generateTable();

        $tpl = new Template('templates/footer');
        $tpl->render();
    }

    public function view()
    {
        if (!Auth::isAllow('view'))
        {
            $this->setFlash('danger', 'Вам не доступен просмотр таска!');
            $this->redirect('/login');
        }
        echo "<pre>VIEW PAGE : Query ID = ".print_r($this->request->getQuery('id'), true)."</pre>";
    }

    public function done()
    {
        if (!Auth::isAllow('done'))
        {
            $this->setFlash('danger', 'Вам не доступено завершение таска!');
            $this->redirect('/login');
        }

        $id = $this->request->getParam('id');
        $tm = new TaskModel;
        $tm->doneTask($id);

        $this->redirect('/');

    }

    public function distribute()
    {
        if (!Auth::isAllow('distribute'))
        {
            $this->setFlash('danger', 'Вам не доступено назначение таска!');
            $this->redirect('/login');
        }

        $id    = filter_input(INPUT_POST, 'id',    FILTER_SANITIZE_NUMBER_INT);
        $value = filter_input(INPUT_POST, 'value', FILTER_SANITIZE_NUMBER_INT);

        if ($value == 0)
        {
            echo json_encode(['status' => 'err', 'message' => 'Нельзя снять задачу, можно только переназначить!']);
            return;
        }

        if ($id && $value) {
            $tm = new TaskModel;
            $tasks = $tm->distributeTask($id, $value);
            if ($tasks)
                echo json_encode(['status' => 'ok']);
            else
                echo json_encode(['status' => 'err', 'message' => 'Ошибка!']);
        }
    }

    public function upload()
    {
        if (!Auth::isAllow('upload'))
        {
            $this->setFlash('danger', 'Вам не доступено создание таска!');
            $this->redirect('/login');
        }
    }

    protected function generateTable()
    {
        $tm = new TaskModel;
        $tasks = $tm->getAllTasks();
        
        $users = $this->models['UserModel']->getAllUsers();

        if (count($tasks) > 0)
        {
            $rows = [];
            foreach ($tasks as $task) {
                $rows[] = $this->generateTableRow($task, $users);
            }
            $rows = join("\n", $rows);
        }
        else
        {
            $tpl = new Template('main_table_row_empty');
            $rows = $tpl->render(TRUE);
        }
 
        $tpl = new Template('main_table');
        $tpl->set('table_rows', $rows);
        $tpl->render();
    }

    protected function generateTableRow($task, $users)
    {
        $user_id = ($task['user_id']) ? $users[ $task['user_id'] ] ?? "None" : "None";

        $cross_out = ($task['is_done']) ? "cross_out" : "";
        $name = (Auth::isAllow('view')) 
            ? "<a class=\"{$cross_out}\" target=_blank href='/public/files/".$task['file']."'>".$task['name']."</a>" 
            : "<span class=\"{$cross_out}\">".$task['name']."</span>";

        $operations = "";
        if (Auth::isAllow('done'))
        {
            if (!$task['is_done'])
            {
                $tpl = new Template('done_task');
                $tpl->set('id', $task['id']);
                $operations = $tpl->render(TRUE);
            }
        }
        
        $tpl = new Template('main_table_row');
        $tpl->set('id',     $task['id']);
        $tpl->set('name',   $name);
        $tpl->set('created', $task['created']);

        if (Auth::isAllow('distribute'))
        {
            $sel_users = array_merge([0 => "None"], $users);
            $tpl->generateSelect('user_id', $task['id'], $sel_users, $task['user_id']);
        }
        else
        {
            $tpl->set('user_id', $user_id);
        }
        $tpl->set('operations', $operations);
        
        return $tpl->render(TRUE);
    }

}
