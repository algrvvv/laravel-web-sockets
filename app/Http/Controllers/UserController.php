<?php

namespace App\Http\Controllers;

use App\Events\SendLikeEvent;
use App\Http\Requests\User\SendLikeRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function show(User $user): \Inertia\Response|\Inertia\ResponseFactory
    {
        return inertia('User/Show', compact('user'));
    }

    public function sendLike(SendLikeRequest $request, User $user): \Illuminate\Http\JsonResponse
    {
        $data = $request->validated();

        $otherUser = User::find($data['from_id']);

        $message = "Страницу " . $user->name . " лайкнул " . $otherUser->name;

        broadcast(new SendLikeEvent($message, $user->id));

        return response()->json([
            "message" => $message
        ]);
    }

}
