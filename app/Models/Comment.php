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
        'ip'
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
    //TODO: en el javascript instalar sweet alert y avisar que ya se guardo el comentario
    //TODO: probar que el comentario se guardo y no deje comentar de nuevo hasta 1 dia despues, probar la validacion con hora
    //TODO: crear en el panel admin que pueda guardar sin restriccion

    public static function saveComment($request)
    {
        $get_ip               = self::getRealIp();
        $get_comment_ip       = Comment::where('ip', $get_ip)->orderBy('created_at', 'DESC')->first();
        $data_comment         = $request->comment;
        $data_comment['ip']   = $get_comment_ip;
        $is_save              = true;

        if ($get_comment_ip != null) {
            $fecha1 = new DateTime($get_comment_ip->created_at);//fecha inicial
            $fecha2 = new DateTime(date('Y-m-d H:i:s'));//fecha de cierre
            $intervalo = $fecha1->diff($fecha2);
            $hour = $intervalo->format('%h');
            $day = $intervalo->format('%d');
            if ($day < 1) {
                $is_save = true;
            }
        }

        if ($is_save === true) {
            Comment::create($data_comment);
        }
    }
}
