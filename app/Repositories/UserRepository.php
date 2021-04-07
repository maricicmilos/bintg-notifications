<?php


namespace App\Repositories;


use App\Hospital;
use App\Http\Controllers\MailController;
use App\Role;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class UserRepository
{
    /**
     * Return all of the User records
     *
     * @return User[]|Collection
     */
    public function all()
    {
        return User::all();
    }

    /**
     * Gets User model buy its Id value
     *
     * @param $id
     * @return bool
     */
    public function getById($id)
    {
        try {
            return User::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return false;
        } catch (QueryException $e) {
            return false;
        }
    }

    /**
     * Store User record and send confirmation data to the User email
     *
     * @param $data
     * @return bool
     */
    public function store($data)
    {
        try {
            $generatedConfirmationString = sha1(Carbon::now()->timestamp . rand());
            $role = Role::where('name', 'doctor')->firstOrFail();

            $userCreated = User::create([
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'email' => $data['email'],
                'confirmation_code' => $generatedConfirmationString,
                'role_id' => $role->id,
                'specialty_id' => $data['specialty_id']
            ]);

            if ($userCreated) {
                $hospital = $this->hospitalRepository->getById($data['hospital_id']);
                $userCreated->hospitals()->attach($hospital, [
                    'created_at' => Carbon::now()->toDateTimeString(),
                    'updated_at' => Carbon::now()->toDateTimeString()
                ]);

                $emailData = [
                    'user_email' => strtolower($data['email']),
                    'confirmation_code' => $generatedConfirmationString
                ];

                MailController::sendConfirmationLink($emailData);

                return true;
            }

            return false;
        } catch (QueryException $e){
            return false;
        }

    }

    public function update($data)
    {
        try {
            $user = User::findOrFail($data['user_id']);

            $user->update([
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'email' => $data['email'],
                'role_id' => $data['role_id'],
                'specialty_id' => $data['specialty_id']
            ]);

            $hospital = Hospital::findOrFail($data['hospital_id']);

            if(strtolower($user->role->name) === 'doctor') {
                $user->hospitals()->sync([$hospital->id => ['updated_at' => Carbon::now()->toDateTimeString()]]);
            }

            return true;
        } catch (ModelNotFoundException $e) {
            return false;
        } catch (QueryException $e) {
            return false;
        }
    }
}
