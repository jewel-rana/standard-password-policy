<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateUserPasswordsEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        DB::unprepared('
//            CREATE EVENT delete_user_passwords_history
//            ON SCHEDULE AT CURRENT_TIMESTAMP + INTERVAL 1 DAY
//            ON COMPLETION PRESERVE
//
//            DO BEGIN
//                  DELETE user_passwords WHERE created_at <= DATE_SUB(NOW(), INTERVAL 15 DAY);
//            END;
//        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP EVENT [IF EXISTS] delete_user_passwords_history");
    }
}
