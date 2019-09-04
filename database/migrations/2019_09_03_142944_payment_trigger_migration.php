<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PaymentTriggerMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        DB::unprepared('CREATE TRIGGER billing_default_payment AFTER INSERT ON `billings` FOR EACH ROW
                BEGIN
                    SELECT `payment` FROM `payments` WHERE user_id = `user_id` ORDER BY id DESC LIMIT 1 into @pay;

                   INSERT INTO `payments` (`user_id`, `billing_id`,`payment`, `created_at`, `updated_at`) VALUES (NEW.user_id, NEW.id,@pay-0.0489, now(), null);
                END');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
