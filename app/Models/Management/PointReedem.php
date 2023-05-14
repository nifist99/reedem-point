<?php

namespace App\Models\Management;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Helper;
use Storage;

class PointReedem extends Model
{
    use HasFactory;

    protected $table = 'point_reedem';

    protected $fillable = [
        'id',
        'member_id',
        'point',
        'date',
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

        $data = PointReedem::join('member','point_claim.member_id','=','member.id')
                ->select('point_claim.*','member.name as member')
                ->orderBy('point_claim.created_at','desc')
                ->get();

        return $data;
    }

    public static function detailData($id){

        $data = PointReedem::join('member','point_claim.member_id','=','member.id')
                ->where('point_claim.id',$id)
                ->select('point_claim.*','member.name as member')
                ->first();

        return $data;
    }

    public static function deleteData($id){

        $data = PointReedem::where('id',$id)->delete();

        return $data;
    }

    public static function insertData($request){

        $data = PointReedem::create([
            "id"        => Str::uuid(),
            "member_id" => $request->member_id,
            "point"     => $request->point,
            "date"      => $request->date,
        ]);
        return $data;
    }

    public static function updateData($request){
        
        $data = PointReedem::where('id',$request->id)->update([
            "member_id" => $request->member_id,
            "point"     => $request->point,
            "date"      => $request->date,
        ]);
        return $data;
    }
}