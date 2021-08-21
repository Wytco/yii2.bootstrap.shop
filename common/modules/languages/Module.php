<?php
namespace common\modules\languages;

use common\modules\languages\models\LanguageKsl;
use yii\base\BootstrapInterface;


class Module extends \yii\base\Module implements BootstrapInterface
{

    public $controllerNamespace = 'common\modules\languages\controllers';

    public $languages; //Языки используемые в приложении

    public $default_language; //основной язык (по-умолчанию)

    public $show_default; //показывать в URL основной язык


    /*
     * Предзагрузка - выполнится до обработки входящего запроса.
     * Устанавливает язык приложения в зависимости от метки языка в URL,
     * а при ее отсутствии устанавливает в качестве метки текущий язык
     */
    public function bootstrap($app)
    {
        if(YII_ENV == 'test') return; //для тестового приложения отключаем.

        $url = $app->request->url;

        //Получаем список языков в виде строки
        $list_languages = LanguageKsl::list_languages();

        preg_match("#^/($list_languages)(.*)#", $url, $match_arr);

        //Если URL содержит указатель языка - сохраняем его в параметрах приложения и используем
        if (isset($match_arr[1]) && $match_arr[1] != '/' && $match_arr[1] != ''){

            /*
             * Если в настройках выбрано не показывать язык используемый по-умолчанию
             * убираем метку текущего языка из URL и перенаправляем на ту же страницу
             */
            if( !$this->show_default && $match_arr[1] == $this->default_language) {
                $url = $app->request->absoluteUrl; //Возвращает абсолютную ссылку
                $lang = $this->default_language; //язык используемый по-умолчанию
                $app->response->redirect(['languages/default/index', 'lang' => $lang, 'url' => $url]);
            }

            $app->language = $match_arr[1];
            $app->formatter->locale = $match_arr[1];
            $app->homeUrl = '/'.$match_arr[1];

            /*
             * Если URL не содержит указатель языка и отключен показ основного языка в URL
             */
        } elseif(!$this->show_default){

            $lang = $this->default_language; //язык используемый по-умолчанию

            $app->language = $lang;
            $app->formatter->locale = $lang;

            /*
             * Если URL не содержит указатель языка, а в настройках включен показ основного языка
             */
        } else {
            $url = $app->request->absoluteUrl; //Возвращает абсолютную ссылку

            $lang = $this->default_language;

            $app->response->redirect(['languages/default/index', 'lang' => $lang, 'url' => $url], 301);
        }
    }

}