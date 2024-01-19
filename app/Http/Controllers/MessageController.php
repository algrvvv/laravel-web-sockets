<?php

namespace App\Http\Controllers;

use App\Events\StoreMessageEvent;
use App\Http\Requests\Message\MessageStoreRequest;
use App\Http\Resources\Message\MessageResource;
use App\Models\Message;

class MessageController extends Controller
{
    public function index(): \Inertia\Response|\Inertia\ResponseFactory
    {
        $messages = MessageResource::collection(Message::latest()->get())->resolve();
        return inertia('Message/Index', compact('messages'));
    }

    public function store(MessageStoreRequest $request): array
    {
        $data = $request->validated();
        $message = Message::create($data);

        broadcast(new StoreMessageEvent($message))->toOthers();

        return MessageResource::make($message)->resolve();
    }
}
