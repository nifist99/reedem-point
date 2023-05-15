<?php

namespace App\Models\Management;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Helper;
use Storage;

class MemberStatus extends Model
{
    use HasFactory;

    protected $table = 'member_status';

    protected $fillable = [
        'id',
        'name',
        'point',
        'image',
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

        $data = MemberStatus::orderBy('point','desc')->get();

        return $data;
    }

    public static function detailData($id){

        $data = MemberStatus::where('id',$id)->first();

        return $data;
    }


    public static function deleteData($id){

        $check=MemberStatus::find($id);

        if($check->image){
            Storage::delete('public/'.$check->image);
        }

        $data = MemberStatus::where('id',$id)->delete();

        return $data;
    }

    public static function insertData($request){

        if($request->file('image')){

            $image=Helper::image($request->file('image'),'status');
        }

        $data = MemberStatus::create([
            "id"        => Str::uuid(),
            "name"      => $request->name,
            "point"     => $request->point,
            "image"     => $image
        ]);
        return $data;
    }

    public static function updateData($request){
        
            $check=MemberStatus::find($request->id);

            if($check->image){

                if($request->file('image')){
                    // delete file before update
                    Storage::delete('public/'.$check->image);

                    $image=Helper::image($request->file('image'),'status');
                }else{
                    $image = $check->image;
                }
            }else{
                if($request->file('image')){

                    $image=Helper::image($request->file('image'),'status');
                }else{
                    $image = $check->image;
                }
            }

        $data = MemberStatus::where('id',$request->id)->update([
            "name"      => $request->name,
            "point"     => $request->point,
            "image"     => $image
        ]);
        
        return $data;
    }
}
