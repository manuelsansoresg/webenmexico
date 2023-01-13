<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'comment',
        'is_admin',
        'ip',
        'active'
    ];
    public function getRealIp()
    {
        if (isset($_SERVER["HTTP_CLIENT_IP"])) {
            return $_SERVER["HTTP_CLIENT_IP"];
        } elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        } elseif (isset($_SERVER["HTTP_X_FORWARDED"])) {
            return $_SERVER["HTTP_X_FORWARDED"];
        } elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])) {
            return $_SERVER["HTTP_FORWARDED_FOR"];
        } elseif (isset($_SERVER["HTTP_FORWARDED"])) {
            return $_SERVER["HTTP_FORWARDED"];
        } else {
            return $_SERVER["REMOTE_ADDR"];
        }
    }
    public static function saveComment($request, $is_admin = false)
    {
        $get_ip               = self::getRealIp();
        $get_comment_ip       = Comment::where('ip', $get_ip)->orderBy('created_at', 'DESC')->first();
        $data_comment         = $request->comment;
        $data_comment['ip']   = $get_ip;
        $is_save              = true;
        if ($get_comment_ip != null && $is_admin == false) {
            $fecha1 = new DateTime($get_comment_ip->created_at);//fecha inicial
            $fecha2 = new DateTime(date('Y-m-d H:i:s'));//fecha de cierre
            $intervalo = $fecha1->diff($fecha2);
            $hour = $intervalo->format('%h');
            $day = $intervalo->format('%d');
            if ($hour < 1) {
                $is_save = false;
            }
        }

        if ($is_save === true) {
            Comment::create($data_comment);
        }
        return $is_save;
    }

    public function getActive()
    {
        $comment = Comment::where('active', 1)->get();
        return $comment;
    }
}
