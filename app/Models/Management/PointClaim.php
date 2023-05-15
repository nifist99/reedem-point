<?php

namespace App\Models\Management;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Helper;
use Storage;

class PointClaim extends Model
{
    use HasFactory;

    protected $table = 'point_claim';

    protected $fillable = [
        'id',
        'member_id',
        'point',
        'date',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];

    public function getIncrementing()
    {
        return false;
    }

    /**
     * Get the auto-incrementing key type.
     *
     * @return string
     */
    public function getKeyType()
    {
        return 'string';
    }

    public static function listData(){

        $data = PointClaim::join('member','point_claim.member_id','=','member.id')
                ->join('users','point_claim.created_by','=','users.id')
                ->select('point_claim.*','member.name as member', 'users.name as users')
                ->orderBy('point_claim.created_at','desc')
                ->get();

        return $data;
    }

    public static function detailData($id){

        $data = PointClaim::join('member','point_claim.member_id','=','member.id')
                ->join('users','point_claim.created_by','=','users.id')
                ->where('point_claim.id',$id)
                ->select('point_claim.*','member.name as member', 'users.name as users')
                ->first();

        return $data;
    }

    public static function deleteData($id){

        $data = PointClaim::where('id',$id)->delete();

        return $data;
    }

    public static function insertData($request){

        $data = PointClaim::create([
            "id"        => Str::uuid(),
            "member_id" => $request->member_id,
            "point"     => $request->point,
            "date"      => $request->date,
            'created_by'=> Session::get('id'),
            'updated_by'=> Session::get('id')
        ]);
        return $data;
    }

    public static function updateData($request){
        
        $data = PointClaim::where('id',$request->id)->update([
            "member_id" => $request->member_id,
            "point"     => $request->point,
            "date"      => $request->date,
            'updated_by'=> Session::get('id')
        ]);
        return $data;
    }
}
