<?php

namespace App\Models\ActivityLog;

use Illuminate\Http\Request;
use App\Models\Clients\Company;
use App\Models\Attachments\Attachment;
use Spatie\Activitylog\Models\Activity;
use App\Models\Employees\Employee;
use App\Models\Users\User;
use App\Models\Tasks\Task;
use App\Models\Comments\Comment;
use Illuminate\Support\Facades\Auth;
use App\Models\Posts\Post;
use App\Models\Clients\Candidate;

class ActivityLogService
{

  /**
   * Store a newly created resource in storage.
   *
   * @param  Array $array
   * @return \Illuminate\Http\Response
   */
    public function getActivitiesByCompany(Company $company)
    {
        $construct = [];
        $lastActivity = Activity::whereSubjectId($company->id)->orWhere('causer_id', $company->id)->orWhere('subject_type', Attachment::class)->orWhere('subject_type', Employee::class)->orWhere('subject_type', Task::class)->orWhere('subject_type', Company::class)->orderBy('created_at', 'desc')->take(10)->get();
        foreach ($lastActivity as $activity) {
            if ((
              ($activity->subject_type == Company::class)||
              //filter attachment for company
              (isset($activity->getExtraProperty('attributes')['attachable_type']) && $activity->getExtraProperty('attributes')['attachable_type'] == Company::class && $activity->getExtraProperty('attributes')['attachable_id'] == $company->id) ||
              //filter anything related to company
              (isset($activity->getExtraProperty('attributes')['company_id']) && $activity->getExtraProperty('attributes')['company_id'] == $company->id)
              )
              && $activity->causer_type != null) {
                $subjectO = new $activity->causer_type;
                $objectO = new $activity->subject_type;
                $subject = $subjectO::find($activity->causer_id);
                $object = $objectO::find($activity->subject_id);
                $action = $activity->description;

                $dateNow =  date_create(date("Y-m-d H:i:s"));
                $dateBefore =  date_create(date($activity->created_at));
                $dateDiff = date_diff($dateBefore, $dateNow);
                $dateString = Self::constructStringFromDateTime($dateDiff);

                if (Attachment::class == $activity->subject_type) {
                    $sentence = $subject->name . " " . Self::constructSentenceFromAction($action, $activity);
                } elseif (Task::class == $activity->subject_type) {
                    $sentence = $subject->name . " " . Self::constructSentenceFromAction($action, $activity);
                    $name = isset($object) ? $object->name  : User::find($activity->getExtraProperty('attributes')['user_id'])->name;
                    $status = $activity->changes()->all()['attributes']['status'];
                    if ($action == "updated") {
                        if ($status == 0) {
                            $status = " as an open task";
                        } elseif ($status == 1) {
                            $status = " as an on-going task";
                        } else {
                            $status = " as a closed task";
                        }
                    } else {
                        $status = "";
                    }
                    $company = Company::find($activity->changes()->all()['attributes']['company_id']);
                    $sentence .= "a task for " . $company->name . $status . ".";
                } else {
                    $sentence = $subject->name . " " . Self::constructSentenceFromAction($action, $activity);
                    //filter object is company, user, social wall, post, tasks
                    $name = isset($object->name) ? $object->name  : $activity->changes()->all()['attributes']['name'];

                    if (Company::class == $activity->subject_type) {
                        $sentence .= "company's " . $name . " data.";
                    } elseif (Employee::class == $activity->subject_type) {
                        //accounts added to the company
                        $sentence .= $name . " as an account for company " . $company->name . ".";
                    }
                }
                $construct[] = [$subject, $object, $dateString, $sentence];
            }
        }
        return $construct;
    }

    public function getActivitiesByUser(User $user)
    {
        $construct = [];
        $lastActivity = Activity::whereSubjectId($user->id)->orWhere('causer_id', $user->id)->orderBy('created_at', 'desc')->get();
        foreach ($lastActivity as $activity) {
            if ($activity->causer_type != null && ($user->id != $activity->subject_id || ($activity->causer_id ==  $activity->subject_id))) {
                $dateNow =  date_create(date("Y-m-d H:i:s"));
                $dateBefore =  date_create(date($activity->created_at));
                $dateDiff = date_diff($dateBefore, $dateNow);
                $dateString = Self::constructStringFromDateTime($dateDiff);
                $sentence =  Self::constructSentenceForUser($activity->description, $activity);
                if ($sentence!=null) {
                    $construct[] = [$dateString, $sentence];
                }
            }
        }
        return $construct;
    }
    public function constructSentenceForUser($action, $activity)
    {
        $subjectO = new $activity->causer_type;
        $objectO = new $activity->subject_type;
        $subject = $subjectO::find($activity->causer_id);
        $object = $objectO::find($activity->subject_id);

        if (Company::class == $activity->subject_type) {
            $objectName = isset($object->name) ? $object->name : $activity->changes()->all()['attributes']['name'];
            if (isset($activity->changes()->all()['attributes']) && ($activity->changes()->all()['attributes']['client'] == true) && (isset($activity->changes()->all()['old']) && $activity->changes()->all()['old']['client'] == false)) {
                return "You converted company " . $objectName . " as a client.";
            }
            return "You " .$action . " " . $objectName . "'s data.";
        } elseif (Candidate::class == $activity->subject_type) {
            $objectName = isset($object->name) ? $object->name : $activity->changes()->all()['attributes']['name'];
            return "You " .$action . " " . $objectName . " in the candidates list.";
        } elseif (Attachment::class == $activity->subject_type) {
            //escape resume added for resumes
            $type = $activity->getExtraProperty('attributes')['attachable_type'];
            if ($type != Candidate::class) {
                $objectName = isset($object->filename) ? $object->filename : $activity->changes()->all()['attributes']['file_name'];
                $company = Company::find($activity->changes()->all()['attributes']['attachable_id']);
                return "You " .$action . " " . $objectName . " for company " . $company->name . ".";
            }
        } elseif (User::class == $activity->subject_type && $activity->causer_id == Auth::user()->id) {
            if ($activity->subject_id != $activity->causer_id) {
                $objectName = isset($object->name) ? $object->name : $activity->changes()->all()['attributes']['name'];
                return "You " . $action . " " . $objectName . "'s account as an admin.";
            }
            return "You " . $action . " your own profile.";
        } elseif (Employee::class == $activity->subject_type) {
            $objectName = isset($object->name) ? $object->name : $activity->changes()->all()['attributes']['name'];
            $company = Company::find($activity->changes()->all()['attributes']['company_id']);
            return "You " .$action . " " . $objectName . "'s account for company " . $company->name . ".";
        } elseif (Post::class == $activity->subject_type) {
            return "You " .$action . " a post on announcement board.";
        } elseif (Task::class == $activity->subject_type) {
            $status = $activity->changes()->all()['attributes']['status'];
            if ($action == "updated") {
                if ($status == 0) {
                    $status = " as an open task";
                } elseif ($status == 1) {
                    $status = " as an on-going task";
                } else {
                    $status = " as a closed task";
                }
            } else {
                $status = "";
            }
            $company = Company::find($activity->changes()->all()['attributes']['company_id']);
            return "You " . $action . " a task for " . $company->name . $status . ".";
        }
        return null;
    }

    public function constructSentenceFromAction($action, $activity)
    {
        if ($action == "created") {
            if (isset($activity->getExtraProperty('attributes')['file_name'])) {
                return " uploaded file " . $activity->getExtraProperty('attributes')['file_name'];
            }
        }
        if ($action == "deleted") {
            if (isset($activity->getExtraProperty('attributes')['file_name'])) {
                return " removed file " . $activity->getExtraProperty('attributes')['file_name'];
            }
        }
        return $action . " ";
    }
    public function constructStringFromDateTime($date)
    {
        $string = "";
        if ($date->y != "0") {
            $string .= $date->y;
            if ($date->y == '1') {
                $string .= " year ago";
            } else {
                $string .= " years ago";
            }
        } elseif ($date->m != '0') {
            $string .= $date->m;
            if ($date->m == '1') {
                $string .= " month ago";
            } else {
                $string .= " months ago";
            }
        } elseif ($date->d != '0') {
            $string .= $date->d;
            if ($date->d == '1') {
                $string .= " day ago";
            } else {
                $string .= " days ago";
            }
        } elseif ($date->h != '0') {
            $string .= $date->h;
            if ($date->h == '1') {
                $string .= " day ago";
            } else {
                $string .= " days ago";
            }
        } elseif ($date->i != '0') {
            $string .= $date->i;
            if ($date->i == '1') {
                $string .= " minute ago";
            } else {
                $string .= " minutes ago";
            }
        } elseif ($date->s != '0') {
            $string .= $date->s;
            if ($date->s == '1') {
                $string .= " second ago";
            } else {
                $string .= " seconds ago";
            }
        }
        return $string;
    }
}
