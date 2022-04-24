<?php

namespace App\GarbageCollection\RelationshipCleaner;

use App\Models\Focus;
use App\Models\Investor;
use App\Models\Job;
use App\Models\Research;
use Illuminate\Support\Facades\DB;

class FocusCleaner
{
    private $focus = null;
    private $jobs = null;
    private $articles = null;
    private $researchs = null;

    public function __construct()
    {
        $this->focus = Focus::all()->pluck('id');
        $this->jobs = Job::all()->pluck('id');
        $this->researchs = Research::all()->pluck('id');
    }

    public function cleanFocusRelation()
    {
        $messages = [];

        $messages[] = $this->cleanJobRelation();
        $messages[] = $this->cleanNewsArticleRelation();
        $messages[] = $this->cleanResearchRelation();

        return $messages;
    }

    public function cleanJobRelation()
    {
        $orphened = DB::table('focus_job')
            ->select('focus_id', 'job_id')
            ->whereNotIn('job_id', $this->jobs)
            ->orWhereNotIn('focus_id', $this->focus)
            ->get();

        foreach($orphened as $entry)
        {
            DB::table('focus_job')
                ->where('focus_id','=', $entry->focus_id)
                ->where('job_id','=', $entry->job_id)
                ->delete();
        }

        return "Cleaned ".$orphened->count()." orphened Relationships between Focus and Jobs.";
    }

    public function cleanNewsArticleRelation()
    {
        $orphened = DB::table('focus_news_article')
            ->select('focus_id', 'news_article_id')
            ->whereNotIn('news_article_id', $this->articles)
            ->orWhereNotIn('focus_id', $this->focus)
            ->get();

        foreach($orphened as $entry)
        {
            DB::table('focus_news_article')
                ->where('focus_id','=', $entry->focus_id)
                ->where('news_article_id','=', $entry->news_article_id)
                ->delete();
        }

        return "Cleaned ".$orphened->count()." orphened Relationships between Focus and News Article.";
    }

    public function cleanResearchRelation()
    {
        $orphened = DB::table('focus_research')
            ->select('focus_id', 'research_id')
            ->whereNotIn('research_id', $this->researchs)
            ->orWhereNotIn('focus_id', $this->focus)
            ->get();

        foreach($orphened as $entry)
        {
            DB::table('focus_research')
                ->where('focus_id','=', $entry->focus_id)
                ->where('research_id','=', $entry->research_id)
                ->delete();
        }

        return "Cleaned ".$orphened->count()." orphened Relationships between Focus and Research.";
    }
}
