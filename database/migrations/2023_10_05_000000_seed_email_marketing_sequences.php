<?php

use App\Models\Email;
use App\Models\EmailJourney;
use App\Models\EmailSequence;
use App\Models\EmailTemplate;
use App\Models\EmailTrigger;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up()
    {
        /**
         * TEMPLATES
         */
        $welcomeIntroTemplate = EmailTemplate::create([
            'name' => 'Welcome to Neuly',
            'subject' => '{first_name}, Welcome to Neuly!',
            'body' => "Hi {first name},<br><br>Thanks so much for joining the growing Neuly community!<br><br>I'm hoping you already clicked around and explored our vast database on the psychedelic industry. It's your curiosity that is fueling all the excitement around everything that psychedelic medicines can offer to humanity.<br><br>At Neuly, our mission is simple. To offer a platform that delivers the highest quality information in the most efficient way. We know this is an insatiable mission that can only improve with your feedback and participation.<br><br>Please let me know if you need any assistance at all during your Neuly journey. Myself, and the entire Neuly team, are here to help any way we can.<br><br>Logan<br>On behalf of the Neuly team",
        ]);

        $neulyJourneyTemplate = EmailTemplate::create([
            'name' => 'Neuly Journey',
            'subject' => 'Embarking on the Neuly Journey',
            'body' => "Hi {first name},<br><br>Since you're new to Neuly, I wanted to give you a quick overview of what you can find and do inside our platform.<br><br>If you represent an organization, we encourage you to browse through our <a href='https://neuly.com/research'>Neuly Research</a> section.<br><br>If you're looking for a career in psychedelics or perhaps to become a certified psychedelic-assisted therapist, you can find hundreds of courses inside of <a href='https://neuly.com/courses'>Neuly EDU</a>.<br><br>Or, if you're in the market for a retreat or ketamine treatment, <a href='https://neuly.com/care'>Neuly's Care directory</a> serves as the perfect resource to find the right experience for you.<br><br>To make all of this even better, Neuly offers concierge services and support every step of the way. That means that if you ever need help finding the right match for you, regardless of what it is you're looking for, you can always reach out to us at <a href='concierge@neuly.com'>concierge@neuly.com</a> or text/call us at <a href='tel:+18666486254'>(866) 648-6254</a>.<br><br>Good luck on your journey!<br><br>Logan<br>On behalf of the Neuly team",
        ]);

        $neulyNeedsYouTemplate = EmailTemplate::create([
            'name' => 'Neuly Needs You',
            'subject' => 'Who Are You Really?',
            'body' => "We built Neuly to help millions of people take advantage of what we believe are the most effective medicines the earth has to offer.<br><br>That's our mission. To serve. To educate. To help.<br><br>But Neuly can't do any of those things without people like you. The people that are brave enough to form a community and rally around the adoption of psychedelic-assisted therapies.<br><br>You are one of those people. The industry needs you. Stand up. Spread the word and help us help as many people as possible.<br><br>We'd love to hear about you and your experience(s) with psychedelics. Your response to this email also just might inform our system on how best to keep you most educated about everything that's happening in the industry.<br><br>Thank you for being here.<br><br>Logan<br>On behalf of the Neuly team",
        ]);

        $feedbackTemplate = EmailTemplate::create([
            'name' => 'First Impression Feedback',
            'subject' => 'What Do You Think of Neuly So Far?',
            'body' => "Hi {first name},<br><br>We know Neuly isn't perfect. In fact, we're constantly trying to fill the gaps because there is so much data and not enough team members.<br><br>To help with this process, we'd love your feedback.<br><br>That's why we have a <strong>Request a Listing</strong> form prominently displayed across the website. Just like Wikipedia's model, we know we need to rely on high-quality content curators and user-generated content in order to cover the broad landscape that is psychedelics.<br><br>So go ahead... <strong>give us your feedback</strong>. Our platform will be better off with it.",
        ]);

        $researchRequestTemplate = EmailTemplate::create([
            'name' => 'Auto-Response: Enterprise Research Request',
            'subject' => 'Neuly Research is on the Case!',
            'body' => "Hi {first name},<br><br>Thank you for submitting an inquiry into our Neuly Research team. If your request requires a response, you can expect to receive one within 48 hours.<br><br>In the case that you are requesting a report be done for you, your project, or your organization, we will reach out with more information about our research processes, expected deliverables, and all associated pricing.<br><br> We look forward to working with you on your research project.<br><br>&ndash;The Neuly Research Team"
        ]);

        $listingRequestTemplate = EmailTemplate::create([
            'name' => 'Auto-Response: New Listing Request',
            'subject' => 'Your Neuly Listing Has Been Submitted!',
            'body' => "Hi {first name},<br><br>Thank you for taking the time to request a change to the growing Neuly database.<br><br>As a lean team, we can't do everything ourselves. That's why we welcome any and all outside support and participation when it comes to data integrity and hygiene.<br><br>After all, Neuly is only as useful as the data it keeps. So please... keep the requests coming.<br><br>&ndash;The Neuly Research Team"
        ]);

        $apiRequestTemplate = EmailTemplate::create([
            'name' => 'Auto-Response: API Request',
            'subject' => 'So... You Want Some of That Neuly API?',
            'body' => "Hi {first name},<br><br>Thank you for inquiring for more information about the Neuly API. If your request requires a response, you can expect to receive one within 48 hours.<br><br>In the case that you are looking for a specific use case, please feel free to elaborate on how you plan to use Neuly's data in a response to this email. Your response just might expedite your request and allow us to come to a solution quicker.<br><br>We look forward to working with you on your project.<br><br>&ndash;The Neuly Team"
        ]);

        $enterpriseRequestTemplate = EmailTemplate::create([
            'name' => 'Auto-Response:  Enterprise Request',
            'subject' => 'Neuly for Organizations',
            'body' => "Hi {first name},<br><br>Thank you for inquiring about Neuly's enterprise product offerings. We've been working hard developing some pretty awesome tools that the industry can expect to get a lot of value and insight from. Our team is excited to show them to you.<br><br>One of our team members will follow up with you within 48 hours.<br><br>In the meantime, keep doing awesome things in the psychedelics industry. The world needs you right now.<br><br>&ndash;The Neuly Research Team"
        ]);

        $recruitingTrialsTemplate = EmailTemplate::create([
            'name' => 'Auto-Response: Recruiting Clinical Trials',
            'subject' => 'Your Interest in Clinical Trials',
            'body' => "Hi {first name},<br><br>Thanks for your interest in {clinicaltrial_name}. We've relayed your information to the facilitator and will notify you if and when a spot becomes available for you to participate.<br><br>If you have any questions before then, please don't hesitate to reach out to the Neuly Concierge team. We are always happy to help!<br><br>&ndash;The Neuly Team"
        ]);

        $neulyCareRequestTemplate = EmailTemplate::create([
            'name' => 'Auto-Response: Neuly Care Request',
            'subject' => 'Your Interest in Psychedelic Treatments',
            'body' => "Hi {first name},<br><br>Thanks for your interest in psychedelic-assisted therapy. We've relayed your information to the facilitator and will notify you if and when a spot becomes available for you to participate.<br><br>If you have any questions before then, please don't hesitate to reach out to the Neuly Concierge team. We are always happy to help!<br><br>&ndash;The Neuly Team"
        ]);

        $neulyEduRequestTemplate = EmailTemplate::create([
            'name' => 'Auto-Response: Neuly EDU Request',
            'subject' => 'Your Interest in Psychedelic Education',
            'body' => "Hi {first name},<br><br>Thanks for your interest in {course_name}. We've relayed your information to the appropriate NeulyEDU partner and will follow-up with you shortly to gather more information from you or connect you directly with course enrollment.<br><br>If you have any questions before then, please don't hesitate to reach out to the Neuly Concierge team. We are always happy to help!<br><br>&ndash;The Neuly Team"
        ]);

        /**
         * Auto-Response Campaigns
         */
        $firstImpressionJourney = EmailJourney::create([
            'name' => 'First Impression',
            'description' => 'After user registration',
        ]);

        $enterpriseJourney = EmailJourney::create([
            'name' => 'Enterprise',
            'description' => 'After enterprise or research requests',
        ]);

        $partnerJourney = EmailJourney::create([
            'name' => 'Partner',
            'description' => 'After API or partner requests',
        ]);

        $careJourney = EmailJourney::create([
            'name' => 'Care',
            'description' => 'After care requests',
        ]);

        $eduJourney = EmailJourney::create([
            'name' => 'EDU',
            'description' => 'After edu requests',
        ]);

        /**
         * Sequences
         */
        // Welcome
        EmailSequence::create([
            'order' => 1,
            'delay' => \Carbon\CarbonInterval::day(),
            'email_journey_id' => $firstImpressionJourney->id,
            'email_template_id' => $neulyJourneyTemplate->id
        ]);

        EmailSequence::create([
            'order' => 2,
            'delay' => \Carbon\CarbonInterval::days(2),
            'email_journey_id' => $firstImpressionJourney->id,
            'email_template_id' => $neulyNeedsYouTemplate->id
        ]);

        EmailSequence::create([
            'order' => 3,
            'delay' => \Carbon\CarbonInterval::days(3),
            'email_journey_id' => $firstImpressionJourney->id,
            'email_template_id' => $feedbackTemplate->id
        ]);

        // Enterprise Request
        EmailSequence::create([
            'order' => 1,
            'delay' => \Carbon\CarbonInterval::day(),
            'email_journey_id' => $enterpriseJourney->id,
            'email_template_id' => $neulyJourneyTemplate->id
        ]);

        // Partner Request
        EmailSequence::create([
            'order' => 1,
            'delay' => \Carbon\CarbonInterval::day(),
            'email_journey_id' => $partnerJourney->id,
            'email_template_id' => $neulyJourneyTemplate->id
        ]);

        // Care Request
        EmailSequence::create([
            'order' => 1,
            'delay' => \Carbon\CarbonInterval::day(),
            'email_journey_id' => $careJourney->id,
            'email_template_id' => $neulyJourneyTemplate->id
        ]);

        // EDU Request
        EmailSequence::create([
            'order' => 1,
            'delay' => \Carbon\CarbonInterval::day(),
            'email_journey_id' => $eduJourney->id,
            'email_template_id' => $neulyJourneyTemplate->id
        ]);

        /**
         * Triggers
         */
        EmailTrigger::create([
            'name' => 'Registration',
            'description' => 'Sends welcome email and starts First Impression journey',
            'trigger' => EmailTrigger::TRIGGER_USER_ONBOARDING_DETAILS,
            'status' => EmailTrigger::STATUS_ACTIVE,
            'auto_response_id' => $welcomeIntroTemplate->id,
            'email_journey_id' => $firstImpressionJourney->id
        ]);

        EmailTrigger::create([
            'name' => 'Research Request',
            'description' => 'Sends research request auto-response and starts Enterprise journey',
            'trigger' => EmailTrigger::TRIGGER_RESEARCH_REQUEST,
            'status' => EmailTrigger::STATUS_ACTIVE,
            'auto_response_id' => $researchRequestTemplate->id,
            'email_journey_id' => $enterpriseJourney->id
        ]);

        EmailTrigger::create([
            'name' => 'New Listing Request',
            'description' => 'Sends listing request auto-response',
            'trigger' => EmailTrigger::TRIGGER_NEW_LISTING_REQUEST,
            'status' => EmailTrigger::STATUS_ACTIVE,
            'auto_response_id' => $listingRequestTemplate->id,
        ]);

        EmailTrigger::create([
            'name' => 'API Request',
            'description' => 'Sends API request auto-response and starts Partner journey',
            'trigger' => EmailTrigger::TRIGGER_API_REQUEST,
            'status' => EmailTrigger::STATUS_ACTIVE,
            'auto_response_id' => $apiRequestTemplate->id,
            'email_journey_id' => $partnerJourney->id
        ]);

        EmailTrigger::create([
            'name' => 'Enterprise Request',
            'description' => 'Sends enterprise request auto-response and starts Partner journey',
            'trigger' => EmailTrigger::TRIGGER_ENTERPRISE_REQUEST,
            'status' => EmailTrigger::STATUS_ACTIVE,
            'auto_response_id' => $enterpriseRequestTemplate->id,
            'email_journey_id' => $enterpriseJourney->id
        ]);

        EmailTrigger::create([
            'name' => 'Recruiting Trials Request',
            'description' => 'Sends recruiting trials request auto-response and starts Care journey',
            'trigger' => EmailTrigger::TRIGGER_RECRUITING_CLINICAL_TRIALS_REQUEST,
            'status' => EmailTrigger::STATUS_ACTIVE,
            'auto_response_id' => $recruitingTrialsTemplate->id,
            'email_journey_id' => $careJourney->id
        ]);

        EmailTrigger::create([
            'name' => 'Care Request',
            'description' => 'Sends care request auto-response and starts Care journey',
            'trigger' => EmailTrigger::TRIGGER_CARE_REQUEST,
            'status' => EmailTrigger::STATUS_ACTIVE,
            'auto_response_id' => $neulyCareRequestTemplate->id,
            'email_journey_id' => $careJourney->id
        ]);

        EmailTrigger::create([
            'name' => 'EDU Request',
            'description' => 'Sends care request auto-response and starts Care journey',
            'trigger' => EmailTrigger::TRIGGER_EDU_REQUEST,
            'status' => EmailTrigger::STATUS_ACTIVE,
            'auto_response_id' => $neulyEduRequestTemplate->id,
            'email_journey_id' => $eduJourney->id
        ]);
    }

    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        EmailTemplate::truncate();
        EmailJourney::truncate();
        EmailSequence::truncate();
        EmailTrigger::truncate();
        Email::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
};
