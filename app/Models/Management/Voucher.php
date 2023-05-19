<?php

namespace App\Models\Management;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;
use Helper;
use Storage;

class Voucher extends Model
{
    use HasFactory;
    protected $table = 'voucher';

    protected $fillable = [
        'id',
        'name',
        'point',
        'image',
        'description',
        'expired_date',
        'kode',
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

        $data = Voucher::orderBy('point','desc')->get();

        return $data;
    }

    public static function detailData($id){

        $data = Voucher::where('id',$id)->first();

        return $data;
    }


    public static function deleteData($id){

        $check=Voucher::find($id);

        if($check->image){
            Storage::delete('public/'.$check->image);
        }

        $data = Voucher::where('id',$id)->delete();

        return $data;
    }

    public static function insertData($request){

        if($request->file('image')){

            $image=Helper::image($request->file('image'),'status');
        }

        $data = Voucher::create([
            "id"                => Str::uuid(),
            "name"              => $request->name,
            "kode"              => $request->kode,
            "description"       => $request->description,
            "point"             => $request->point,
            "expired_date"      => $request->expired_date,
            "image"             => $image
        ]);
        return $data;
    }

    public static function updateData($request){
        
            $check=Voucher::find($request->id);

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

        $data = Voucher::where('id',$request->id)->update([
            "name"              => $request->name,
            "kode"              => $request->kode,
            "description"       => $request->description,
            "point"             => $request->point,
            "expired_date"      => $request->expired_date,
            "image"             => $image
        ]);
        
        return $data;
    }
}
