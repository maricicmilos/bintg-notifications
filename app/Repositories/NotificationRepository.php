<?php


namespace App\Repositories;


use App\Notification;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class NotificationRepository
{
    /**
     * Returns all of the Notification records from database
     *
     * @return Notification[]|Collection
     */
    public function all()
    {
        return Notification::all();
    }

    /**
     * Gets Notification by Id
     *
     * @param $id
     * @return bool
     */
    public function getById($id)
    {
        try {
            return Notification::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return false;
        }
    }

    /**
     * Save Notifications records
     *
     * @param $data
     * @return bool
     */
    public function store($data)
    {
        try {
            $recipientsGroupsIds = $data['recipients'];
            $notification = Notification::create([
                'subject' => $data['subject'],
                'notification_content' => $data['notification_content']
            ]);

            $notification->specialties()->attach($recipientsGroupsIds ,
                [
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString()
                ]);

            return true;
        } catch (QueryException $e) {
            return false;
        }
    }

    /**
     * Update Notification Model record
     *
     * @param $data
     * @return bool
     */
    public function update($data)
    {
        try {
            $recipientsGroupsIds = $data['recipients'];
            $notification = $this->getById($data['notification_id']);

            $notification->specialties()->detach();
            $notification->specialties()->attach($recipientsGroupsIds,
                [
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString()
                ]);

            $notification->update($data);

            return true;
        } catch (QueryException $e) {
            return false;
        }
    }

    /**
     * Delete Notification Model record
     *
     * @param $id
     * @return bool
     */
    public function destroy($id)
    {
        try {
            $notification = $this->getById($id);
            $notification->specialties()->detach();
            $notification->delete();

            return true;
        } catch (QueryException $e) {

        }
    }

}
