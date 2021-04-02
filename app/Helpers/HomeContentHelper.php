<?php


namespace App\Helpers;


use Illuminate\Support\Facades\DB;

class HomeContentHelper
{
    protected $view_ids;

    public function __construct($view_ids){
        $this->view_ids = $view_ids;
    }

    public function getRecentContent(): array
    {
        $recents = DB::select('select p.user_id, v.name, p.page_url, TIMESTAMPDIFF(SECOND , max(p.created_at), now()) seconds
                        from page_visit_logs p
                        left join views v on v.id = reverse(left(REVERSE(page_url), locate(\'/\', REVERSE(page_url)) -1))
                        where user_id =' . auth()->id() . ' and page_url REGEXP \'/dashboard/[0-9]/[0-9]/[0-9]\'
                        and reverse(left(REVERSE(page_url), locate(\'/\', REVERSE(page_url)) -1)) in (' . implode(',', $this->view_ids) . ')
                        group by user_id, page_url, v.name
                        order by max(p.created_at) desc
                        limit 4');

        return $this->classifyDateDiff($recents);
    }

    public function classifyDateDiff($recents){
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

    public function getRecommendationContent(): array
    {
        return [
            'dashboard1' => [
                'name' => 'MyGov',
                'hour' => '4 hours ago'
            ],
            'dashboard2' => [
                'name' => 'Asan Finance lorem ipsum doler sit amet',
                'hour' => '2 hours ago'
            ],
            'dashboard3' => [
                'name' => 'EGov',
                'hour' => '3 hours ago'
            ],
            'dashboard4' => [
                'name' => 'AsanPay',
                'hour' => '1 hour ago'
            ],
        ];
    }
}
