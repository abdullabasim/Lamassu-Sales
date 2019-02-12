<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User as userModel;
use App\Model\Role as roleModel;
use App\Http\Requests\Users\EditUser as editUserRequest;
use App\Model\Role;
use App\Http\Requests\Invoice\MainSearch AS mainSearchRequest;
use App\Http\Requests\Users\EditProfilePic as editProfilePicRequest;
use App\Http\Requests\Users\EditPassword as editPasswordRequest;


class Users extends Controller
{
    public function __construct()
    {

        $this->middleware('auth');
    }
    /**
     * use to edit user
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function userEditPage($id)
    {
        \Auth::user()->authorizeRoles(['Admin']);
        try {
            $user=userModel::findOrFail($id);

            $roles=roleModel::all();

            return view('auth.user_edit',[
                'user'=>$user,
                'roles'=>$roles
            ]);

        } catch (\Exception $e) {

            return back()
                ->with('error', 'User Info. not Update Please Try Again!!');
        }
    }

    public function userEdit(editUserRequest $request)
    {
        \Auth::user()->authorizeRoles(['Admin']);

        try{
            $user= userModel::findOrFail($request->userID);

            $user->roles()->detach();

            $role=roleModel::findOrFail($request->permission);


            if(isset($request->picture))
            {

                $picture= $user->picture;

                $filePath = public_path('files'.DIRECTORY_SEPARATOR . $picture);

                \File::delete($filePath);


                $pictureName=$this->randomCode(10).\Input::file('picture')->getClientOriginalName();

                \Input::file('picture')->move(public_path('files'), $pictureName );

                 userModel::where('id','=',$user->id)
                            ->update([
                                'name' => $request->name,
                                'email' => $request->email,
                                'picture'=>$pictureName,
                ]);

                $user ->roles()
                    ->attach(Role::where('name', $role->name)->first());

            }
            else
            {


                userModel::where('id','=',$user->id)
                    ->update([
                        'name' => $request->name,
                        'email' => $request->email,

                    ]);

                $user ->roles()
                    ->attach(Role::where('name', $role->name)->first());

            }

            return redirect('/userManage')
                ->with('success', 'User Edit successfully.');


        }
        catch (Exception $e)
        {
            return back()
                ->with('error', 'There is Problem ,Please Try Again');
        }
    }

    /**
     * use to users manage
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userManage()
    {
        \Auth::user()->authorizeRoles(['Admin']);

        $users = userModel::orderBy('id', 'DESC')->
        paginate(24);

        return view('auth.user_manage', [
            'users' => $users,
            'status' => "none"
        ]);
    }

    /**
     * use to delete user
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function userDelete($id)
    {

        \Auth::user()->authorizeRoles(['Admin']);

        try {
            $user = userModel::findOrFail($id);


            userModel::destroy(($user->id));

            return back()
                ->with('success', 'User Delete successfully.');
        } catch (\Exception $e) {

            return back()
                ->with('error', 'User not Deleted Please Try Again!!');
        }
    }

    public function userMainSearch(mainSearchRequest $request)
    {

        $users = userModel::where('name', 'LIKE', "%" . $request->search . "%")->
        orwhere('email', 'LIKE', "%" . $request->search . "%")->
        orderBy('id', 'DESC')
            ->paginate(24);


        return view('auth.user_manage', [
            'users' => $users,
            'status' => 'search Form',
        ]);

    }

    /**
     * Generate Random code
     *
     * @param $length
     * @return string
     */
    public  function randomCode($length)
    {
        $chars = "1234567890";
        $clen   = strlen( $chars )-1;
        $code  = '';

        for ($i = 0; $i < $length; $i++) {
            $code .= $chars[mt_rand(0,$clen)];
        }
        return ($code);
    }

   public function userPictureEditPage()
   {
       return view('auth.user_profile_edit');
   }

    public function userPictureEdit(editProfilePicRequest $request)
    {
        try{


        $picture= \Auth::user()->picture;

        $filePath = public_path('files'.DIRECTORY_SEPARATOR . $picture);

        \File::delete($filePath);


        $pictureName=$this->randomCode(10).\Input::file('poster')->getClientOriginalName();

        \Input::file('poster')->move(public_path('files'), $pictureName );

        userModel::where('id','=',\Auth::user()->id)
            ->update([

                'picture'=>$pictureName,
            ]);
            return redirect('/')
                ->with('success', 'Your Profile Picture Updated successfully.');


        }
        catch (Exception $e)
        {
            return back()
                ->with('error', 'There is Problem ,Please Try Again');
        }
    }

   public function passwordEditPage()
   {
       $password = userModel::find(\Auth::user()->id);
       return view('auth.change_password', [
           'password' => $password,

       ]);
   }

    public function passwordEdit(editPasswordRequest $request)
    {


        if(\Hash::check($request->oldPassword, \Auth::user()->password))
        {
            userModel::where('id', \Auth::user()->id)->
            update([
                'password' => \Hash::make($request->password)
            ]);

            return redirect('/')
                ->with('success', 'Password Changed successfully.');
        }
        else
         {
             return back()
                 ->with('error', 'The Password is Incorrect  ,Please Try Again');
         }

    }

}
