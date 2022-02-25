<?php

use Illuminate\Database\Seeder;

class UpdateOldMessageViewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $allMessages = \App\Message::with("thread.users")->get();

        \App\MessageView::where("id", ">", 0)->delete();
        foreach($allMessages as $message) {
            $receiver_id = null;
            foreach($message->thread->users as $user) {
                if($user->id != $message->sender_id) {
                    $receiver_id = $user->id;
                }
            }
            $message->saveViews($receiver_id);
        }

        echo "All Old message views updated successfully";
    }
}
