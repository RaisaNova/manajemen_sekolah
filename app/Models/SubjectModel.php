<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Request;

class SubjectModel extends Model
{
    protected $table = 'subject';

    static public function getSignle($id)
    {
        return SubjectModel::find($id);
    }    
    static public function getRecord($user_id, $user_type)
    {
        $return = self::select('*'); 
    
        if (!empty(Request::get('id'))) {
            $return = $return->where('id', '=', Request::get('id'));
        }

        if (!empty(Request::get('name'))) {
            $return = $return->where('name', 'like', '%'.Request::get('name').'%'); // Corrected: Use % for wildcard, not &
        }
        if (!empty(Request::get('status'))) {
            $status = Request::get('status');
            if ($status == 100) {
                $status = 0;
            }
            $return = $return->where('status', '=', $status);
        }
        $return = $return->where('created_by_id','=', $user_id);

        $return = $return
            ->where('is_delete','=', 0)
            ->orderBy('id', 'desc')
            ->paginate(20);
        return $return;
    } 
    
    static public function getRecordActive($user_id)
    {
        $return = self::select('*')
            ->where('status', '=', 1)
            ->where('created_by_id', '=', $user_id)
            ->where('is_delete', '=', 0)
            ->orderBy('id', 'desc')
            ->get();
        
        return $return;
    }
}

