<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index()
    {
        $data = $this->messages();
        $messages = [];

        foreach ($data as $message) {
            $messages[] = [
                'id' => $message->id,
                'message' => $message->message,
                'url' => $message->url,
                'destruction' => $message->destruction,
                'visited' => $message->visited,
                'visits' => $message->visits,
                'diff' => $this->hoursDifference($message->id),
            ];
        }

        return view('welcome', compact('messages'));
    }

    public function messages()
    {
        return Message::all();
    }

    public function message($url, Message $message) {
        $data = $message->where(['url' => $url])->get();
        if(!count($data)) return redirect('/');
        $data = $data[0];

        if ($data->destruction == 1) {
            $this->visitsIncrement($data->id);
            $data->visited++;

            if ($data->visited >= $data->visits)
                return $this->destroyMessage($data->id);
        }

        $message  = [
            'id' => $data->id,
            'message' => $data->message,
            'url' => $data->url,
            'destruction' => $data->destruction,
            'visited' => $data->visited,
            'visits' => $data->visits,
            'diff' => $this->hoursDifference($data->id),
        ];


        return view('message', compact('message'));
    }

    public function visitsIncrement($id)
    {
        $message = Message::find($id);
        $message->visited++;
        $message->save();
    }

    public function hoursDifference($id)
    {
        $message = Message::find($id);

        $date = date('Y-m-d H:i:s');
        $timeCreated = $message->created_at;
        $interval = ( 60 - ( (strtotime($date) - strtotime($timeCreated) ) / 60 ) );

        return round($interval, 2);
    }

    public function save(Request $request)
    {
        $m = microtime();

        $message = new Message;
        $message->url = md5($m);
        $message->message = $request->messageEncoded;
        $message->destruction = $request->destruction;
        $message->visits = $request->destruction == 1 ? $request->visits : 0;

        $message->save();

        return redirect('/');
    }

    public function destroyMessage($id)
    {
        $message = Message::find($id);
        $message->delete();
        return view('destroyed-message', ['url' => $message->url]);
    }
}
