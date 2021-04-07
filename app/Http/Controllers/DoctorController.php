<?php

namespace App\Http\Controllers;

use App\Helpers\Message;
use App\Notification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    public function notifications()
    {
        $user = Auth::user();
        $userSpecialtyId = $user->specialty->id;
        $seenNotificationsIds = [];

        $doctorNotifications = DB::table('notifications')
            ->join('notification_specialty', 'notifications.id', '=', 'notification_specialty.notification_id')
            ->select('*')
            ->where('notification_specialty.specialty_id', $userSpecialtyId)
            ->get();

        $userNotificationStatuses = DB::table('notification_user')->where('user_id', $user->id)->get();

        foreach ($doctorNotifications as $notification) {
            foreach ($userNotificationStatuses as $status) {
                if ($notification->notification_id === $status->notification_id) {
                    $seenNotificationsIds[] = $status->notification_id;
                }
            }
        }

        return view('doctor.notifications.index', compact(['doctorNotifications', 'seenNotificationsIds']));
    }

    public function read($id)
    {
        try {
            $notification = Notification::findOrFail($id);

            return view('doctor.notifications.view_notification', compact(['notification']));

        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with(['error' => Message::DB_RECORD_NOT_FOUND]);
        } catch (QueryException $e) {
            return redirect()->back()->with(['error' => Message::GENERAL_ERROR]);
        }

    }

    public function seen($id)
    {
        try {
            $notification = Notification::findOrFail($id);
            $user = Auth::user();

            DB::table('notification_user')->insert(
                [
                'notification_id' => $notification->id,
                'user_id' => $user->id,
                'notification_status' => true,
                'created_at' => Carbon::now()->toDateTimeString(),
                'updated_at' => Carbon::now()->toDateTimeString()
                ]
            );

            return redirect()->back();

        } catch (ModelNotFoundException $e) {
            return redirect()->back()->with(['error' => Message::DB_RECORD_NOT_FOUND]);
        } catch (QueryException $e) {
            return redirect()->back()->with(['error' => Message::GENERAL_ERROR]);
        }

    }
}
