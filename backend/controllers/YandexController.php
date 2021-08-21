<?php
/**
 * Created by PhpStorm.
 * User: WyTcorp
 * Date: 31.03.2020
 * Time: 14:03
 * Email: wild.savedo@gmail.com
 * Site : http://lockit.com.ua/
 */

namespace backend\controllers;

use Yii;
use GuzzleHttp\Client; // подключаем Guzzle
use yii\helpers\Url;

class YandexController extends AppAdminController
{

    public function actionYandex() {

        // создаем экземпляр класса
        $client = new Client();
        // отправляем запрос к странице Яндекса
        $res = $client->request('GET', 'http://www.yandex.ru');
        // получаем данные между открывающим и закрывающим тегами body
        $body = $res->getBody();
        // вывод страницы Яндекса в представление
        return $this->render('yandex', ['body' => $body]);
    }

    public function actionYandexNews() {

        // создаем экземпляр класса
        $client = new Client();
        // отправляем запрос к странице Яндекса
        $res = $client->request('GET', 'http://www.yandex.ru');
        // получаем данные между открывающим и закрывающим тегами body
        $body = $res->getBody();
        // подключаем phpQuery
        $document = \phpQuery::newDocumentHTML($body);
        //Смотрим html страницы Яндекса, определяем внешний класс списка и считываем его командой find
        $news = $document->find(".b-news-list");
        // вывод списка новостей Яндекса с главной страницы в представление
        return $this->render('yandex-news', ['news' => $news]);
    }
    public function actionYandexNewslist() {

        // создаем экземпляр класса
        $client = new Client();
        // отправляем запрос к странице Яндекса
        $res = $client->request('GET', 'http://www.yandex.ru');
        // получаем данные между открывающим и закрывающим тегами body
        $body = $res->getBody();
        // подключаем phpQuery
        $document = \phpQuery::newDocumentHTML($body);
        // получаем список новостей
        $news = $document->find("ul.b-news-list");
        // выполняем проход циклом по списку
        foreach ($news as $elem) {
            //pq аналог $ в jQuery
            $pq = pq($elem);
            // удалим первую новость в списке
            $pq->find('li.b-news-list__item:first')->remove();
            // выполним поиск в скиске ссылок
            $tags = $pq->find('li.b-news-list__item a');
            // добавим ковычки в начало и в конец предложения
            $tags->append('" ')->prepend(' "'); //
            // добавим свой класс к последней новости списка
            $pq->find('li.b-news-list__item:last')->addClass('my_last_class');
        }
        // вывод списка новостей яндекса с главной страницы в представление
        return $this->render('yandex-news-list', ['news' => $news]);
    }
}
