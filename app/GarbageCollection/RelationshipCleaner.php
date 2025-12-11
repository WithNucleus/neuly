<?php

namespace App\GarbageCollection;

use App\GarbageCollection\RelationshipCleaner\ActivityLogCleaner;
use App\GarbageCollection\RelationshipCleaner\ClinicalTrialCleaner;
use App\GarbageCollection\RelationshipCleaner\CompanyCleaner;
use App\GarbageCollection\RelationshipCleaner\DataSanitizer;
use App\GarbageCollection\RelationshipCleaner\EmailNotificationCleaner;
use App\GarbageCollection\RelationshipCleaner\EventCleaner;
use App\GarbageCollection\RelationshipCleaner\FailedJobsCleaner;
use App\GarbageCollection\RelationshipCleaner\FocusCleaner;
use App\GarbageCollection\RelationshipCleaner\FollowListCleaner;
use App\GarbageCollection\RelationshipCleaner\InvestorCleaner;
use App\GarbageCollection\RelationshipCleaner\JobCleaner;
use App\GarbageCollection\RelationshipCleaner\LocationCleaner;
use App\GarbageCollection\RelationshipCleaner\NotificationCleaner;
use App\GarbageCollection\RelationshipCleaner\OAuthCleaner;
use App\GarbageCollection\RelationshipCleaner\PermissionCleaner;
use App\GarbageCollection\RelationshipCleaner\PersonCleaner;
use App\GarbageCollection\RelationshipCleaner\RedirectCleaner;
use App\GarbageCollection\RelationshipCleaner\RoleCleaner;
use App\GarbageCollection\RelationshipCleaner\SessionCleaner;
use App\GarbageCollection\RelationshipCleaner\UserCleaner;

class RelationshipCleaner
{
    private $trialCleaner = null;

    private $companyCleaner = null;

    private $eventCleaner = null;

    private $focusCleaner = null;

    private $investorCleaner = null;

    private $jobCleaner = null;

    private $locationCleaner = null;

    private $personCleaner = null;

    private $userCleaner = null;

    private $followListCleaner = null;

    private $notificationCleaner = null;

    private $emailNotificationCleaner = null;

    private $roleCleaner = null;

    private $permissionCleaner = null;

    private $redirectCleaner = null;

    private $activityLogCleaner = null;

    private $failedJobsCleaner = null;

    private $oauthCleaner = null;

    private $sessionCleaner = null;

    private $dataSanitizer = null;

    public function __construct()
    {
        $this->trialCleaner = new ClinicalTrialCleaner();
        $this->companyCleaner = new CompanyCleaner();
        $this->eventCleaner = new EventCleaner();
        $this->focusCleaner = new FocusCleaner();
        $this->investorCleaner = new InvestorCleaner();
        $this->jobCleaner = new JobCleaner();
        $this->locationCleaner = new LocationCleaner();
        $this->personCleaner = new PersonCleaner();
        $this->userCleaner = new UserCleaner();
        $this->followListCleaner = new FollowListCleaner();
        $this->notificationCleaner = new NotificationCleaner();
        $this->emailNotificationCleaner = new EmailNotificationCleaner();
        $this->roleCleaner = new RoleCleaner();
        $this->permissionCleaner = new PermissionCleaner();
        $this->redirectCleaner = new RedirectCleaner();
        $this->activityLogCleaner = new ActivityLogCleaner();
        $this->failedJobsCleaner = new FailedJobsCleaner();
        $this->oauthCleaner = new OAuthCleaner();
        $this->sessionCleaner = new SessionCleaner();
        $this->dataSanitizer = new DataSanitizer();
    }

    public function cleanRelations()
    {
        $messages = array_merge(
            $this->trialCleaner->cleanClinicalTrialRelationships(),
            $this->companyCleaner->cleanCompanyRelation(),
            $this->eventCleaner->cleanEventRelation(),
            $this->focusCleaner->cleanFocusRelation(),
            $this->investorCleaner->cleanInvestorRelation(),
            $this->jobCleaner->cleanJobRelation(),
            $this->locationCleaner->cleanLocationRelation(),
            $this->personCleaner->cleanPersonRelation(),
            $this->userCleaner->cleanUserRelation(),
            $this->followListCleaner->cleanFollowListRelation(),
            $this->notificationCleaner->cleanNotificationRelation(),
            $this->emailNotificationCleaner->cleanEmailNotificationRelation(),
            $this->roleCleaner->cleanRoleRelation(),
            $this->permissionCleaner->cleanPermissionRelation(),
            $this->redirectCleaner->cleanRedirectRelation(),
            $this->activityLogCleaner->cleanActivityLogRelation(),
            $this->failedJobsCleaner->cleanFailedJobsRelation(),
            $this->oauthCleaner->cleanOAuthRelation(),
            $this->sessionCleaner->cleanSessionRelation(),
            $this->dataSanitizer->sanitizeDataRelation()
        );

        return $messages;
    }
}
