<?php

namespace App\Http\Controllers;

use App\Events\MessageEvent;
use App\Models\Message;
use App\Models\Room;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function chatinroom($id)
    {
        $userLogedIn = Auth::user();
        $room = Room::with('message')->find($id);
        // dd($room);
        return response()->json([
            'success' => true,
            'data' => $room,
        ]);
    }
    public function newMessage($id)
    {
        $room = Room::with('message')->find($id);
        $latestMessage = $room->message->latest()->first();
        return response()->json([
            'success' => true,
            'data' => $latestMessage,
        ]);
    }

    public function chatcustomer($id)
    {
        $userLogedIn = Auth::user();
        $customer = User::find($id);

        $room = Room::with(['message','user'])->find($id);
        if (!$id) {
            dd('gada');
        }
        // dd($room);
        return view('chat.index4', compact(['room', 'userLogedIn', 'customer']));
    }

    public function listroom(){
      
        // dd($room);
        $room = Room::with(['message','user'])->get();
        // dd($room);

        return view('chat.list_room',compact('room'));
    }

    public function index()
    {
        $userLogedIn = Auth::user();
        $room = Room::with('message')->find($userLogedIn->id);
        // dd($room);
        return view('chat.index4', compact(['room', 'userLogedIn']));
    }
    // Controller
    public function store(Request $request, $id)
    {
        try {
            $attrs = $request->validate([
                'message' => 'required',
            ]);

            $room = Room::find($id);

            if (!$room) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Room not found',
                    ],
                    404,
                );
            }

            $message = Message::create([
                'room_id' => $room->id,
                'user_id' => Auth::user()->id,
                'message' => $attrs['message'],
            ]);

            MessageEvent::dispatch($attrs['message'], $room->id, Auth::user()->id);

            return response()->json([
                'success' => true,
                'data' => $message,
                'message' => 'Message sent successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Error sending message',
                ],
                500,
            );
        }
    }
}
