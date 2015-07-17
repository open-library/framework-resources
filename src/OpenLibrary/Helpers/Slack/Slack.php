<?php
/**
 * Created by PhpStorm.
 * User: skhanker
 * Date: 16/06/2015
 * Time: 10:39 AM
 */

namespace UBC\LSIT\Framework\Providers\Slack;


class Slack {
    public static function slack ($message, $sendTeaser = false, $room = "random", $icon = ":ghost:")
    {

        $users = [
            "skhanker"
        ];

        $messages = [
            "jus workin it like the rent is due",
            "you go ingester, parse that body, four for you, you can do this",
            "open collections is coming",
            "to be or not to be (parsed), that is the question",
            "aint even bovvered",
            "art thou calling me a goodly rotten apple?!",
            "can't win them all, now can you"
        ];

        $teaser = "";
        if($sendTeaser){
            $teaser = " | @" . $users[rand (0, count ($users) - 1)] . " " . $messages[rand (0, count ($messages) - 1)];
        }


        $room = ($room) ? $room : "open-collections";
        $data = "payload=" . json_encode (
                [
                    "channel"    => "#{$room}",
                    "text"       => "{$message}{$teaser}",
                    "icon_emoji" => $icon
                ]
            );

        // You can get your webhook endpoint from your Slack settings
        $ch = curl_init ("https://hooks.slack.com/services/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");
        curl_setopt ($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt ($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        //$result = curl_exec ($ch);
        curl_close ($ch);
        //return $result;
    }
}
