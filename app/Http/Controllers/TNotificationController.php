<?php

namespace App\Http\Controllers;

use App\Models\TNotification;
use Illuminate\Http\Request;

class TNotificationController extends Controller
{
    // Store a new notification
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'iconPath' => 'required|string',
            'user_id' => 'nullable|string|exists:users,uid',
        ]);

        $notification = TNotification::create([
            'title' => $request->title,
            'content' => $request->content,
            'iconPath' => $request->iconPath,
            'user_id' => $request->user_id,
        ]);

        return response()->json(['message' => 'Notification created successfully', 'data' => $notification], 201);
    }

    // Get all notifications
    public function index()
    {
        $notifications = TNotification::all();

        return response()->json(['data' => $notifications]);
    }

    // Get a single notification by id
    public function show($id)
    {
        // Retrieve notifications where user_id is null or user_id matches the provided $id
        $notifications = TNotification::where(function ($query) use ($id) {
            $query->whereNull('user_id')
                ->orWhere('user_id', $id)
                ->orderBy('created_at', 'desc')
                ->wehre('is_aktif', true);
        })->get();

        // If no notifications are found, return an empty array
        return response()->json(['data' => $notifications]);
    }



    // Update a notification
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'iconPath' => 'required|string',
            'user_id' => 'nullable|string|exists:users,uid',
        ]);

        $notification = TNotification::findOrFail($id);

        $notification->update([
            'title' => $request->title,
            'content' => $request->content,
            'iconPath' => $request->iconPath,
            'user_id' => $request->user_id,
        ]);

        return response()->json(['message' => 'Notification updated successfully', 'data' => $notification]);
    }

    // Delete a notification
    public function destroy($id)
    {
        $notification = TNotification::findOrFail($id);
        $notification->delete();

        return response()->json(['message' => 'Notification deleted successfully']);
    }
}
