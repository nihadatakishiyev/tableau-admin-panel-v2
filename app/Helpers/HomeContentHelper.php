<?php


namespace App\Helpers;

use Illuminate\Support\Facades\DB;

class HomeContentHelper
{
    protected $view_ids;

    public function __construct($view_ids){
        $this->view_ids = $view_ids;
    }

    /**
     * @param $recents
     * @return mixed
     */
    protected function classifyDateDiff($recents): mixed
    {
        foreach ($recents as $recent){
            if ($recent->seconds < 60){
                $recent->seconds = 'few seconds ago';
            }
            else if ($recent->seconds < 3600){
                $recent->seconds = round($recent->seconds/60) . ngettext(' minute', ' minutes', $recent->seconds/60) . ' ago';
            }
            else if ($recent->seconds < 86400){
                $recent->seconds = round($recent->seconds/3600) . ngettext(' hour', ' hours', $recent->seconds/3600) . ' ago';
            }
            else {
                $recent->seconds = round($recent->seconds/24/3600) . ngettext(' day', ' days', $recent->seconds/24/3600) . ' ago';
            }
        }

        return $recents;
    }

    public function getRecentContent(): array
    {
        $recents = DB::select('select p.user_id, v.name, p.page_url, TIMESTAMPDIFF(SECOND , max(p.created_at), now()) seconds
                        from page_visit_logs p
                        left join views v on v.id = reverse(left(REVERSE(page_url), INSTR(REVERSE(page_url), \'/\') -1))
                        where user_id =' . auth()->id() . ' and page_url REGEXP \'/dashboard/[0-9]/[0-9]/[0-9]\'
                        and reverse(left(REVERSE(page_url), INSTR(REVERSE(page_url), \'/\') -1)) in (' . implode(',', $this->view_ids) . ')
                        group by user_id, page_url, v.name
                        order by max(p.created_at) desc
                        limit 4');

        return $this->classifyDateDiff($recents);
    }

    public function getRecommendationContent(): array
    {
        $recoms = DB::select('select p.user_id, v.name, p.page_url, count(*) times
                        from page_visit_logs p
                        left join views v on v.id = reverse(left(REVERSE(page_url), INSTR(REVERSE(page_url), \'/\') -1))
                        where user_id =' . auth()->id() . ' and page_url REGEXP \'/dashboard/[0-9]/[0-9]/[0-9]\'
                        and reverse(left(REVERSE(page_url), INSTR(REVERSE(page_url), \'/\') -1)) in
                        (' . implode(',', $this->view_ids) . ')
                        group by user_id, page_url, v.name
                        order by count(*) desc
                        limit 4');

//        if (count($recoms) < 4){
//            $random_ids = array_rand($this->view_ids, min(4, count($this->view_ids)));
//        }

        return $recoms;
    }
}
