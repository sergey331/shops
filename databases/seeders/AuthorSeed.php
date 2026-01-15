<?php
namespace Seeder;
use Kernel\Seeder\Seeder;
class AuthorSeed extends Seeder
{
    public function run()
    {
        $authors = [
            [
                'name' => 'Hovhannes Tumanyan',
                'slug' => 'hovhannes-tumanyan',
                'bio' => 'Hovhannes Tumanyan (1869–1923) is the national poet of Armenia, known for his fables, epics, and deeply human stories such as “Anush” and “The Dog and the Cat.”'
            ],
            [
                'name' => 'Avetik Isahakyan',
                'slug' => 'avetik-isahakyan',
                'bio' => 'Avetik Isahakyan (1875–1957) was a lyrical poet and writer whose works explore love, longing, and the Armenian national spirit.'
            ],
            [
                'name' => 'Yeghishe Charents',
                'slug' => 'yeghishe-charents',
                'bio' => 'Yeghishe Charents (1897–1937) was a revolutionary modernist poet and one of Armenia’s greatest literary figures, known for his daring themes and tragic fate under Stalinist repression.'
            ],
            [
                'name' => 'Paruyr Sevak',
                'slug' => 'paruyr-sevak',
                'bio' => 'Paruyr Sevak (1924–1971) was a poet and scholar whose works combined patriotism, philosophy, and deep emotional expression; author of “The Unsilenceable Belfry.”'
            ],
            [
                'name' => 'Hamo Sahyan',
                'slug' => 'hamo-sahyan',
                'bio' => 'Hamo Sahyan (1914–1993) was a beloved Armenian poet whose verses celebrate nature, the homeland, and the beauty of simple life.'
            ],
            [
                'name' => 'Silva Kaputikyan',
                'slug' => 'silva-kaputikyan',
                'bio' => 'Silva Kaputikyan (1919–2006) was a poet, essayist, and public figure known for her lyrical works on identity, freedom, and womanhood.'
            ],
            [
                'name' => 'Derenik Demirchyan',
                'slug' => 'derenik-demirchyan',
                'bio' => 'Derenik Demirchyan (1877–1956) was a novelist, playwright, and translator, best known for his historical novel “Vardanank.”'
            ],
            [
                'name' => 'Ghazaros Aghayan',
                'slug' => 'ghazaros-aghayan',
                'bio' => 'Ghazaros Aghayan (1840–1911) was a teacher, writer, and children’s author, one of the pioneers of Armenian educational literature.'
            ],
            [
                'name' => 'Aksel Bakunts',
                'slug' => 'aksel-bakunts',
                'bio' => 'Aksel Bakunts (1899–1937) was a short story writer and satirist from Zangezur, whose works captured rural Armenian life with humor and tragedy.'
            ],
            [
                'name' => 'Nar-Dos',
                'slug' => 'nar-dos',
                'bio' => 'Nar-Dos (1867–1933) was a novelist and realist writer, known for “The Girl from Ararat Valley” and his psychological depth.'
            ],
            [
                'name' => 'Levon Shant',
                'slug' => 'levon-shant',
                'bio' => 'Levon Shant (1869–1951) was a playwright, novelist, and educator, one of the founders of modern Armenian theater and literature.'
            ],
            [
                'name' => 'Vahan Teryan',
                'slug' => 'vahan-teryan',
                'bio' => 'Vahan Teryan (1885–1920) was a leading symbolist poet, often called the “poet of autumn” for his melancholic and introspective poetry.'
            ],
            [
                'name' => 'Gurgen Mahari',
                'slug' => 'gurgen-mahari',
                'bio' => 'Gurgen Mahari (1903–1969) was a novelist and memoirist, survivor of Stalinist repression, and author of “The Burning Orchards.”'
            ],
            [
                'name' => 'Misak Metsarents',
                'slug' => 'misak-metsarents',
                'bio' => 'Misak Metsarents (1886–1908) was a romantic poet whose short life produced deeply emotional and lyrical works.'
            ],
            [
                'name' => 'Hovhannes Shiraz',
                'slug' => 'hovhannes-shiraz',
                'bio' => 'Hovhannes Shiraz (1915–1984) was a passionate poet of love, patriotism, and national sorrow, famous for “Mother’s Hands.”'
            ],
            [
                'name' => 'Zabel Yesayan',
                'slug' => 'zabel-yesayan',
                'bio' => 'Zabel Yesayan (1878–1943) was a writer, feminist, and human rights advocate, one of the first prominent female authors in Armenian literature.'
            ],
            [
                'name' => 'Razmik Davoyan',
                'slug' => 'razmik-davoyan',
                'bio' => 'Razmik Davoyan (born 1940) is a contemporary poet exploring spiritual, existential, and national themes in modern Armenian literature.'
            ],
            [
                'name' => 'Gurgen Boryan',
                'slug' => 'gurgen-boryan',
                'bio' => 'Gurgen Boryan (1915–1971) was a Soviet Armenian poet and playwright known for his dramatic works and patriotic themes.'
            ],
            [
                'name' => 'Vahagn Davtyan',
                'slug' => 'vahagn-davtyan',
                'bio' => 'Vahagn Davtyan (1922–1996) was a poet, translator, and cultural leader who combined lyricism with philosophical reflection.'
            ],
            [
                'name' => 'Aghasi Ayvazyan',
                'slug' => 'aghasi-ayvazyan',
                'bio' => 'Aghasi Ayvazyan (1928–2006) was a screenwriter, novelist, and essayist known for his cinematic storytelling and social themes.'
            ]
        ];

        foreach ($authors as $author) {
            $this->model('Author')->create([
                'name' => $author['name'],
                'slug' => $author['slug'],
                'bio' => $author['bio'],
            ]);
        }
    }
}