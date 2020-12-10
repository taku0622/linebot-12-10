<?php

namespace App\Actives;

use Illuminate\Support\Facades\DB;


class Actives
{
    public function actives($userId, $text)
    {
        error_log("-------------- active mode -----------");
        error_log("userId: " . $userId . "  text: " . $text);
        // どのカラムにするかの分岐
        switch ($text) {
            case "質問":
                $column = 'question_count';
                break;
            case "重要情報":
                $column = 'important_count';
                break;
            case "新着情報":
                $column = 'new_count';
                break;
            case "休講案内":
                $column = 'canel_count';
                break;
            case "イベント":
                $column = 'setting_count';
                break;
            case "設定":
                $column = 'question_count';
                break;
            default:
                $column = 'question_count';
                break;
        }
        // データがあるか
        if (DB::table('actives')->where('user_id', $userId)->exists()) {
        } else { //ない時

        }
    }
}
