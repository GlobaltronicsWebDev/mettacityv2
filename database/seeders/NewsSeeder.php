<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;

class NewsSeeder extends Seeder
{
    public function run(): void
    {
        // Clear existing news
        News::truncate();

        $newsItems = [
            [
                'title' => 'Celebrate Chinese New Year at METTACITY!',
                'excerpt' => "Discover a universe of fun, adventure, and immersive experiences! \r\nTo welcome the Year of the Horse, METTACITY invites you to explore the Philippines' first digital amusement universe at an exclusive introductory price—50% OFF on all amusement rates!",
                'image' => 'news/IzxgfltnemMbjjSOcOvq8xNLhNwoebIHoMhI8NcZ.png',
                'facebook_link' => 'https://www.facebook.com/reel/1567783247673515',
                'published_date' => '2026-02-15',
                'is_active' => true,
            ],
            [
                'title' => 'Mettacity in Makati: Everything you need to know about the newest immersive attraction in town',
                'excerpt' => 'The Mettacity has officially arrived at Glorietta 4, unveiling a world where technology meets imagination in the heart of Makati.',
                'image' => 'news/WAAVLmZs85RvJa8shwEPprRrEuog0YnZS4KhMHTo.jpg',
                'facebook_link' => 'https://www.gmanetwork.com/news/lifestyle/hobbiesandactivities/976543/mettacity-in-makati-everything-you-need-to-know-about-the-newest-immersive-attraction-in-t/story/?fbclid=IwY2xjawP_m2JleHRuA2FlbQIxMQBzcnRjBmFwcF9pZBAyMjIwMzkxNzg4MjAwODkyAAEeoLbLLAW_6gkBTuRG_nTxd2hvOyE9rGwHiVhSBwKz7DBlc_9CueLpliGppOA_aem_hbyyYEbUfdVQLjSkP4lSjQ',
                'published_date' => '2026-02-15',
                'is_active' => true,
            ],
            [
                'title' => 'Celebrate Love in every corner of MettaCity ❤️',
                'excerpt' => "Capture your sweetest moments this Valentine's Day with our 2 Interactive Photobooths — designed to create customized prints you can take home as a special keepsake!\r\nWhether it's a couple selfie, a barkada groupie, or a fun family shot, make every smile unforgettable and turn your memories into something you can hold forever. 📸✨",
                'image' => 'news/KfKfpzGrDEoFfU7ViPas54dbgGoWNaXIddMpTSBa.png',
                'facebook_link' => 'https://www.facebook.com/photo?fbid=122112747795209501&set=pcb.122112749319209501',
                'published_date' => '2026-02-13',
                'is_active' => true,
            ],
            [
                'title' => 'Visit METTACITY now with your beloved ones and capture unforgettable memories! 📸',
                'excerpt' => 'Take a selfie or groupie at our stunning Rose Tunnel🌹 and vibrant Yellow Wheat Garden 🌾 — the perfect spots for beautiful photos and special moments together.',
                'image' => 'news/Knco52KqjnlksvN2iAQUH0OhJuGVJ1XNamz3o37F.png',
                'facebook_link' => 'https://www.facebook.com/photo?fbid=122112735561209501&set=pcb.122112735783209501',
                'published_date' => '2026-02-13',
                'is_active' => true,
            ],
            [
                'title' => 'Glorietta has recently launched METTACITY',
                'excerpt' => "An entertainment hub that has repurposed former cinema boxes into high-tech playgrounds\r\n#MBTechNew",
                'image' => 'news/nf4yhU6pGRr3Hvyr3liaxNy5LCMaVRVXgU5W61DH.png',
                'facebook_link' => 'https://www.facebook.com/photo?fbid=1427733736031843&set=a.711623520976205',
                'published_date' => '2026-02-15',
                'is_active' => true,
            ],
        ];

        foreach ($newsItems as $item) {
            News::create($item);
        }

        echo "News seeded successfully!\n";
        echo "Created " . count($newsItems) . " news items.\n";
    }
}
