<?php

namespace App\Models\ActivityLog;

use App\Models\Attachments\Attachment;
use App\Models\Clients\Candidate;
use App\Models\Clients\Company;
use App\Models\Employees\Employee;
use App\Models\Posts\Post;
use App\Models\Tasks\Task;
use App\Models\Users\User;
use App\Models\Users\UserCompany;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Models\Activity;

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
        $lastActivity = Activity::whereSubjectId($company->id)->orWhere('subject_type', Attachment::class)->orWhere('subject_type', Employee::class)->orWhere('subject_type', Task::class)->orWhere('subject_type', Company::class)->orWhere('subject_type', UserCompany::class)->orderBy('created_at', 'desc')->get();

        // $lastActivity = Activity::whereSubjectId($company->id)->orWhere('causer_id', $company->id)->orWhere('subject_type', Attachment::class)->orWhere('subject_type', Employee::class)->orWhere('subject_type', Task::class)->orWhere('subject_type', Company::class)->orWhere('subject_type', UserCompany::class)->orderBy('created_at', 'desc')->get();
        foreach ($lastActivity as $activity) {
            try {
                if ((
                    ($activity->subject_type == Company::class && $activity->subject_id == $company->id) ||
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

                    $dateNow = date_create(date("Y-m-d H:i:s"));
                    $dateBefore = date_create(date($activity->created_at));
                    $dateDiff = date_diff($dateBefore, $dateNow);
                    $dateString = Self::constructStringFromDateTime($dateDiff);
                    $sentence = "";

                    if ($subject != null) {
                        if (Attachment::class == $activity->subject_type) {
                            $sentence = $subject->name . " " . Self::constructSentenceFromAction($action, $activity);
                        } elseif (Task::class == $activity->subject_type) {
                            $company = Company::find($activity->changes()->all()['attributes']['company_id']);
                            $status = $activity->changes()->all()['attributes']['status'];
                            $prevStatus = $activity->getExtraProperty('old')['status'];

                            if ($action == "created") {
                                if ($company != null) {
                                    $sentence =  $action . " a task for " . $company->name . ".";
                                }
                            } elseif ($action == "updated" && $status != $prevStatus) {
                                if ($status == 0) {
                                    $status = " as an open task";
                                } elseif ($status == 1) {
                                    $status = " as an on-going task";
                                } else {
                                    $status = " as a closed task";
                                }
                                $sentence =  $action . " " .  $company->name  . "'s task " . $status . ".";
                            }
                        } elseif (UserCompany::class == $activity->subject_type) {
                            //NAME updated
                            $sentence = $subject->name . " " . Self::constructSentenceFromAction($action, $activity) . " a user";
                            if ($action == "updated") {
                                $sentence .= " to the company.";
                            } else {
                                $sentence .= " from the company.";
                            }
                        } else {
                            $sentence = $subject->name . " " . Self::constructSentenceFromAction($action, $activity);
                            //filter object is company, user, social wall, post, tasks
                            $name = isset($object->name) ? $object->name : $activity->changes()->all()['attributes']['name'];

                            if (Company::class == $activity->subject_type) {
                                $sentence .= "company's " . $name . " data.";
                            } elseif (Employee::class == $activity->subject_type) {
                                //accounts added to the company
                                $sentence .= $name . " as an account for company " . $company->name . ".";
                            }
                        }
                        if ($sentence != "") {
                            $construct[] = [$subject, $object, $dateString, $sentence];
                        }
                    }
                }
            } catch (Exception $e) {
                $construct[] = ['EXCEPTION', 'EXCEPTION', null, 'Something happened! Caught exception: ' . $e->getMessage() . "\n"];
            }
        }
        return $construct;
    }

    public function getActivitiesByUser(User $user)
    {
        $construct = [];
        $lastActivity = Activity::whereSubjectId($user->id)->orWhere('causer_id', $user->id)->orderBy('created_at', 'desc')->get();
        foreach ($lastActivity as $activity) {
            try {
                if ($activity->causer_type != null && ($user->id != $activity->subject_id || ($activity->causer_id == $activity->subject_id))) {
                    $dateNow = date_create(date("Y-m-d H:i:s"));
                    $dateBefore = date_create(date($activity->created_at));
                    $dateDiff = date_diff($dateBefore, $dateNow);
                    $dateString = Self::constructStringFromDateTime($dateDiff);
                    $sentence = Self::constructSentenceForUser($activity->description, $activity);
                    if ($sentence != null) {
                        $construct[] = [$dateString, $sentence];
                    }
                }
            } catch (Exception $e) {
                $construct[] = ['EXCEPTION', 'Something happened! Caught exception: ' . $e->getMessage() . "\n"];
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
                return "converted company " . $objectName . " as a client.";
            }
            return $action . " " . $objectName . "'s data.";
        } elseif (Company::class == $activity->subject_type) {
            $objectName = isset($object->name) ? $object->name : $activity->changes()->all()['attributes']['name'];
            if (isset($activity->changes()->all()['attributes']) && ($activity->changes()->all()['attributes']['client'] == true) && (isset($activity->changes()->all()['old']) && $activity->changes()->all()['old']['client'] == false)) {
                return "converted company " . $objectName . " as a client.";
            }
            return $action . " " . $objectName . "'s data.";
        } elseif (Candidate::class == $activity->subject_type) {
            $objectName = isset($object->name) ? $object->name : $activity->changes()->all()['attributes']['name'];
            return $action . " " . $objectName . " in the candidates list.";
        } elseif (Attachment::class == $activity->subject_type) {
            //escape resume added for resumes
            $type = $activity->getExtraProperty('attributes')['attachable_type'];
            if ($type != Candidate::class) {
                $objectName = isset($object->filename) ? $object->filename : $activity->changes()->all()['attributes']['file_name'];
                $company = Company::find($activity->changes()->all()['attributes']['attachable_id']);
                return $action . " " . $objectName . " for company " . $company->name . ".";
            }
        } elseif (User::class == $activity->subject_type && $activity->causer_id == Auth::user()->id) {
            if ($activity->subject_id != $activity->causer_id) {
                $objectName = isset($object->name) ? $object->name : $activity->changes()->all()['attributes']['name'];
                return $action . " " . $objectName . "'s account as an admin.";
            }
            return $action . " your own profile.";
        } elseif (Employee::class == $activity->subject_type) {
            $objectName = isset($object->name) ? $object->name : $activity->changes()->all()['attributes']['name'];
            $company = Company::find($activity->changes()->all()['attributes']['company_id']);
            return $action . " " . $objectName . "'s account for company " . $company->name . ".";
        } elseif (Post::class == $activity->subject_type) {
            return $action . " a post on announcement board.";
        } elseif (Task::class == $activity->subject_type) {
            $status = $activity->changes()->all()['attributes']['status'];
            $prevStatus = $activity->getExtraProperty('old')['status'];
            $company = Company::find($activity->changes()->all()['attributes']['company_id']);
            if ($action == "created") {
                if ($company != null) {
                    return $action . " a task for " . $company->name . ".";
                }
            } elseif ($action == "updated" && $status != $prevStatus) {
                if ($status == 0) {
                    $status = " as an open task";
                } elseif ($status == 1) {
                    $status = " as an on-going task";
                } else {
                    $status = " as a closed task";
                }
                return $action . " " .  $company->name  . "'s task " . $status . ".";
            } else {
                $status = "";
            }
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
            if ($activity->subject_type == UserCompany::class) {
                return " removed ";
            }
        }

        if ($action == "updated") {
            if ($activity->subject_type == UserCompany::class) {
                return " assigned ";
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
                $string .= " hour ago";
            } else {
                $string .= " hours ago";
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
