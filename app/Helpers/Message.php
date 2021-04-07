<?php


namespace App\Helpers;


class Message
{
    /* System General Error Messages */

    const GENERAL_ERROR = "Something went wrong, please try again. If problem persist contact our support team.";

    /* Database related Notification Messages */

    const DB_RECORD_CREATED = 'Record has been created';

    const DB_RECORD_UPDATED = 'Record has been successfully updated';

    const DB_RECORD_DELETED = 'Record has been deleted';

    const DB_EMPTY_TABLE = 'Currently there are no records in database';

    const DB_RECORD_NOT_FOUND = 'Unable to find such record in database';

    const DB_RECORD_USER_CREATED = 'Record has been created and confirmation mail sent to the User';

    /* Authentication related Notification Messages */

    const AUTH_BAD_CREDENTIALS = 'Login Failed Wrong User Credentials';
}
