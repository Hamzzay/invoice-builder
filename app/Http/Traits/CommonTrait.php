<?php

namespace App\Http\Traits;

use App\Models\Card;
use Twilio\Rest\Client;
use App\Models\UserWallet;
use Illuminate\Support\Str;
use App\Models\Notification;
use Illuminate\Support\Facades\Response;

trait CommonTrait
{
    function sendSuccess($message, $data = null)
    {
        return response()->json([
            'status' => 200,
            'message' => $message,
            'data' => $data,
        ]);
    }
    function sendError($error_message, $code = 400, $data = null)
    {
        return response()->json([
            'status' => $code,
            'message' => $error_message,
            'data' => $data,
        ]);
    }

    function addFile($file, $path)
    {
        if ($file) {
            if ($file->getClientOriginalExtension() != 'exe') {
                $type = $file->getClientMimeType();
                $destination_path = $path;
                $extension = $file->getClientOriginalExtension();
                $fileName = Str::random(15) . '.' . $extension;
                //$img=Image::make($file);
                $file->move($destination_path, $fileName);
                $file_path = $destination_path . $fileName;
                return $file_path;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function createWallet($user_id)
    {
        $wallet = UserWallet::where('user_id', $user_id)->first();

        if (!$wallet) {
            $wallet = new UserWallet;
            $wallet->user_id = $user_id;
            $wallet->save();
        }
    }

    function sendSms($messageText, $to)
    {
        $sid = env("TWILIO_ACCOUNT_SID");
        $token = env("TWILIO_AUTH_TOKEN");
        $twilio = new Client($sid, $token);

        $message = $twilio->messages
            ->create(
                $to, // to
                array(
                    "messagingServiceSid" => env("TWILIO_MESSAGE_SERVICE_ID"),
                    "body" => $messageText,
                )
            );
        return $message;
    }

    function send_OneSignal_Notification($message, $data, $emails)
    {
        $content = array(
            "en" => $message,
        );

        $fields = array(
            'app_id' => env("ONESIGNAL_APP_ID"),
            'include_external_user_ids' => $emails,
            'channel_for_external_user_ids' => 'push',
            'data' => $data,
            'contents' => $content,
        );

        $fields = json_encode($fields);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Basic ' . env("ONESIGNAL_REST_API_KEY")
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}
