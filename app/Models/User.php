<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Request; // Corrected: Use Illuminate\Support\Facades\Request

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    static public function getSignle($id)
    {
        return User::find($id);
    }

    public static function getAdmin()
    {
        $return = self::select('*');  // or self::query() for better readability

        if (!empty(Request::get('id'))) {
            $return = $return->where('id', '=', Request::get('id'));
        }
        if (!empty(Request::get('is_admin'))) {
            $return = $return->where('is_admin', '=', Request::get('is_admin'));
        }

        if (!empty(Request::get('name'))) {
            $return = $return->where('name', 'like', '%'.Request::get('name').'%'); // Corrected: Use % for wildcard, not &
        }
        if (!empty(Request::get('email'))) {
            $return = $return->where('email', 'like', '%'.Request::get('email').'%'); // Corrected: Use % for wildcard, not &
        }
        if (!empty(Request::get('address'))) {
            $return = $return->where('address', 'like', '%'.Request::get('address').'%'); // Corrected: Use % for wildcard, not &
        }
        if (!empty(Request::get('status'))) {
            $status = Request::get('status');
            if ($status == 100) {
                $status = 0;
            }
            $return = $return->where('status', '=', $status);
        }
        $return = $return->whereIn('is_admin', array('1', '2'))
            ->where('is_delete','=', 0)
            ->orderBy('id', 'desc')
            ->paginate(20);
        return $return;
    }

    public static function getSchool()
    {
        $return = self::select('*');  // or self::query() for better readability

        if (!empty(Request::get('id'))) {
            $return = $return->where('id', '=', Request::get('id'));
        }
        if (!empty(Request::get('name'))) {
            $return = $return->where('name', 'like', '%'.Request::get('name').'%'); // Corrected: Use % for wildcard, not &
        }
        if (!empty(Request::get('email'))) {
            $return = $return->where('email', 'like', '%'.Request::get('email').'%'); // Corrected: Use % for wildcard, not &
        }
        if (!empty(Request::get('address'))) {
            $return = $return->where('address', 'like', '%'.Request::get('address').'%'); // Corrected: Use % for wildcard, not &
        }
        if (!empty(Request::get('status'))) {
            $status = Request::get('status');
            if ($status == 100) {
                $status = 0;
            }
            $return = $return->where('status', '=', $status);
        }
        $return = $return->where('is_admin', 3)
            ->where('is_delete', 0)
            ->orderBy('id', 'desc')
            ->paginate(20);
        return $return;
    }
    public static function getSchoolAll()
    {
        return self::select('*')
            ->where('is_admin', '=', 3) 
            ->where('is_delete', '=', 0)
            ->where('status', '=', 1)
            ->orderBy('id', 'desc')
            ->get();  
    }
    

    public static function getTeacher($user_id, $user_type)
    {
        $return = self::select('*');  // or self::query() for better readability

        if (!empty(Request::get('id'))) {
            $return = $return->where('id', '=', Request::get('id'));
        }
        if (!empty(Request::get('name'))) {
            $return = $return->where('name', 'like', '%'.Request::get('name').'%'); // Corrected: Use % for wildcard, not &
        }
        if (!empty(Request::get('last_name'))) {
            $return = $return->where('last_name', 'like', '%'.Request::get('last_name').'%'); // Corrected: Use % for wildcard, not &
        }
        if (!empty(Request::get('email'))) {
            $return = $return->where('email', 'like', '%'.Request::get('email').'%'); // Corrected: Use % for wildcard, not &
        }
        if (!empty(Request::get('gender'))) {
            $return = $return->where('gender', trim(Request::get('gender')));
        }
        
      
        if (!empty(Request::get('status'))) {
            $status = Request::get('status');
            if ($status == 100) {
                $status = 0;
            }
            $return = $return->where('status', '=', $status);
        }
        if($user_type == 3)
        {
            $return = $return->where('created_by_id','=', $user_id);
        }
        $return = $return->where('is_admin','=',5)
             
            ->where('is_delete', '=', 0)
            ->orderBy('id', 'desc')
            ->paginate(20);
        return $return;
    }

    public static function getTeacherActive($user_id)
    {
        $return = self::select('*');  // or self::query() for better readability
        $return = $return->where('created_by_id','=', $user_id);
        $return = $return->where('is_admin','=',5)
            ->where('is_delete', '=', 0)
            ->where('status', '=', 1)
            ->orderBy('id', 'desc')
            ->get();
        return $return;
    }
    public static function getStudent($user_id, $user_type)
    {
        $return = self::select('*');  // or self::query() for better readability

        if (!empty(Request::get('id'))) {
            $return = $return->where('id', '=', Request::get('id'));
        }
        if (!empty(Request::get('name'))) {
            $return = $return->where('name', 'like', '%'.Request::get('name').'%'); // Corrected: Use % for wildcard, not &
        }
        if (!empty(Request::get('last_name'))) {
            $return = $return->where('last_name', 'like', '%'.Request::get('last_name').'%'); // Corrected: Use % for wildcard, not &
        }
        if (!empty(Request::get('email'))) {
            $return = $return->where('email', 'like', '%'.Request::get('email').'%'); // Corrected: Use % for wildcard, not &
        }
        if (!empty(Request::get('gender'))) {
            $return = $return->where('gender', trim(Request::get('gender')));
        }
        
      
        if (!empty(Request::get('status'))) {
            $status = Request::get('status');
            if ($status == 100) {
                $status = 0;
            }
            $return = $return->where('status', '=', $status);
        }
        if($user_type == 3)
        {
            $return = $return->where('created_by_id','=', $user_id);
        }
        $return = $return->where('is_admin','=',6)
            ->where('is_delete', '=', 0)
            ->orderBy('id', 'desc')
            ->paginate(20);
        return $return;
    }
    
    public static function getParent($user_id, $user_type)
    {
        $return = self::select('*');  // or self::query() for better readability

        if (!empty(Request::get('id'))) {
            $return = $return->where('id', '=', Request::get('id'));
        }
        if (!empty(Request::get('name'))) {
            $return = $return->where('name', 'like', '%'.Request::get('name').'%'); // Corrected: Use % for wildcard, not &
        }
        if (!empty(Request::get('last_name'))) {
            $return = $return->where('last_name', 'like', '%'.Request::get('last_name').'%'); // Corrected: Use % for wildcard, not &
        }
        if (!empty(Request::get('email'))) {
            $return = $return->where('email', 'like', '%'.Request::get('email').'%'); // Corrected: Use % for wildcard, not &
        }
        if (!empty(Request::get('gender'))) {
            $return = $return->where('gender', trim(Request::get('gender')));
        }
        
      
        if (!empty(Request::get('status'))) {
            $status = Request::get('status');
            if ($status == 100) {
                $status = 0;
            }
            $return = $return->where('status', '=', $status);
        }
        if($user_type == 3)
        {
            $return = $return->where('created_by_id','=', $user_id);
        }
        $return = $return->where('is_admin','=',7)
            ->where('is_delete', '=', 0)
            ->orderBy('id', 'desc')
            ->paginate(20);
        return $return;
    }

    public static function getParentMyStudent($parent_id)
    {
        $return = self::select('*');  // or self::query() for better readability
        $return = $return->where('parent_id','=', $parent_id);
        $return = $return->where('is_admin','=',6)
            ->where('is_delete', '=', 0)
            ->orderBy('id', 'desc')
            ->get();
        return $return;
    }
    
    public static function getSchoolAdmin($user_id, $user_type)
    {
        $return = self::select('*');  // or self::query() for better readability

        if (!empty(Request::get('id'))) {
            $return = $return->where('id', '=', Request::get('id'));
        }
        if (!empty(Request::get('name'))) {
            $return = $return->where('name', 'like', '%'.Request::get('name').'%'); // Corrected: Use % for wildcard, not &
        }
        if (!empty(Request::get('email'))) {
            $return = $return->where('email', 'like', '%'.Request::get('email').'%'); // Corrected: Use % for wildcard, not &
        }
        if (!empty(Request::get('address'))) {
            $return = $return->where('address', 'like', '%'.Request::get('address').'%'); // Corrected: Use % for wildcard, not &
        }
      
        if (!empty(Request::get('status'))) 
        {
            $status = Request::get('status');
            if ($status == 100) {
                $status = 0;
            }
            $return = $return->where('status', '=', $status);
        }
        if($user_type == 3)
        {
            $return = $return->where('created_by_id','=', $user_id);
        }

        $return = $return->where('is_admin','=', 4)     
            ->where('is_delete', '=', 0)
            ->orderBy('id', 'desc')
            ->paginate(20);
        return $return;
    }

    public function getCreatedBy()
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function getParentData()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    public function getClass()
    {
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function getProfile()
    {
        // Check if profile_pic is not null and the file exists
        if (!empty($this->profile_pic) && file_exists(public_path('upload/profile/' . $this->profile_pic))) {
            return url('upload/profile/' . $this->profile_pic);
        }
        return "";
    }

    public function getProfileLive()
    {
        // Check if profile_pic is not null and the file exists
        if (!empty($this->profile_pic) && file_exists(public_path('upload/profile/' . $this->profile_pic))) {
            return url('upload/profile/' . $this->profile_pic);
        }
        else
        {
            return url('upload/profile/anjai');
        }
    }
}