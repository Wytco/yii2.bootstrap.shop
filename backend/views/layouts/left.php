<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Мое меню', 'options' => ['class' => 'header']],
                    ['label' => 'Главная', 'icon' => 'file-code-o', 'url' => ['/site/index']],
                    [
                        'label' => 'Категории',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Список категорий', 'icon' => 'file-code-o', 'url' => ['/category/index'],],
                            ['label' => 'Создать категорию', 'icon' => 'file-code-o', 'url' => ['/category/create'],],
                        ],
                    ],
                    ['label' => 'Видео', 'icon' => 'file-code-o', 'url' => ['/site/video']],
                    [
                        'label' => 'Заказы',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Список заказов', 'icon' => 'file-code-o', 'url' => ['/order/index'],],
                            ['label' => 'Создать заказ Не работает, работает Обновление', 'icon' => 'file-code-o', 'url' => ['/order/create'],],
                        ],
                    ],
                    [
                        'label' => 'Парсинг',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Парсинг yandex 1', 'icon' => 'file-code-o', 'url' => ['/yandex/yandex'],],
                            ['label' => 'Парсинг yandex 2', 'icon' => 'file-code-o', 'url' => ['/yandex/yandex-news'],],
                            ['label' => 'Парсинг yandex 3', 'icon' => 'file-code-o', 'url' => ['/yandex/yandex-news-list'],],
                        ],
                    ],
                    [
                        'label' => 'Продукты',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Список продуктов', 'icon' => 'file-code-o', 'url' => ['/product/index'],],
                            ['label' => 'Диномический поиск', 'icon' => 'file-code-o', 'url' => ['/product/search-session'],],
                            ['label' => 'Создать продукт', 'icon' => 'file-code-o', 'url' => ['/product/create'],],
                        ],
                    ],
                    ['label' => 'Записи', 'url' => ['/notes/index']],
                    ['label' => 'CSV', 'url' => ['/csv/index']],
                    ['label' => 'Чат', 'url' => ['/chat/index']],
                    ['label' => 'Шкафы', 'url' => ['/cupboard/index']],
                    ['label' => 'Калькуляторы', 'url' => ['/site/calculator']],
//                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Настройки',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Языки', 'icon' => 'file-code-o', 'url' => ['/options/languages'],],
                        ],
                    ],
                    [
                        'label' => 'Опции',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ]
        ) ?>

    </section>

</aside>
