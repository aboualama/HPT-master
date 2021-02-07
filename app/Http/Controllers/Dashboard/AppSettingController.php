<?php
/**
 * File name: AppSettingController.php
 * Last modified: 2020.05.27 at 18:36:54
 * Author: SmarterVision - https://codecanyon.net/user/smartervision
 * Copyright (c) 2020
 */

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
// use App\Repositories\CurrencyRepository;
// use App\Repositories\RoleRepository;
// use App\Repositories\UploadRepository;
// use App\Repositories\UserRepository;
use Flash;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use RachidLaasri\LaravelInstaller\Helpers\MigrationsHelper;
use Themsaid\Langman\Manager;

class AppSettingController extends Controller
{
    // use MigrationsHelper;

    private $langManager;

    public function __construct()
    {
        // parent::__construct();
        $this->langManager = new Manager(new Filesystem(), config('langman.path'), []);
    }


    public function syncTranslation(Request $request)
    {
        if (!env('APP_DEMO', false)) {
            Artisan::call('langman:sync');
        } else {
            Flash::warning('This is only demo app you can\'t change this section ');
        }
        return redirect()->back();
    }



    public function translate(Request $request)
    {
        //translate only lang.php file

        $currentLang = $request->current_lang;
        // dd($currentLang);
        if (!env('APP_DEMO', false)) {
            $inputs = $request->except(['_method', '_token', 'current_lang']);

            if (!$inputs && !count($inputs)) {
                Flash::error('Translate not loaded');
                return redirect()->back();
            }

            $langFiles = $this->langManager->files();
            $langFiles = array_filter($langFiles, function ($v, $k) {
                return $k == 'lang';
            }, ARRAY_FILTER_USE_BOTH);

            if (!$langFiles && !count($langFiles)) {
                Flash::error('Translate not loaded');
                return redirect()->back();
            }
            foreach ($langFiles as $filename => $items) {

                $path = $items[$currentLang];
                $needed = [];
                foreach ($inputs as $key => $input) {
                    if (Str::startsWith($key, $filename)) {
                        $langKeyWithoutFile = explode('|', $key, 2)[1];
                        $needed = array_merge_recursive($needed, getNeededArray('|', $langKeyWithoutFile, $input));
                    }
                }
                ksort($needed);
                $this->langManager->writeFile($path, $needed);
            }
        } else {
            Flash::warning('This is only demo app you can\'t change this section ');
        }

        return redirect()->back();
    }

    public function index()
    {

        $langFiles = [];
        $languages = $this->getAvailableLanguages();
        $mobileLanguages = $this->getLanguages();

        $langFiles = $this->langManager->files();
        return view('settings.translation.index', compact(['languages', 'langFiles']));

     }


     function getAvailableLanguages()
     {
         $dir = base_path('resources/lang');
         $languages = array_diff(scandir($dir), array('..', '.'));
         $languages = array_map(function ($value) {
             return ['id' => $value, 'value' => trans('lang.app_setting_' . $value)];
         }, $languages);

         return array_column($languages, 'value', 'id');
     }

     function getLanguages()
     {
         return array(
             'aa' => 'Afar',
             'ab' => 'Abkhaz',
             'ae' => 'Avestan',
             'af' => 'Afrikaans',
             'ak' => 'Akan',
             'am' => 'Amharic',
             'an' => 'Aragonese',
             'ar' => 'Arabic',
             'as' => 'Assamese',
             'av' => 'Avaric',
             'ay' => 'Aymara',
             'az' => 'Azerbaijani',
             'ba' => 'Bashkir',
             'be' => 'Belarusian',
             'bg' => 'Bulgarian',
             'bh' => 'Bihari',
             'bi' => 'Bislama',
             'bm' => 'Bambara',
             'bn' => 'Bengali',
             'bo' => 'Tibetan Standard, Tibetan, Central',
             'br' => 'Breton',
             'bs' => 'Bosnian',
             'ca' => 'Catalan; Valencian',
             'ce' => 'Chechen',
             'ch' => 'Chamorro',
             'co' => 'Corsican',
             'cr' => 'Cree',
             'cs' => 'Czech',
             'cu' => 'Old Church Slavonic, Church Slavic, Church Slavonic, Old Bulgarian, Old Slavonic',
             'cv' => 'Chuvash',
             'cy' => 'Welsh',
             'da' => 'Danish',
             'de' => 'German',
             'dv' => 'Divehi; Dhivehi; Maldivian;',
             'dz' => 'Dzongkha',
             'ee' => 'Ewe',
             'el' => 'Greek, Modern',
             'en' => 'English',
             'eo' => 'Esperanto',
             'es' => 'Spanish; Castilian',
             'et' => 'Estonian',
             'eu' => 'Basque',
             'fa' => 'Persian',
             'ff' => 'Fula; Fulah; Pulaar; Pular',
             'fi' => 'Finnish',
             'fj' => 'Fijian',
             'fo' => 'Faroese',
             'fr' => 'French',
             'fy' => 'Western Frisian',
             'ga' => 'Irish',
             'gd' => 'Scottish Gaelic; Gaelic',
             'gl' => 'Galician',
             'gn' => 'GuaranÃƒÂ­',
             'gu' => 'Gujarati',
             'gv' => 'Manx',
             'ha' => 'Hausa',
             'he' => 'Hebrew (modern)',
             'hi' => 'Hindi',
             'ho' => 'Hiri Motu',
             'hr' => 'Croatian',
             'ht' => 'Haitian; Haitian Creole',
             'hu' => 'Hungarian',
             'hy' => 'Armenian',
             'hz' => 'Herero',
             'ia' => 'Interlingua',
             'id' => 'Indonesian',
             'ie' => 'Interlingue',
             'ig' => 'Igbo',
             'ii' => 'Nuosu',
             'ik' => 'Inupiaq',
             'io' => 'Ido',
             'is' => 'Icelandic',
             'it' => 'Italian',
             'iu' => 'Inuktitut',
             'ja' => 'Japanese (ja)',
             'jv' => 'Javanese (jv)',
             'ka' => 'Georgian',
             'kg' => 'Kongo',
             'ki' => 'Kikuyu, Gikuyu',
             'kj' => 'Kwanyama, Kuanyama',
             'kk' => 'Kazakh',
             'kl' => 'Kalaallisut, Greenlandic',
             'km' => 'Khmer',
             'kn' => 'Kannada',
             'ko' => 'Korean',
             'kr' => 'Kanuri',
             'ks' => 'Kashmiri',
             'ku' => 'Kurdish',
             'kv' => 'Komi',
             'kw' => 'Cornish',
             'ky' => 'Kirghiz, Kyrgyz',
             'la' => 'Latin',
             'lb' => 'Luxembourgish, Letzeburgesch',
             'lg' => 'Luganda',
             'li' => 'Limburgish, Limburgan, Limburger',
             'ln' => 'Lingala',
             'lo' => 'Lao',
             'lt' => 'Lithuanian',
             'lu' => 'Luba-Katanga',
             'lv' => 'Latvian',
             'mg' => 'Malagasy',
             'mh' => 'Marshallese',
             'mi' => 'Maori',
             'mk' => 'Macedonian',
             'ml' => 'Malayalam',
             'mn' => 'Mongolian',
             'mr' => 'Marathi (Mara?hi)',
             'ms' => 'Malay',
             'mt' => 'Maltese',
             'my' => 'Burmese',
             'na' => 'Nauru',
             'nb' => 'Norwegian BokmÃƒÂ¥l',
             'nd' => 'North Ndebele',
             'ne' => 'Nepali',
             'ng' => 'Ndonga',
             'nl' => 'Dutch',
             'nn' => 'Norwegian Nynorsk',
             'no' => 'Norwegian',
             'nr' => 'South Ndebele',
             'nv' => 'Navajo, Navaho',
             'ny' => 'Chichewa; Chewa; Nyanja',
             'oc' => 'Occitan',
             'oj' => 'Ojibwe, Ojibwa',
             'om' => 'Oromo',
             'or' => 'Oriya',
             'os' => 'Ossetian, Ossetic',
             'pa' => 'Panjabi, Punjabi',
             'pi' => 'Pali',
             'pl' => 'Polish',
             'ps' => 'Pashto, Pushto',
             'pt' => 'Portuguese',
             'qu' => 'Quechua',
             'rm' => 'Romansh',
             'rn' => 'Kirundi',
             'ro' => 'Romanian, Moldavian, Moldovan',
             'ru' => 'Russian',
             'rw' => 'Kinyarwanda',
             'sa' => 'Sanskrit (Sa?sk?ta)',
             'sc' => 'Sardinian',
             'sd' => 'Sindhi',
             'se' => 'Northern Sami',
             'sg' => 'Sango',
             'si' => 'Sinhala, Sinhalese',
             'sk' => 'Slovak',
             'sl' => 'Slovene',
             'sm' => 'Samoan',
             'sn' => 'Shona',
             'so' => 'Somali',
             'sq' => 'Albanian',
             'sr' => 'Serbian',
             'ss' => 'Swati',
             'st' => 'Southern Sotho',
             'su' => 'Sundanese',
             'sv' => 'Swedish',
             'sw' => 'Swahili',
             'ta' => 'Tamil',
             'te' => 'Telugu',
             'tg' => 'Tajik',
             'th' => 'Thai',
             'ti' => 'Tigrinya',
             'tk' => 'Turkmen',
             'tl' => 'Tagalog',
             'tn' => 'Tswana',
             'to' => 'Tonga (Tonga Islands)',
             'tr' => 'Turkish',
             'ts' => 'Tsonga',
             'tt' => 'Tatar',
             'tw' => 'Twi',
             'ty' => 'Tahitian',
             'ug' => 'Uighur, Uyghur',
             'uk' => 'Ukrainian',
             'ur' => 'Urdu',
             'uz' => 'Uzbek',
             've' => 'Venda',
             'vi' => 'Vietnamese',
             'vo' => 'VolapÃƒÂ¼k',
             'wa' => 'Walloon',
             'wo' => 'Wolof',
             'xh' => 'Xhosa',
             'yi' => 'Yiddish',
             'yo' => 'Yoruba',
             'za' => 'Zhuang, Chuang',
             'zh' => 'Chinese',
             'zu' => 'Zulu',
         );

     }




















}

