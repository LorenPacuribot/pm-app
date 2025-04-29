<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class VersesSeeder extends Seeder
{
    public function run(): void
    {
        $verses = [
            [
                'name' => 'I can do all things through him who strengthens me. — Philippians 4:13 (ESV)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'For we walk by faith, not by sight. — 2 Corinthians 5:7 (ESV)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'The Lord is my shepherd; I shall not want. — Psalm 23:1 (ESV)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Be still, and know that I am God. — Psalm 46:10 (ESV)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Trust in the Lord with all your heart, and do not lean on your own understanding. — Proverbs 3:5 (ESV)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Let all that you do be done in love. — 1 Corinthians 16:14 (ESV)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'God is our refuge and strength, a very present help in trouble. — Psalm 46:1 (ESV)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Cast all your anxieties on him, because he cares for you. — 1 Peter 5:7 (ESV)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'With man this is impossible, but with God all things are possible. — Matthew 19:26 (ESV)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'I have loved you with an everlasting love. — Jeremiah 31:3 (ESV)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'The Lord will fight for you, and you have only to be silent. — Exodus 14:14 (ESV)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Commit your work to the Lord, and your plans will be established. — Proverbs 16:3 (ESV)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'For I know the plans I have for you, declares the Lord. — Jeremiah 29:11 (ESV)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'My grace is sufficient for you, for my power is made perfect in weakness. — 2 Corinthians 12:9 (ESV)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'In the beginning, God created the heavens and the earth. — Genesis 1:1 (ESV)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'The steadfast love of the Lord never ceases. — Lamentations 3:22 (ESV)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'The Lord is near to the brokenhearted and saves the crushed in spirit. — Psalm 34:18 (ESV)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Rejoice in hope, be patient in tribulation, be constant in prayer. — Romans 12:12 (ESV)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'You are the light of the world. A city set on a hill cannot be hidden. — Matthew 5:14 (ESV)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'And we know that for those who love God all things work together for good. — Romans 8:28 (ESV)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Blessed are the peacemakers, for they shall be called sons of God. — Matthew 5:9 (ESV)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'The fear of the Lord is the beginning of wisdom. — Proverbs 9:10 (ESV)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Your word is a lamp to my feet and a light to my path. — Psalm 119:105 (ESV)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'If God is for us, who can be against us? — Romans 8:31 (ESV)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Create in me a clean heart, O God, and renew a right spirit within me. — Psalm 51:10 (ESV)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Do not be overcome by evil, but overcome evil with good. — Romans 12:21 (ESV)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'The name of the Lord is a strong tower; the righteous man runs into it and is safe. — Proverbs 18:10 (ESV)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Let everything that has breath praise the Lord! — Psalm 150:6 (ESV)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Blessed is the man who remains steadfast under trial. — James 1:12 (ESV)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Draw near to God, and he will draw near to you. — James 4:8 (ESV)',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];

        DB::table('verses')->insert($verses);
    }
}
