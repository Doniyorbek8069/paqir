<?php

namespace App\Services;

use App\Models\Contract;
use App\Models\Objects;
use App\Models\Payment;

class TelegramBotService
{   
    public static function sendmessage($text,$id)
    {
        $ChatIds = array('5907512751',$id);
        $token = "7733541244:AAH3lAM8aLv6-tYrmfH9TVNlkoAzHw8jDCg";
        foreach($ChatIds as $chatId){
                $post = [
                    'chat_id' => $chatId,
                    'text' => $text,
                    'parse_mode' => 'HTML',
                    'disable_web_page_preview' => false,
                ];
                $url = 'https://api.telegram.org/bot' . $token . '/sendMessage';
                $ch = curl_init($url);

                curl_setopt($ch, CURLOPT_HEADER, false);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
                $result = json_decode(curl_exec($ch));
                curl_close($ch);
        }

        return true;
    }
}