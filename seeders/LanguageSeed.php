<?php 

namespace Seeder;

use Kernel\Seeder\Seeder;

class LanguageSeed extends Seeder 
{
    public function run() 
    {
        $languages = [
            ['name' => 'Afrikaans',   'code' => 'af'],
            ['name' => 'Arabic',      'code' => 'ar'],
            ['name' => 'Belarusian',  'code' => 'be'],
            ['name' => 'Bulgarian',   'code' => 'bg'],
            ['name' => 'Bengali',     'code' => 'bn'],
            ['name' => 'Bosnian',     'code' => 'bs'],
            ['name' => 'Catalan',     'code' => 'ca'],
            ['name' => 'Czech',       'code' => 'cs'],
            ['name' => 'Welsh',       'code' => 'cy'],
            ['name' => 'Danish',      'code' => 'da'],
            ['name' => 'German',      'code' => 'de'],
            ['name' => 'Greek',       'code' => 'el'],
            ['name' => 'English',     'code' => 'en'],
            ['name' => 'Spanish',     'code' => 'es'],
            ['name' => 'Estonian',    'code' => 'et'],
            ['name' => 'Basque',      'code' => 'eu'],
            ['name' => 'Persian',     'code' => 'fa'],
            ['name' => 'Finnish',     'code' => 'fi'],
            ['name' => 'French',      'code' => 'fr'],
            ['name' => 'Irish',       'code' => 'ga'],
            ['name' => 'Galician',    'code' => 'gl'],
            ['name' => 'Gujarati',    'code' => 'gu'],
            ['name' => 'Hebrew',      'code' => 'he'],
            ['name' => 'Hindi',       'code' => 'hi'],
            ['name' => 'Croatian',    'code' => 'hr'],
            ['name' => 'Hungarian',   'code' => 'hu'],
            ['name' => 'Armenian',    'code' => 'hy'],
            ['name' => 'Indonesian',  'code' => 'id'],
            ['name' => 'Icelandic',   'code' => 'is'],
            ['name' => 'Italian',     'code' => 'it'],
            ['name' => 'Japanese',    'code' => 'ja'],
            ['name' => 'Georgian',    'code' => 'ka'],
            ['name' => 'Kazakh',      'code' => 'kk'],
            ['name' => 'Khmer',       'code' => 'km'],
            ['name' => 'Kannada',     'code' => 'kn'],
            ['name' => 'Korean',      'code' => 'ko'],
            ['name' => 'Kyrgyz',      'code' => 'ky'],
            ['name' => 'Lao',         'code' => 'lo'],
            ['name' => 'Lithuanian',  'code' => 'lt'],
            ['name' => 'Latvian',     'code' => 'lv'],
            ['name' => 'Macedonian',  'code' => 'mk'],
            ['name' => 'Malayalam',   'code' => 'ml'],
            ['name' => 'Mongolian',   'code' => 'mn'],
            ['name' => 'Marathi',     'code' => 'mr'],
            ['name' => 'Malay',       'code' => 'ms'],
            ['name' => 'Burmese',     'code' => 'my'],
            ['name' => 'Nepali',      'code' => 'ne'],
            ['name' => 'Dutch',       'code' => 'nl'],
            ['name' => 'Norwegian',   'code' => 'no'],
            ['name' => 'Punjabi',     'code' => 'pa'],
            ['name' => 'Polish',      'code' => 'pl'],
            ['name' => 'Portuguese',  'code' => 'pt'],
            ['name' => 'Romanian',    'code' => 'ro'],
            ['name' => 'Russian',     'code' => 'ru'],
            ['name' => 'Sinhala',     'code' => 'si'],
            ['name' => 'Slovak',      'code' => 'sk'],
            ['name' => 'Slovenian',   'code' => 'sl'],
            ['name' => 'Albanian',    'code' => 'sq'],
            ['name' => 'Serbian',     'code' => 'sr'],
            ['name' => 'Swedish',     'code' => 'sv'],
            ['name' => 'Tamil',       'code' => 'ta'],
            ['name' => 'Telugu',      'code' => 'te'],
            ['name' => 'Thai',        'code' => 'th'],
            ['name' => 'Turkish',     'code' => 'tr'],
            ['name' => 'Ukrainian',   'code' => 'uk'],
            ['name' => 'Urdu',        'code' => 'ur'],
            ['name' => 'Uzbek',       'code' => 'uz'],
            ['name' => 'Vietnamese',  'code' => 'vi'],
            ['name' => 'Chinese',     'code' => 'zh'],
        ];

        foreach ($languages as  $language) {
            $this->model('Language')->create($language);
        }

    }
}
