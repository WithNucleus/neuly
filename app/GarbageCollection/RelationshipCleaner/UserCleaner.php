<?php

namespace App\GarbageCollection\RelationshipCleaner;

use App\User;
use Illuminate\Support\Facades\DB;

class UserCleaner
{
    private $users = null;

    public function __construct()
    {
        $this->users = User::all()->pluck('id');
    }

    public function cleanUserRelation()
    {
        $messages = [];

        $messages[] = $this->cleanJobApplicationRelation();
        $messages[] = $this->cleanSocialAuthRelation();
        $messages[] = $this->cleanEmailNotificationRelation();
        $messages[] = $this->cleanNotificationRelation();
        $messages[] = $this->cleanEmailResetRelation();
        $messages[] = $this->cleanPasswordResetRelation();
        $messages[] = $this->cleanFollowableRelation();
        $messages[] = $this->cleanFollowListRelation();
        $messages[] = $this->cleanMemberNoteRelation();

        return $messages;
    }

    public function cleanJobApplicationRelation()
    {
        $orphened = DB::table('job_applications')
            ->select('id')
            ->whereNotIn('user_id', $this->users)
            ->get()->pluck('id');

        DB::table('job_applications')->whereIn('id', $orphened)->delete();

        return 'Cleaned '.$orphened->count().' orphened Relationships between Users and Job Applications.';
    }

    public function cleanSocialAuthRelation()
    {
        $orphened = DB::table('user_social_auth')
            ->select('id')
            ->whereNotIn('user_id', $this->users)
            ->get()->pluck('id');

        DB::table('user_social_auth')->whereIn('id', $orphened)->delete();

        return 'Cleaned '.$orphened->count().' orphened Relationships between Users and Social Auths.';
    }

    public function cleanEmailNotificationRelation()
    {
        $orphened = DB::table('email_notifications')
            ->select('id')
            ->whereNotIn('user_id', $this->users)
            ->get()->pluck('id');

        DB::table('email_notifications')->whereIn('id', $orphened)->delete();

        return 'Cleaned '.$orphened->count().' orphened Relationships between Users and Email Notifications.';
    }

    public function cleanNotificationRelation()
    {
        $orphened = DB::table('notifications')
            ->select('id')
            ->whereNotIn('user_id', $this->users)
            ->get()->pluck('id');

        DB::table('notifications')->whereIn('id', $orphened)->delete();

        return 'Cleaned '.$orphened->count().' orphened Relationships between Users and Follow Lists.';
    }

    public function cleanEmailResetRelation()
    {
        $orphened = DB::table('email_resets')
            ->select('id')
            ->whereNotIn('user_id', $this->users)
            ->get()->pluck('id');

        DB::table('email_resets')->whereIn('id', $orphened)->delete();

        return 'Cleaned '.$orphened->count().' orphened Relationships between Users and Email Resets.';
    }

    public function cleanPasswordResetRelation()
    {
        $user_emails = User::all()->pluck('email');
        $orphened = DB::table('password_resets')
            ->select('email')
            ->whereNotIn('email', $user_emails)
            ->get()->pluck('email');

        DB::table('password_resets')->whereIn('email', $orphened)->delete();

        return 'Cleaned '.$orphened->count().' orphened Relationships between Users and Password Resets.';
    }

    public function cleanFollowableRelation()
    {
        $orphened = DB::table('followables')
            ->select('id')
            ->whereNotIn('user_id', $this->users)
            ->get()->pluck('id');

        DB::table('followables')->whereIn('id', $orphened)->delete();

        return 'Cleaned '.$orphened->count().' orphened Relationships between Users and Followables.';
    }

    public function cleanFollowListRelation()
    {
        $orphened = DB::table('follow_lists')
            ->select('id')
            ->whereNotIn('user_id', $this->users)
            ->get()->pluck('id');

        DB::table('follow_lists')->whereIn('id', $orphened)->delete();

        return 'Cleaned '.$orphened->count().' orphened Relationships between Users and Follow Lists.';
    }

    public function cleanMemberNoteRelation()
    {
        $orphened = DB::table('member_notes')
            ->select('id')
            ->whereNotIn('user_id', $this->users)
            ->get()->pluck('id');

        DB::table('member_notes')->whereIn('id', $orphened)->delete();

        return 'Cleaned '.$orphened->count().' orphened Relationships between Users and Member Notes.';
    }
}
