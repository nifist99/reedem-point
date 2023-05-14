<?php

namespace App\Models\Management;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Helper;
use Storage;

class Member extends Model
{
    use HasFactory;

    protected $table = 'member';

    protected $fillable = [
        'id',
        'name',
        'phone',
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

        $data = Member::orderBy('created_at','desc')->get();

        return $data;
    }

    public static function detailData($id){

        $data = Member::where('id',$id)->first();

        return $data;
    }

    public static function deleteData($id){

        $data = Member::where('id',$id)->delete();

        return $data;
    }

    public static function insertData($request){

        $data = Member::create([
            "id"        => Str::uuid(),
            "name"      => $request->name,
            "phone"     => $request->phone,
            "created_by"=> Session::get('id'),
            "updated_by"=> Session::get('id')
        ]);
        return $data;
    }

    public static function updateData($request){
        
        $data = Member::where('id',$request->id)->update([
            "name"      => $request->name,
            "phone"     => $request->phone,
            "updated_by"=> Session::get('id')
        ]);
        return $data;
    }
}
