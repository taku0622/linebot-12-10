<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use LINE\LINEBot;
use LINE\LINEBot\HTTPClient\CurlHTTPClient;

use App\Actives\Actives;

class LineBotController extends Controller
{
    public function index()
    {
        return view('linebot.index');
    }

    public function parrot(Request $request)
    {
        error_log("============== hello ============");
        $httpClient = new CurlHTTPClient(getenv('LINE_ACCESS_TOKEN'));
        $lineBot = new LINEBot($httpClient, ['channelSecret' => getenv('LINE_CHANNEL_SECRET')]);

        $signature = $request->header('x-line-signature');

        if (!$lineBot->validateSignature($request->getContent(), $signature)) {
            abort(400, 'Invalid signature');
        }

        $events = $lineBot->parseEventRequest($request->getContent(), $signature);

        foreach ($events as $event) {
            $replyToken = $event->getReplyToken();
            $replyText = $event->getText();
            $userId = $event->getUserId();
            error_log("replyToken is : " . $replyToken . "  replyText is : " . $replyText . "  userId is : " . $userId);
            error_log($replyText);
            $active = new Actives();
            $active->responseActives($userId, $replyText);
            $lineBot->replyText($replyToken, $replyText);
        }
    }
}
