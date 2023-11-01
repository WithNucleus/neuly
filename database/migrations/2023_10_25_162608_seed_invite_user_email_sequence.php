<?php

use App\Models\EmailJourney;
use App\Models\EmailSequence;
use App\Models\EmailTemplate;
use App\Models\EmailTrigger;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    const TEMPLATE1 = 'User Invitation: You\'re Invited';
    const TEMPLATE2 = 'User Invitation: 1st Reminder';
    const TEMPLATE3 = 'User Invitation: 2nd Reminder';
    const TEMPLATE4 = 'User Invitation: 3rd Reminder';
    const TEMPLATE5 = 'User Invitation: 4th Reminder';
    const TEMPLATE6 = 'User Invitation: 5th Reminder';
    const TEMPLATE7 = 'User Invitation: Invite Expiring';

    const JOURNEY = 'Invited User';
    const TRIGGER = 'Invited User';

    public function up()
    {
        /* TEMPLATES */
        $template1 = EmailTemplate::create([
            'name' => self::TEMPLATE1,
            'subject' => 'Your Personal Invite to Neuly.com',
            'body' => "Hi {first_name},<br><br>You are receiving this email because someone in the Neuly's psychedelic community wants you to join our data platform.<br><br>To accept the invitation and set up your profile, click the button below.<br><br>{button}<br><br>Once inside of Neuly, you'll have direct access to all of our psychedelics research, over 3,000 practitioners, and close to 500 educational courses.<br><br>Please let me know if you need any assistance at all during your Neuly journey. Myself, and the entire Neuly team, are here to help any way we can.<br><br>Welcome aboard!<br><br>Logan<br>On behalf of the Neuly team",
        ]);

        $template2 = EmailTemplate::create([
            'name' => self::TEMPLATE2,
            'subject' => 'Your Invite Reminder',
            'body' => "Hi {first_name},<br><br>This is just a reminder that someone is waiting for you to register and connect with them in Neuly.<br><br>To accept the invitation and set up your profile, click the button below.<br><br>{button}<br><br>Once inside of Neuly, you'll have direct access to all of our psychedelics research, over 3,000 practitioners, and close to 500 educational courses.<br><br>Please let me know if you need any assistance at all during your Neuly journey. Myself, and the entire Neuly team, are here to help any way we can.<br><br>Welcome aboard!<br><br>Logan<br>On behalf of the Neuly team",
        ]);

        $template3 = EmailTemplate::create([
            'name' => self::TEMPLATE3,
            'subject' => 'Neuly is Waiting',
            'body' => "Hi {first_name},<br><br>Don't keep the psychedelic industry waiting.<br><br>To accept the invitation and set up your profile, click the button below.<br><br>{button}<br><br>The Neuly Concierge team is looking forward to helping you out with anything you need inside the platform.<br><br>I'll see you inside.<br><br>Logan<br>On behalf of the Neuly team",
        ]);

        $template4 = EmailTemplate::create([
            'name' => self::TEMPLATE4,
            'subject' => 'Don\'t Miss Out on Neuly',
            'body' => "Hi {first_name},<br><br>With Neuly, you can connect with everyone in the psychedelics industry.<br><br>To accept the invitation and set up your profile, click the button below.<br><br>{button}<br><br>I can't wait to see who you connect with.<br><br>Logan<br>On behalf of the Neuly team",
        ]);

        $template5 = EmailTemplate::create([
            'name' => self::TEMPLATE5,
            'subject' => 'Reminder: Neuly.com Invite',
            'body' => "Hi {first_name},<br><br>It has been a few weeks and your invite to <a href='Neuly.com'>Neuly.com</a> will expire soon.<br><br>To accept the invitation and set up your profile, click the button below.<br><br>{button}<br><br>The Neuly Concierge team is looking forward to helping you out with anything you need inside the platform.<br><br>See you there!<br><br>Logan<br>On behalf of the Neuly team",
        ]);

        $template6 = EmailTemplate::create([
            'name' => self::TEMPLATE6,
            'subject' => 'Reminder: Neuly.com Invite',
            'body' => "Hi {first_name},<br><br>It has now been three weeks since you've been personally invited to <a href='Neuly.com'>Neuly.com</a>. Sadly, your invite will expire in 10 days.<br><br>To accept the invitation and set up your profile, click the button below.<br><br>{button}<br><br>The Neuly Concierge team is looking forward to helping you out with anything you need inside the platform.<br><br>See you there!<br><br>Logan<br>On behalf of the Neuly team",
        ]);

        $template7 = EmailTemplate::create([
            'name' => self::TEMPLATE7,
            'subject' => 'Your Neuly Invite is Expiring',
            'body' => "Hi {first_name},<br><br>Your personal invite to Neuly.com will expire in two days. It's not too late to join the most robust psychedelics industry platform on the internet.<br><br>To accept the invitation and set up your profile, click the button below.<br><br>{button}<br><br>Don't miss out!<br><br>Logan<br>On behalf of the Neuly team",
        ]);

        /* JOURNEY */
        $journey = EmailJourney::create([
            'name' => self::JOURNEY,
            'description' => 'After user is invited to Neuly',
        ]);

        /* SEQUENCES */
        EmailSequence::create([
            'order' => 1,
            'delay' => \Carbon\CarbonInterval::day(),
            'email_journey_id' => $journey->id,
            'email_template_id' => $template2->id
        ]);

        EmailSequence::create([
            'order' => 2,
            'delay' => \Carbon\CarbonInterval::days(3),
            'email_journey_id' => $journey->id,
            'email_template_id' => $template3->id
        ]);

        EmailSequence::create([
            'order' => 3,
            'delay' => \Carbon\CarbonInterval::days(7),
            'email_journey_id' => $journey->id,
            'email_template_id' => $template4->id
        ]);

        EmailSequence::create([
            'order' => 4,
            'delay' => \Carbon\CarbonInterval::days(14),
            'email_journey_id' => $journey->id,
            'email_template_id' => $template5->id
        ]);

        EmailSequence::create([
            'order' => 5,
            'delay' => \Carbon\CarbonInterval::days(21),
            'email_journey_id' => $journey->id,
            'email_template_id' => $template6->id
        ]);

        EmailSequence::create([
            'order' => 6,
            'delay' => \Carbon\CarbonInterval::days(28),
            'email_journey_id' => $journey->id,
            'email_template_id' => $template7->id
        ]);

        /* TRIGGER */
        EmailTrigger::create([
            'name' => self::TRIGGER,
            'description' => 'User is invited to Neuly by another user',
            'trigger' => EmailTrigger::TRIGGER_USER_INVITED,
            'status' => EmailTrigger::STATUS_ACTIVE,
            'auto_response_id' => $template1->id,
            'email_journey_id' => $journey->id,
        ]);
    }

    public function down()
    {
        EmailTemplate::whereIn('name', [
            self::TEMPLATE1,
            self::TEMPLATE2,
            self::TEMPLATE3,
            self::TEMPLATE4,
            self::TEMPLATE5,
            self::TEMPLATE6,
            self::TEMPLATE7,
        ])->delete();

        $journey = EmailJourney::with(['emailSequences'])->where('name', self::JOURNEY)->first();
        EmailSequence::where('email_journey_id', $journey->id)->delete();
        $journey->delete();

        EmailTrigger::where('name', self::TRIGGER)->delete();
    }
};
