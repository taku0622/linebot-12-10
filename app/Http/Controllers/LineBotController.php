<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LINE\LINEBot;
use LINE\LINEBot\Event\MessageEvent\TextMessage;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;

class LineBotController extends Controller
{
    public function index()
    {
        return view('linebot.index');
    }

    public function parrot(Request $request)
    {
        $httpClient = new CurlHTTPClient(getenv('LINE_ACCESS_TOKEN'));
        $lineBot = new LINEBot($httpClient, ['channelSecret' => getenv('LINE_CHANNEL_SECRET')]);

        $signature = $request->header('x-line-signature');

        if (!$lineBot->validateSignature($request->getContent(), $signature)) {
            abort(400, 'Invalid signature');
        }

        $events = $lineBot->parseEventRequest($request->getContent(), $signature);

        foreach ($events as $event) {
            if (!($event instanceof TextMessage)) {
                continue;
            }

            $replyToken = $event->getReplyToken();
            $replyText = $event->getText();
            $lineBot->replyText($replyToken, $replyText);
        }
    }
}
