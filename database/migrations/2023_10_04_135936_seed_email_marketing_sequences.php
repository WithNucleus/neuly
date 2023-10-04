<?php

use App\Models\Email;
use App\Models\EmailCampaign;
use App\Models\EmailDrip;
use App\Models\EmailJourney;
use App\Models\EmailTemplate;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        /* Email Journeys */
        $welcomeJourney = EmailJourney::create([
           'name' => EmailJourney::JOURNEY_WELCOME,
           'description' => 'Intro emails for new users'
        ]);

        $autoResponseJourney = EmailJourney::create([
           'name' => EmailJourney::JOURNEY_AUTO_RESPONSE,
           'description' => 'Immediate response to forms / inquiries'
        ]);

        /* Welcome Emails */
        $welcomeTemplate1 = EmailTemplate::create([
            'name' => 'Welcome 1 - After Verification',
            'subject' => '{first_name}, Welcome to Neuly!',
            'body' => "Hi {first name},<br><br>Thanks so much for joining the growing Neuly community!<br><br>I'm hoping you already clicked around and explored our vast database on the psychedelic industry. It's your curiosity that is fueling all the excitement around everything that psychedelic medicines can offer to humanity.<br><br>At Neuly, our mission is simple. To offer a platform that delivers the highest quality information in the most efficient way. We know this is an insatiable mission that can only improve with your feedback and participation.<br><br>Please let me know if you need any assistance at all during your Neuly journey. Myself, and the entire Neuly team, are here to help any way we can.<br><br>Logan<br>On behalf of the Neuly team",
        ]);

        $neulyJourneyTemplate = EmailTemplate::create([
            'name' => 'Neuly Journey',
            'subject' => 'Embarking on the Neuly Journey',
            'body' => "Hi {first name},<br><br>Since you're new to Neuly, I wanted to give you a quick overview of what you can find and do inside our platform.<br><br>If you represent an organization, we encourage you to browse through our <a href='https://neuly.com/research'>Neuly Research</a> section.<br><br>If you're looking for a career in psychedelics or perhaps to become a certified psychedelic-assisted therapist, you can find hundreds of courses inside of <a href='https://neuly.com/courses'>Neuly EDU</a>.<br><br>Or, if you're in the market for a retreat or ketamine treatment, <a href='https://neuly.com/care'>Neuly's Care directory</a> serves as the perfect resource to find the right experience for you.<br><br>To make all of this even better, Neuly offers concierge services and support every step of the way. That means that if you ever need help finding the right match for you, regardless of what it is you're looking for, you can always reach out to us at <a href='concierge@neuly.com'>concierge@neuly.com</a> or text/call us at <a href='tel:+18666486254'>(866) 648-6254</a>.<br><br>Good luck on your journey!<br><br>Logan<br>On behalf of the Neuly team",
        ]);

        $welcomeTemplate3 = EmailTemplate::create([
            'name' => 'Welcome 3 - Neuly Needs You',
            'subject' => 'Who Are You Really?',
            'body' => "We built Neuly to help millions of people take advantage of what we believe are the most effective medicines the earth has to offer.<br><br>That's our mission. To serve. To educate. To help.<br><br>But Neuly can't do any of those things without people like you. The people that are brave enough to form a community and rally around the adoption of psychedelic-assisted therapies.<br><br>You are one of those people. The industry needs you. Stand up. Spread the word and help us help as many people as possible.<br><br>We'd love to hear about you and your experience(s) with psychedelics. Your response to this email also just might inform our system on how best to keep you most educated about everything that's happening in the industry.<br><br>Thank you for being here.<br><br>Logan<br>On behalf of the Neuly team",
        ]);

        $welcomeTemplate4 = EmailTemplate::create([
            'name' => 'Welcome 4 - Feedback',
            'subject' => 'What Do You Think of Neuly So Far?',
            'body' => "Hi {first name},<br><br>We know Neuly isn't perfect. In fact, we're constantly trying to fill the gaps because there is so much data and not enough team members.<br><br>To help with this process, we'd love your feedback.<br><br>That's why we have a <strong>Request a Listing</strong> form prominently displayed across the website. Just like Wikipedia's model, we know we need to rely on high-quality content curators and user-generated content in order to cover the broad landscape that is psychedelics.<br><br>So go ahead... <strong>give us your feedback</strong>. Our platform will be better off with it.",
        ]);

        $welcomeCampaign = EmailCampaign::create([
            'name' => 'Welcome to Neuly',
            'type' => EmailCampaign::TYPE_DRIP,
            'description' => 'Welcome sequence after signup / email verification',
            'trigger' => EmailCampaign::TRIGGER_ONBOARDING_USER_DETAILS_COMPLETE
        ]);

        $welcomeDrip1 = EmailDrip::create([
            'name' => $welcomeTemplate1->name,
            'order' => 1,
            'delay' => EmailDrip::DELAY_NONE,
            'email_campaign_id' => $welcomeCampaign->id,
            'email_template_id' => $welcomeTemplate1->id,
            'subject' => $welcomeTemplate1->subject,
            'body' => $welcomeTemplate1->body,
        ]);

        $welcomeDrip2 = EmailDrip::create([
            'name' => $neulyJourneyTemplate->name,
            'order' => 2,
            'delay' => \Carbon\CarbonInterval::day(),
            'email_campaign_id' => $welcomeCampaign->id,
            'email_template_id' => $neulyJourneyTemplate->id,
            'subject' => $neulyJourneyTemplate->subject,
            'body' => $neulyJourneyTemplate->body,
        ]);

        $welcomeDrip3 = EmailDrip::create([
            'name' => $welcomeTemplate3->name,
            'order' => 3,
            'delay' => \Carbon\CarbonInterval::days(2),
            'email_campaign_id' => $welcomeCampaign->id,
            'email_template_id' => $welcomeTemplate3->id,
            'subject' => $welcomeTemplate3->subject,
            'body' => $welcomeTemplate3->body,
        ]);

        $welcomeDrip4 = EmailDrip::create([
            'name' => $welcomeTemplate4->name,
            'order' => 4,
            'delay' => \Carbon\CarbonInterval::days(3),
            'email_campaign_id' => $welcomeCampaign->id,
            'email_template_id' => $welcomeTemplate4->id,
            'subject' => $welcomeTemplate4->subject,
            'body' => $welcomeTemplate4->body,
        ]);

        /* Enterprise Research Request */
        $researchRequestTemplate = EmailTemplate::create([
            'name' => 'Enterprise Research Request - Immediate Response',
            'subject' => 'Neuly Research is on the Case!',
            'body' => "Hi {first name},<br><br>Thank you for submitting an inquiry into our Neuly Research team. If your request requires a response, you can expect to receive one within 48 hours.<br><br>In the case that you are requesting a report be done for you, your project, or your organization, we will reach out with more information about our research processes, expected deliverables, and all associated pricing.<br><br> We look forward to working with you on your research project.<br><br>&ndash;The Neuly Research Team"
        ]);

        $researchRequestCampaign = EmailCampaign::create([
            'name' => 'Enterprise Research Request',
            'type' => EmailCampaign::TYPE_DRIP,
            'description' => 'Immediate response & welcome to Neuly',
            'trigger' => EmailCampaign::TRIGGER_ENTERPRISE_RESEARCH_REQUEST
        ]);

        $researchRequest1 = EmailDrip::create([
            'name' => $researchRequestTemplate->name,
            'order' => 1,
            'delay' => EmailDrip::DELAY_NONE,
            'email_campaign_id' => $researchRequestCampaign->id,
            'email_template_id' => $researchRequestTemplate->id,
            'subject' => $researchRequestTemplate->subject,
            'body' => $researchRequestTemplate->body,
        ]);

        $researchRequest2 = EmailDrip::create([
            'name' => 'Welcome After Enterprise Research Request',
            'order' => 2,
            'delay' => \Carbon\CarbonInterval::day(),
            'email_campaign_id' => $researchRequestCampaign->id,
            'email_template_id' => $neulyJourneyTemplate->id,
            'subject' => $neulyJourneyTemplate->subject,
            'body' => $neulyJourneyTemplate->body,
        ]);

        /* Add Templates to Journeys */
//        $neulyJourneyTemplate->emailJourneys()->sync([
//            $welcomeJourney->id,
//            $autoResponseJourney->id
//        ]);

        $autoResponseJourney->emailTemplates()->sync([
            $neulyJourneyTemplate->id
        ]);

        $welcomeJourney->emailTemplates()->sync([
            $welcomeTemplate1->id,
            $neulyJourneyTemplate->id,
            $welcomeTemplate3->id,
            $welcomeTemplate4->id,
        ]);
    }

    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        EmailTemplate::truncate();
        EmailCampaign::truncate();
        EmailDrip::truncate();
        EmailJourney::truncate();
        Email::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};
