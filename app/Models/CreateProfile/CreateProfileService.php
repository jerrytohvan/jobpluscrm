<?php

namespace App\Models\CreateProfile;

use App\Models\Posts\Post;
use App\Models\CreateProfile\User;
use App\Models\Comments\Comment;

use Illuminate\Http\Request;


class CreateProfileService
{
  //index, show, create, delete, edit

  /**
   * Checks user existed and creates a new user
   * @param  Array   $array
   * @return Company $company
   * @author jerrytohvan
   */
   public function updateProfile($user, $array)
   {
    // return User::create([
    // ]);

    $user= new User();
    $user->name= $request['name'];
    $user->email= $request['email'];
    $user->password= $request['password'];
    $user->mobile= $request['mobile'];
    // add other fields
    $user->save();

    
    // return Company::create([
    //   'name' => $array->company_name,
    //     'address' => $array->address,
    //     'email' => $array->company_email,
    //   'telephone_no' => $array->telephone,
    //   'fax_no' => $array->fax,
    //   'website' => $array->website,
    //   'no_employees' => $array->no_employees == "" ? null :$array->no_employees ,
    //   'industry' => $array->industry,
    //   'lead_source' => $array->lead_source,
    //   'description' => $array->description
    //   ]);



    //  $post = new Post();
    //  $post->content =$array['body'];
    //  $post->user_id = $user->id;
    //  if ($user->comments()->save($post)) {
    //      $comment = new Comment();
    //      $post->comment()->save($comment);

    //  }
    //  return $post;
    //  }
}
}