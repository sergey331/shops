<?php
namespace Seeder;
use Kernel\Seeder\Seeder;
class PumlisherSeed extends Seeder
{
    public function run()
    {
        $publishers = [
            [
                'name' => 'Antares Publishing',
                'slug' => 'antares-publishing',
                'website' => 'https://antares.am',
                'email' => 'info@antares.am',
                'phone' => '+374 10 530530',
                'address' => '12 Tigran Mets Ave, Yerevan, Armenia',
                'bio' => 'One of Armenia’s largest publishing groups, known for fiction, translation, and educational books.',
            ],
            [
                'name' => 'Zangak Publishing House',
                'slug' => 'zangak-publishing-house',
                'website' => 'https://zangak.am',
                'email' => 'info@zangak.am',
                'phone' => '+374 10 240240',
                'address' => '13/1 Paronyan St, Yerevan, Armenia',
                'bio' => 'The leading educational publisher in Armenia; also prints fiction and children’s literature.',
            ],
            [
                'name' => 'Edit Print',
                'slug' => 'edit-print',
                'website' => 'https://editprint.am',
                'email' => 'contact@editprint.am',
                'phone' => '+374 10 565656',
                'address' => '5 Movses Khorenatsi St, Yerevan, Armenia',
                'bio' => 'Publishes academic, cultural, and fiction works; known for high-quality design and printing.',
            ],
            [
                'name' => 'Apaga Publishing',
                'slug' => 'apaga-publishing',
                'website' => 'https://apaga.am',
                'email' => 'info@apaga.am',
                'phone' => '+374 10 222555',
                'address' => '4 Amiryan St, Yerevan, Armenia',
                'bio' => 'Focuses on Armenian history, culture, and art publications.',
            ],
            [
                'name' => 'Nairi Publishing House',
                'slug' => 'nairi-publishing-house',
                'website' => 'https://nairi.am',
                'email' => 'info@nairi.am',
                'phone' => '+374 10 586858',
                'address' => '27 Baghramyan Ave, Yerevan, Armenia',
                'bio' => 'Publishes Armenian classics and translations; one of the oldest active Armenian publishers.',
            ],
            [
                'name' => 'Newmag Publishing',
                'slug' => 'newmag-publishing',
                'website' => 'https://newmag.am',
                'email' => 'info@newmag.am',
                'phone' => '+374 10 333030',
                'address' => '2 Aram St, Yerevan, Armenia',
                'bio' => 'Modern media and publishing company; publishes contemporary authors and translated works.',
            ],
            [
                'name' => 'Arevik Publishing House',
                'slug' => 'arevik-publishing-house',
                'website' => 'https://arevik.am',
                'email' => 'info@arevik.am',
                'phone' => '+374 10 272727',
                'address' => '15 Koryun St, Yerevan, Armenia',
                'bio' => 'Children’s and youth literature publisher, founded in the Soviet era and still active.',
            ],
            [
                'name' => 'Lusabats Publishing',
                'slug' => 'lusabats-publishing',
                'website' => 'https://lusabats.am',
                'email' => 'contact@lusabats.am',
                'phone' => '+374 10 505050',
                'address' => '40 Mashtots Ave, Yerevan, Armenia',
                'bio' => 'Publishes educational, religious, and philosophical literature.',
            ],
            [
                'name' => 'Vem Publishing',
                'slug' => 'vem-publishing',
                'website' => 'https://vem.am',
                'email' => 'info@vem.am',
                'phone' => '+374 10 222223',
                'address' => '6 Abovyan St, Yerevan, Armenia',
                'bio' => 'Publishes theological, cultural, and historical literature; associated with Vem Radio.',
            ],
            [
                'name' => 'Gitutyun Publishing House',
                'slug' => 'gitutyun-publishing-house',
                'website' => 'https://nas.am/gitutyun',
                'email' => 'info@gitutyun.am',
                'phone' => '+374 10 527777',
                'address' => '24 Baghramyan Ave, Yerevan, Armenia',
                'bio' => 'Academic publisher under the National Academy of Sciences of Armenia.',
            ],
        ];


        foreach ($publishers as $publisher) {
            $this->model('Publisher')->create($publisher);
        }
    }
}