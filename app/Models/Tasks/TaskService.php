<?php

namespace App\Models\Tasks;

use App\Models\Clients\Company;

use App\Models\Tasks\Task;
use App\Models\Users\User;
use Auth;
use Carbon\Carbon;

class TaskService
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  Array $array
     * @return \Illuminate\Http\Response
     */
    //default task/event for todolist
    public function storeTask($array)
    {
        $status = Auth::user()->admin;
        $dateIni = Carbon::parse($array['date_reminder']);
        $beforeDate = $dateIni->format('Y-m-d H:i:s');

        if (!$status) {
            return Task::Create([
                'title' => $array['title'],
                'date_reminder' => $beforeDate,
                'company_id' =>  $array['company_id'],
                'status' => 1,
                'user_id' => Auth::user()->id,
                'type' => 1
            ]);
        } elseif ($status) {
            if ((int)$array['assigned_id'] == 0) {
                return Task::Create([
                    'title' => $array['title'],
                    'date_reminder' =>$beforeDate,
                    'company_id' =>  $array['company_id'],
                    'assigned_id' =>  0,
                    'status' => 0,
                    'user_id' => Auth::user()->id,
                    'type' => 1
                ]);
            } else {
                return Task::Create([
                    'title' => $array['title'],
                    'date_reminder' => $beforeDate,
                    'company_id' => $array['company_id'],
                    'status' => 1,
                    'user_id' => Auth::user()->id,
                    'assigned_id' => (int)$array['assigned_id'],
                    'type' => 1
                ]);
            }
        }
    }




    /**
     * Update the specified resource in storage.
     *
     * @param  Like $like
     * @param  Array  $array
     * @return \Illuminate\Http\Response
     */
    public function updateTask($id, $array)
    {
        $task = Task::find($id);
        foreach ($array as $key => $value) {
            $task->$key = $value;
        }
        $task->save();
        return $task;
    }

    public function updateTasksStatus($id)
    {
        $task = Task::find($id);
        $task->status = request()->input('status');
        $task->save();

        return response('Updated Successfully.', 200);
    }

    public function updateTasksOrder()
    {
        $tasks = Task::all();

        foreach ($tasks as $task) {
            $id = $task->id;
            foreach (request()->input('tasks') as $tasksNew) {
                if ($tasksNew['id'] == $id) {
                    $task->update(['order' => $tasksNew['order']]);
                }
            }
        }
        return response('Updated Successfully.', 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroyTask($id)
    {
        $task = Task::find($id);
        if ($task) {
            $task->delete();
            return response('Updated Successfully.', 200);
        }
    }

    public function insertCollab($tasks, $userIds)
    {
        foreach ($tasks as $task) {
            $task->update(['collaborator' =>$userIds]);
            $task->save();
        }
    }

    public function topfew($requestArray = [], $dateFrom = null, $dateTo = null)
    {
        if (sizeof($requestArray) != 0) {
            $dateIni = Carbon::parse($requestArray['from']);
            $dateFrom = $dateIni->format('Y-m-d H:i:s');
            $dateIni = Carbon::parse($requestArray['to']);
            $dateTo = $dateIni->format('Y-m-d H:i:s');
        }
        if ($dateFrom != null && $dateTo != null) {
            $companies = Company::all();
            $id = Auth::user()->id;
            $collaboratorsIn = Auth::user()->companies->map(function ($value, $key) {
                return $value->id;
            });
            $users = User::all();
            $tasks = Task::whereUserId($id)->whereBetween('date_reminder', [$dateFrom,$dateTo])->orWhere('assigned_id', $id)->whereBetween('date_reminder', [$dateFrom,$dateTo])->orWhereIn('company_id', $collaboratorsIn)->whereBetween('date_reminder', [$dateFrom,$dateTo])->orderBy('date_reminder', 'desc')->get();
            $tasksOpen = $tasks->map(function ($value, $key) use ($companies, $users) {
                $value['company'] =  $companies->filter(function ($company) use ($value) {
                    return $company->id == $value['company_id'];
                })->first()->name;
                $value['assignee'] = !empty($value['assigned_id']) ? $users->filter(function ($user) use ($value) {
                    return $user->id == $value['assigned_id'];
                })->first()->name :  "";
                $dateNow =  date_create(date("Y-m-d H:i:s"));
                $dateAfter =  date_create(date($value['date_reminder']));
                $dateDiff = date_diff($dateNow, $dateAfter);
                $dateString = Self::constructStringFromDateTime($dateDiff);
                $value['date_string'] = $dateString;
                $value['date'] = $value['date_reminder'];
                $value['creator'] = !empty($value['user_id']) ? $users->filter(function ($user) use ($value) {
                    return $user->id == $value['user_id'];
                })->first()->name : "";
                return $value;
            })->filter(function ($task, $key) {
                return $task->status == 0;
            })->values();

            $tasksOnGoing = $tasks->map(function ($value, $key) use ($companies, $users) {
                $value['company'] =  $companies->filter(function ($company) use ($value) {
                    return $company->id == $value['company_id'];
                })->first()->name;
                $value['assignee'] = !empty($value['assigned_id']) ? $users->filter(function ($user) use ($value) {
                    return $user->id == $value['assigned_id'];
                })->first()->name :  "";
                $dateNow =  date_create(date("Y-m-d H:i:s"));
                $dateAfter =  date_create(date($value['date_reminder']));
                $dateDiff = date_diff($dateNow, $dateAfter);
                $dateString = Self::constructStringFromDateTime($dateDiff);
                $value['date_string'] = $dateString;
                $value['date'] = $value['date_reminder'];
                $value['creator'] = !empty($value['user_id']) ? $users->filter(function ($user) use ($value) {
                    return $user->id == $value['user_id'];
                })->first()->name : "";
                return $value;
            })->filter(function ($task, $key) {
                return $task->status == 1;
            })->values();

            $tasksClosed = $tasks->map(function ($value, $key) use ($companies, $users) {
                $value['company'] =  $companies->filter(function ($company) use ($value) {
                    return $company->id == $value['company_id'];
                })->first()->name;
                $value['assignee'] = !empty($value['assigned_id']) ? $users->filter(function ($user) use ($value) {
                    return $user->id == $value['assigned_id'];
                })->first()->name :  "";
                $dateNow =  date_create(date("Y-m-d H:i:s"));
                $dateAfter =  date_create(date($value['date_reminder']));
                $dateDiff = date_diff($dateNow, $dateAfter);
                $dateString = Self::constructStringFromDateTime($dateDiff);
                $value['date_string'] = $dateString;
                $value['date'] = $value['date_reminder'];
                $value['creator'] = !empty($value['user_id']) ? $users->filter(function ($user) use ($value) {
                    return $user->id == $value['user_id'];
                })->first()->name : "";
                return $value;
            })->filter(function ($task, $key) {
                return $task->status == 2;
            })->values();

            return [$tasksOpen, $tasksOnGoing,$tasksClosed];
        }
        return [[], [], []];
    }


    public function constructStringFromDateTime($date)
    {
        if ($date->invert) {
            return "Pass due date";
        }
        $string = "Due in ";
        if ($date->y != 0) {
            $string .= $date->y;
            if ($date->y == '1') {
                $string .= " year";
            } else {
                $string .= " years";
            }
        } elseif ($date->m != 0) {
            $string .= $date->m;
            if ($date->m == 1) {
                $string .= " month";
            } else {
                $string .= " months";
            }
        } elseif ($date->d != '0') {
            $string .= $date->d;
            if ($date->d == '1') {
                $string .= " day";
            } else {
                $string .= " days";
            }
        } elseif ($date->h != '0') {
            $string .= $date->h;
            if ($date->h == '1') {
                $string .= " hour";
            } else {
                $string .= " hours";
            }
        } elseif ($date->i != '0') {
            $string .= $date->i;
            if ($date->i == '1') {
                $string .= " minute";
            } else {
                $string .= " minutes";
            }
        } elseif ($date->s != '0') {
            $string .= $date->s;
            if ($date->s == '1') {
                $string .= " second";
            } else {
                $string .= " seconds";
            }
        }
        return $string;
    }

    public function removingAcc($id)
    {
        $tasks = Task::whereUserId($id)->orWhere('assigned_id', $id)->orWhereNotNull('collaborator', $id)->get();
        foreach ($tasks as $task) {
            if ($task->user_id == $id) {
                $task->user_id = 1;
                $task->save();
            }
            if ($task->assigned_id == $id) {
                $task->assigned_id = 1;
            }

            if ($task->collaborator != null || sizeof($task->collaborator) > 0) {
                $nCollab = array_diff($task->collaborator, [$id]);
                $task->collaborator = $nCollab;
                $task->save();
            }
        }
    }
}
