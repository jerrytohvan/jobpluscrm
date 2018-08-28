<?php

namespace App\Models\ActivityLog;

use Illuminate\Http\Request;
use App\Models\Clients\Company;
use App\Models\Attachments\Attachment;
use Spatie\Activitylog\Models\Activity;
use App\Models\Employees\Employee;

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
        activity()->performedOn($company);
        $lastActivity = Activity::whereSubjectId($company->id)->orWhere('causer_id', $company->id)->orWhere('subject_type', Attachment::class)->orWhere('subject_type', Employee::class)->orWhere('subject_type', Company::class)->orderBy('id', 'desc')->take(10)->get();

        foreach ($lastActivity as $activity) {
            if (((isset($activity->getExtraProperty('attributes')['attachable_type']) && $activity->getExtraProperty('attributes')['attachable_type'] == Company::class && $activity->getExtraProperty('attributes')['attachable_id'] == $company->id) || (isset($activity->getExtraProperty('attributes')['company_id'])
            && $activity->getExtraProperty('attributes')['company_id'] == $company->id) || $activity->subject_type == Company::class) && $activity->causer_type != null) {
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
                } else {
                    $sentence = $subject->name . " " . Self::constructSentenceFromAction($action, $activity);

                    //filter object is company, user, social wall, post
                    if (Company::class == $activity->subject_type) {
                        $sentence .= "company's " . $object->name . " data.";
                    } elseif (Employee::class == $activity->subject_type) {
                        //accounts added to the company
                        $sentence .= $object->name . " as an account for company " . $company->name . ".";
                    }
                }
                $construct[] = [$subject, $object, $dateString, $sentence];
            }
        }
        return $construct;
    }

    public function constructSentenceFromAction($action, $activity)
    {
        if ($action == "created") {
            if (isset($activity->getExtraProperty('attributes')['file_name'])) {
                //File uploads
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
