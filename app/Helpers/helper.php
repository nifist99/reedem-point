<?php
namespace App\Helpers;

use Carbon\Carbon;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Http;
use Image;
use Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Nfs;
use App\Models\Management\Member;
use App\Models\Management\MemberStatus;
use App\Models\Management\PointClaim;
use App\Models\Management\PointReedem;
class Helper {

    public static function statusMember($member_id){
        $point  = PointReedem::where('member_id',$member_id)->sum('point');

        $status = MemberStatus::where('point','<=',$point)->first();

        return [
            "status" => $status->name,
            "image"  => $status->image
        ];
    }

    public static function totalPoint($member_id){
        $point = PointReedem::where('member_id',$member_id)->sum('point');

        return $point;
    }

    public static function claimPoint($member_id){

        $point = PointClaim::where('member_id',$member_id)->sum('point');

        return $point;
    }

    public static function sisaPoint($member_id){

        $point = PointReedem::where('member_id',$member_id)->sum('point');

        $claim = PointClaim::where('member_id',$member_id)->sum('point');

        return $point - $claim;
    }

    public static function resizeImage($file,$folder){
        $image              = $file;
        $ext                = $file->extension();
        $filename           = Str::random(50).'.'.$ext;

        $lebar_gambar = Image::make($file)->width();
    
        $lebar_gambar -= $lebar_gambar * 50 / 100;
     
        $destinationPath = storage_path().'/app/public'.'/'.$folder;
        $img = Image::make($image->path());
        $img->resize($lebar_gambar, null, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$filename);
   
        return $folder.'/'.$filename;
    }

    public static function image($file,$folder){

        $ext                = $file->extension();
        
        $filename           = Str::random(50).'.'.$ext;
        $file_path          = 'public/'.$folder;

        $path               =Storage::putFileAs($file_path, $file, $filename);

        return $folder.'/'.$filename;
    }

    public static function deleteImage($location){
        
        $check = Storage::delete('public/'.$location);
        
        return $check;
    }

    public static function upper($str){
        return strtoupper($str);
    }

    public static function uc($str){
        return ucfirst($str);
    }

    //GENERATE URL VERIFIKASI

    public static function urlVerifikasi($email){
        $en     = Nfs::Encrypt($email);

        $result = url('verifikasi/'.$en);

        return $result;

    }


}