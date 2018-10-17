<?php

namespace App\Models\Clients;

use App\Models\Clients\Company;
use App\Models\Employees\Employee;
use App\Models\Comments\Comment;
use App\Models\Posts\Post;
use App\Models\Tasks\Task;
use App\Models\Users\UserCompany;
use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class ClientService
{
    /**
     * Checks user existed and creates a new user
     * @param  Array   $array
     * @return Company $company
     * @author jerrytohvan
     */
    public function addCompany($array)
    {
        return Company::create([
      'name' => $array['company_name'],
        'address' => $array['address'],
        'email' => $array['company_email'],
      'telephone_no' => $array['telephone'],
      'client' => $array['client'],
      'website' => $array['website'],
      'no_employees' => $array['no_employees'] == "" ? 0 :$array['no_employees'],
      'industry' => $array['industry'],
      'lead_source' => $array['lead_source'],
      'description' => $array['description']
      ]);
    }
    public function getAllCompany()
    {
        return Company::all()->sortBy('name');
    }
    public function getAllClients()
    {
        return Company::whereClient(1)->orderBy('name', 'asc')->take(1000)->get();
    }

    public function getAllLeads()
    {
        return Company::whereClient(0)->orderBy('name', 'asc')->take(1000)->get();
    }

    /**
     * Checks user existed and creates a new user
     * @param  Array   $array
     * @return Company $company
     * @author jerrytohvan
     */
    public function addAccount($array)
    {
        return Employee::create([
        'name' => $array['name'],
        'email' => $array['email'],
        'title' => $array['title'],
        'handphone' => $array['handphone'],
        'telephone' => $array['telephone'],
        'company_id' => $array['company_id']
        ]);
    }

    public function getAllAccount()
    {
        $employee = Employee::all();
        return $employee;
    }

    public function updateCompanyProfile(Company $company, $array)
    {
        foreach ($array as $key => $value) {
            $company->$key = $value;
        }
        $company->save();

        return $company;
    }

    public function updateAccountProfile(Employee $employee, $array)
    {
        foreach ($array as $key => $value) {
            $employee->$key = $value;
        }
        $employee->save();
        return $employee;
    }

    public function leadToClient(Company $company)
    {
        $company->update([
      'client' => 1,
      ]);
        $company->save();
        return $company;
    }

    public function addPost($company, $content)
    {
        $post = new Post([
          'content' => $content
        ]);
        if (Auth::user()->comments()->save($post)) {
            $company->posts()->save($post);
            $comment = new Comment();
            $post->comment()->save($comment);
        }
        return $comment;
    }

    // //Working version
    // public function getUrgencyScore($array)
    // {
    //     $scoreArray = array();

    //     foreach ($array as $company) {
    //         $score = 0;

    //         $companyID = $company['id'];
    //         $companySize = $company['no_employees'];
    //         $numTasks = Task::where('company_id', $companyID)->count();

    //         $oneweek = Carbon::now()->addDays(7)->format('Y-m-d H:i:s');
    //         $now = Carbon::now()->format('Y-m-d H:i:s');

    //         $weekTasks = Task::where('company_id', $companyID)
    //                     ->whereDate('date_reminder', '>=', $now)
    //                     ->whereDate('date_reminder', '<=', $oneweek)->count();

    //         $score = ($companySize * 0.2) + ($numTasks * 0.3) + ($weekTasks * 0.5);
    //         $scoreArray[$companyID] = $score;
    //     }
    //     asort($scoreArray);
    //     return $scoreArray;
    // }

    //Improved version
    public function getUrgencyScore($array)
    {
        $scoreArray = array();

        $oneweek = Carbon::now()->addDays(7)->format('Y-m-d 00:00:00');
        $now = Carbon::now()->format('Y-m-d 00:00:00');

        $alltasks = Task::all();
        
        foreach ($array as $company) {
            $score = 0;

            $companyID = $company['id'];
            $companySize = $company['no_employees'];

            $numTasks = 0;
            $weekTasks = 0;
            foreach ($alltasks as $thistask) {
                $task_company = $thistask['company_id'];
                if ($task_company == $companyID) {
                    $numTasks = $numTasks + 1;
                    $date_reminder = strtotime($thistask['date_reminder']);
                    if ($date_reminder >= strtotime($now) && $date_reminder <= strtotime($oneweek)) {
                        $weekTasks = $weekTasks + 1;
                    }
                }
            }
            
            $score = ($companySize * 0.2) + ($numTasks * 0.3) + ($weekTasks * 0.5);
            $scoreArray[$companyID] = $score;
        }
        asort($scoreArray);
        return $scoreArray;
    }

    public function getLastUpdate($array)
    {
        $updateArray = array();

        $employees = Employee::all();
        $posts = Post::all();
        $collaborators = UserCompany::all();
        $tasks = Task::all();

        foreach ($array as $company) {
            $company_id = $company['id'];
            $last_update = $company['updated_at'];
            $updateArray[$company_id] = $last_update->format('Y-m-d H:i:s');

            foreach ($employees as $employee) {
                $employee_company = $employee['company_id'];
                if ($employee_company == $company_id) {
                    $maxUpdate = $updateArray[$company_id];
                    $employeesUpdate = $employee['updated_at'];
                    if (strtotime($employeesUpdate) > strtotime($maxUpdate)) {
                        $updateArray[$company_id] = $employeesUpdate->format('Y-m-d H:i:s');
                    }
                }
            }

            foreach ($posts as $post) {
                $post_company = $post['company_id'];
                if ($post_company == $company_id) {
                    $maxUpdate = $updateArray[$company_id];
                    $postUpdate = $post['updated_at'];
                    if (strtotime($postUpdate) > strtotime($maxUpdate)) {
                        $updateArray[$company_id] = $postUpdate->format('Y-m-d H:i:s');
                    }
                }
            }

            foreach ($collaborators as $collaborator) {
                $collaborator_company = $collaborator['company_id'];
                if ($collaborator_company == $company_id) {
                    $maxUpdate = $updateArray[$company_id];
                    $collaboratorsUpdates = $collaborator['updated_at'];
                    if (strtotime($collaboratorsUpdates) > strtotime($maxUpdate)) {
                        $updateArray[$company_id] = $collaboratorsUpdates->format('Y-m-d H:i:s');
                    }
                }
            }

            foreach ($tasks as $task) {
                $task_company = $task['company_id'];
                if ($task_company == $company_id) {
                    $maxUpdate = $updateArray[$company_id];
                    $tasksUpdate = $task['updated_at'];
                    if (strtotime($tasksUpdate) > strtotime($maxUpdate)) {
                        $updateArray[$company_id] = $tasksUpdate->format('Y-m-d H:i:s');
                    }
                }
            }
        }
        return $updateArray;
    }
}
