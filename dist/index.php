<?
function getXLS($xls){
include_once 'ajax/Classes/PHPExcel/IOFactory.php';
$objPHPExcel = PHPExcel_IOFactory::load($xls);
$objPHPExcel->setActiveSheetIndex(0);
$aSheet = $objPHPExcel->getActiveSheet();
//этот массив будет содержать массивы содержащие в себе значения ячеек каждой строки
$array = array();
//получим итератор строки и пройдемся по нему циклом
foreach($aSheet->getRowIterator() as $row){
//получим итератор ячеек текущей строки
$cellIterator = $row->getCellIterator();
//пройдемся циклом по ячейкам строки
//этот массив будет содержать значения каждой отдельной строки
$item = array();
foreach($cellIterator as $cell){
//заносим значения ячеек одной строки в отдельный массив
array_push($item, iconv('utf-8', 'utf-8', $cell->getCalculatedValue()));
}
//заносим массив со значениями ячеек отдельной строки в «общий массв строк»
array_push($array, $item);
}
return $array;
}
$xlsData = getXLS('ajax/multi.xls'); //извлеаем данные из XLS
$din_title = 'CRM для холодных звонков';
$p = $_GET['titleValue'];
if(!empty($p)){
for ($i=0; $i <=10 ; $i++) { 
$xlsData_colls = $xlsData[$i];
if($p == $xlsData_colls[0]){
$din_title = $xlsData_colls[1];
}
}
}
?>
    <!DOCTYPE html>
    <html lang=ru>

    <head>
        <meta charset=UTF-8>
        <meta name=viewport content="width=1200">
        <title>CRM для холодных звонков и готовая клиентская база</title>
        <link type=image/x-icon href=img/favicon.png rel="shortcut icon">
        <meta name=description content="CRM для холодных звонков и готовая клиентская база позволяет получать до 50 новых заявок ежемесячно">
        <meta name=keywords content="CRM для телемаркетинга, CRM для холодных звонков, CRM для Call-центра, организация телемаркетинга, исходящий телемаркетинг, CRM для холодных звонков, CRM для звонков, звонки через CRM, отдел телемаркетинга, программа для холодных звонков, софт для холодных звонков, клиентская база, базы клиентов, clientbase">
        <meta content="CRM для холодных звонков и готовая клиентская база" property=og:title>
        <meta content=website property=og:type>
        <meta content=img/favicon.png property=og:image>
        <meta content="CRM для холодных звонков и готовая клиентская база позволяет получать до 50 новых заявок ежемесячно. Протестируйте беспалтно в течение 14 дней! CRM настроена специально для Холодных звонков и позволяет увеличить их количество до +80%. Также мы предоставляем готовые клиентские базы по 88 городам России" property=og:description>
        <style>
            <?php include('css/head.min.css');
            ?>
        </style>
        <script>
            ! function(e, t, a) {
                function n() {
                    for (; o[0] && "loaded" == o[0][f];) r = o.shift(), r[d] = !c.parentNode.insertBefore(r, c)
                }
                for (var s, i, r, o = [], c = e.scripts[0], d = "onreadystatechange", f = "readyState"; s = a.shift();) i = e.createElement(t), "async" in c ? (i.async = !1, e.head.appendChild(i)) : c[f] ? (o.push(i), i[d] = n) : e.write("<" + t + ' src="' + s + '" defer></' + t + ">"), i.src = s
            }(document, "script", ["https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js", "js/init.min.js"])
        </script>
    </head>

    <body>
        <?php include('track/head.php'); ?>
            <?php include('track/body.php'); ?>
                <header>
                    <div class=wrap>
                        <a class=logo href=#><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACwAAAAAAQABAAACAkQBADs=" data-original=img/logo.png alt height=21 width=97></a>
                        <h1> <? echo $din_title; ?> </h1>
                        <h2>Получите до <span>50 новых заявок</span> на свои товары и услуги<br>в ближайшие <span>14 дней</span>. Старт всего через <span>6 часов</span>.</h2>
                        <div class=divider1></div>
                        <div class=head_gr>
                            <div class=pl_gr><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACwAAAAAAQABAAACAkQBADs=" data-original=img/more-calls.png alt height=60 width=60>
                                <h4>На 80% больше звонков</h4>
                                <p>С помощью настроенной CRM</p>
                            </div><img class=plus src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACwAAAAAAQABAAACAkQBADs=" data-original=img/plus.png alt height=32 width=32>
                            <div class=pl_gr><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACwAAAAAAQABAAACAkQBADs=" data-original=img/clients-base.png alt height=60 width=60>
                                <h4>Готовая база клиентов</h4>
                                <p>Больше 1 000 000 предприятий РФ</p>
                            </div>
                        </div><a class=btn_head href=#>ЗАКАЗАТЬ ПРОБНУЮ ВЕРСИЮ</a></div>
                    <div class=pop id=pop1>
                        <h2>Оставьте заявку<br>на пробную версию</h2>
                        <form enctype="multipart/form-data" action=ajax/mail.php method=post>
                            <input name=frmid type=hidden value="Форма заявки на первой странице">
                            <input name=event type=hidden value=FORM1>
                            <input name=okgo type=hidden value=pop1t>
                            <input class=name id=name_f1 name=name type=text autocomplete=off placeholder="Как вас зовут?">
                            <label class=note for=name_f1>Пожалуйста, заполните поле</label>
                            <input class=phone id=phone_f1 name=phone type=text autocomplete=off placeholder="Ваш номер телефона">
                            <label class=note for=phone_f1>(перезвоним, если потребуется что-то уточнить)</label>
                            <input class=email id=email_f1 name=email type=text autocomplete=off placeholder="Ваш email">
                            <label class=note for=email_f1>(пришлем информацию для начала работы)</label>
                            <button class=disabled type=submit value="ОТПРАВИТЬ ЗАЯВКУ">ОТПРАВИТЬ ЗАЯВКУ</button>
                        </form>
                    </div>
                    <div class=pop id=pop2><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACwAAAAAAQABAAACAkQBADs=" data-original=img/form-sent-darkb.png alt height=50 width=61>
                        <h2>Спасибо за вашу заявку!</h2>
                        <p>Мы свяжемся с вами в ближайшие несколько минут</p>
                    </div>
                </header>
                <section class=sec2>
                    <div class=wrap>
                        <h2>Результат уже через 6 часов</h2>
                        <p class=note>Всю работу мы берем на себя</p>
                        <div class=line>
                            <div class=rez>
                                <h4>1. Оставляете заявку</h4>
                                <p>Наш сотрудник уточняет,
                                    <br>какие города вас интересуют,
                                    <br>и запрашивает материалы
                                    <br>для первой email-рассылки</p>
                            </div>
                            <div class=rez><span>15 мин</span>
                                <h4>2. Мы готовим<br>пробную версию CRM,</h4>
                                <p>загружаем в нее списки
                                    <br>потенциальных клиентов по
                                    <br>городам и настраиваем рассылку</p>
                            </div>
                            <div class=rez><span>2ч 15мин</span>
                                <h4>3. Запускаем email-рассылку</h4>
                                <p>После старта составляем график
                                    <br>прозвона потенциальных клиентов</p>
                            </div>
                            <div class=rez><span>3ч 15мин</span>
                                <h4>4. Предоставляем<br>обучающие материалы</h4>
                                <p>Если необходимо, проводим
                                    <br>удаленное обучение по Skype</p>
                            </div>
                            <div class=rez><span>5ч 15мин</span>
                                <h4>5. Ваши менеджеры<br>начали прозвон и собирают<br>первые заявки</h4></div>
                            <div class=rez><span>5ч 45мин</span>
                                <h4>6. Первые результаты</h4>
                                <p>Больше звонков, новые клиенты</p>
                            </div>
                        </div>
                        <div class=divider2></div>
                        <div class=sec2_btn><a class=btn_pr href=#>ЗАКАЗАТЬ ПРОБНУЮ ВЕРСИЮ</a>
                            <p>Или получите бесплатно список
                                <br>из 100 потенциальных клиентов</p><a class=btn_sp href=#>Получить список клиентов</a></div>
                    </div>
                </section>
                <section class=sec3>
                    <div class=wrap>
                        <h2>Компании, для которых наша CRM<br>будет максимально полезной</h2>
                        <div class=sec3_h4gr>
                            <h4><span>Двое и больше</span><br>менеджеров<br>по холодным звонкам</h4>
                            <h4>Холодные звонки —<br><span>основной источник</span><br>новых клиентов</h4>
                            <h4>Цикл сделки:<br><span>до 1 месяца</span></h4></div>
                        <div class=divider3></div>
                        <div class=container>
                            <div class=item><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACwAAAAAAQABAAACAkQBADs=" data-original=img/services.png alt height=48 width=48>
                                <p>Активные продажи товаров
                                    <br>и услуг для населения</p><span>Есть пример внедрения</span>
                                <p>Продажа услуг страхования</p><span>Есть пример внедрения</span>
                                <p>Частные адвокаты
                                    <br>и адвокатские конторы</p><span>Есть пример внедрения</span>
                                <p>Продажа инвестиционных услуг</p><span>Есть пример внедрения</span>
                                <p>Продажа услуг бухгалтерского, юридического
                                    <br>и ИТ-обслуживания</p>
                                <p class=t4>Оценочная деятельность</p><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACwAAAAAAQABAAACAkQBADs=" data-original=img/beauty.png alt height=48 width=48>
                                <p>Продажа товаров
                                    <br>для косметических салонов</p><span>Есть пример внедрения</span></div>
                            <div class=item><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACwAAAAAAQABAAACAkQBADs=" data-original=img/it.png alt height=48 width=48>
                                <p>Рекламные агентства</p><span>Есть пример внедрения</span>
                                <p>Веб-студии</p>
                                <p class=t4>Продажа программного обеспечения</p><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACwAAAAAAQABAAACAkQBADs=" data-original=img/delivery.png alt height=48 width=48>
                                <p>Доставка воды</p><span>Есть пример внедрения</span>
                                <p>Клининг</p><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACwAAAAAAQABAAACAkQBADs=" data-original=img/gear.png alt height=48 width=48>
                                <p>Поставка комплектующих</p>
                                <p class=t4>Оптовые продажи сырья</p>
                                <p class=t4>Оптовые продажи химии</p>
                                <p class=t4>Аренда спецтехники</p>
                                <p class=t4>Автосервис
                                    <br>коммерческого транспорта</p>
                            </div>
                            <div class=item><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACwAAAAAAQABAAACAkQBADs=" data-original=img/corporate.png alt height=48 width=48>
                                <p>Организация мероприятий</p>
                                <p class=t4>Продажа услуг
                                    <br>по корпоративному обучению</p><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACwAAAAAAQABAAACAkQBADs=" data-original=img/building.png alt height=48 width=48>
                                <p>Производство и оптовые
                                    <br>продажи стройматериалов</p>
                                <p class=t4>Изготовление мебели на заказ</p><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACwAAAAAAQABAAACAkQBADs=" data-original=img/electronics.png alt height=48 width=48>
                                <p>Продажи
                                    <br>промышленного оборудования</p><span>Есть пример внедрения</span>
                                <p>Продажа светового
                                    <br>и звукового оборудования</p><span>Есть пример внедрения</span>
                                <p>Монтаж систем безопасности</p>
                            </div>
                        </div><span class=btn_sec3>ЗАКАЗАТЬ ПРОБНУЮ ВЕРСИЮ CRM</span></div>
                </section>
                <section class=sec4>
                    <div class=wrap>
                        <h3>За счет чего CRM для холодных звонков позволяет увеличить<br>эффективность прозвона до 80%?</h3>
                        <div class=container>
                            <div class=item><span>1</span>
                                <h4>Готовые кнопки<br>для быстрой отметки<br>результата звонка</h4>
                                <p>Менеджеры по холодным
                                    <br>звонкам знают, что до 2/3 всех звонков — это различные
                                    <br>перезвоны:
                                    <br>- «вышел на 15 минут»;
                                    <br>- «приболел, будет завтра»;
                                    <br>- «уже уехал, звоните завтра»;
                                    <br>- «в командировке, звоните
                                    <br>через неделю»;
                                    <br>- и т.д. и т.п.</p>
                                <div class=divider4></div>
                                <p class=p_bold>Более 60% всех звонков
                                    <br>обрабатываются в 1 клик</p><img data-click-event=BUTTONS_FALSE_CLICK src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACwAAAAAAQABAAACAkQBADs=" data-original=img/screenshot2.png alt height=243 width=224></div>
                            <div class=item><span>2</span>
                                <h4>CRM сама формирует<br>очередность прозвона</h4>
                                <p>Ни один среднестатистический
                                    <br>менеджер по холодным
                                    <br>звонкам не помнит, когда
                                    <br>и кому нужно перезвонить,
                                    <br>особенно когда у него более 50
                                    <br>звонков в день.
                                    <br>
                                    <br>Большинство CRM позволяют
                                    <br>ставить напоминания
                                    <br>на нужное время. Но как быть,
                                    <br>когда у вас 20 или больше
                                    <br>напоминаний?</p>
                                <div class=divider4></div>
                                <p class=p_bold>Мы создали систему, которая
                                    <br>сама открывает карточки
                                    <br>звонков в нужном порядке
                                    <br>в нужное время</p><img data-click-event=CODE_FALSE_CLICK src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACwAAAAAAQABAAACAkQBADs=" data-original=img/screenshot1.png alt height=290 width=267></div>
                            <div class=item><span>3</span>
                                <h4>Ведение истории всех<br>предыдущих звонков<br>в одном окне</h4>
                                <p>Мы замечали, что примерно
                                    <br>3 из 4 менеджеров перед
                                    <br>каждым звонком
                                    <br>просматривают историю
                                    <br>предыдущей работы с этим
                                    <br>клиентом. На это уходит время,
                                    <br>но без истории не обойтись.</p>
                                <div class=divider4></div>
                                <p class=p_bold>В нашей CRM вся история
                                    <br>работы с клиентом собрана
                                    <br>в едином окне — менеджер
                                    <br>тратит минимальное время
                                    <br>на ее изучение</p><img data-click-event=HISTORY_FALSE_CLICK src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACwAAAAAAQABAAACAkQBADs=" data-original=img/screenshot3.png alt height=94 width=320></div>
                        </div>
                    </div>
                </section>
                <section class=sec5>
                    <div class=wrap>
                        <h2>CRM для холодных звонков в цифрах</h2>
                        <div class=cif_gr>
                            <div class=cif>
                                <div class=cif_img><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACwAAAAAAQABAAACAkQBADs=" data-original=img/launch.png alt height=48 width=48></div>
                                <div class=cif_t>
                                    <h4>80</h4>
                                    <p>запусков
                                        <br>ежемесячно</p>
                                </div>
                            </div>
                            <div class=cif>
                                <div class=cif_img><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACwAAAAAAQABAAACAkQBADs=" data-original=img/clients.png alt height=48 width=48></div>
                                <div class=cif_t>
                                    <h4>300 000</h4>
                                    <p>потенциальных клиентов
                                        <br>в разработке прямо сейчас</p>
                                </div>
                            </div>
                            <div class=cif>
                                <div class=cif_img><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACwAAAAAAQABAAACAkQBADs=" data-original=img/parameters.png alt height=48 width=48></div>
                                <div class=cif_t>
                                    <h4>16</h4>
                                    <p>показателей отчетности
                                        <br>в режиме реального времени</p>
                                </div>
                            </div>
                            <div class=cif>
                                <div class=cif_img><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACwAAAAAAQABAAACAkQBADs=" data-original=img/hours.png alt height=48 width=48></div>
                                <div class=cif_t>
                                    <h4>200</h4>
                                    <p>часов телефонного трафика
                                        <br>ежедневно</p>
                                </div>
                            </div>
                            <div class=cif>
                                <div class=cif_img><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACwAAAAAAQABAAACAkQBADs=" data-original=img/calls.png alt height=48 width=48></div>
                                <div class=cif_t>
                                    <h4>15 000</h4>
                                    <p>звонков ежедневно</p>
                                </div>
                            </div>
                        </div>
                        <p class=on_btn>Мы берем в работу <span>не более 10 запусков в неделю</span></p><a class=btn_sec5 href=#>ПОПРОБОВАТЬ БЕСПЛАТНО</a></div>
                </section>
                <section class=sec6>
                    <div class=wrap>
                        <h2>Наши цены</h2>
                        <div class=cen_gr>
                            <div class=kol><span class=note>Количество<br>сотрудников</span>
                                <p>7</p>
                                <p>12</p>
                                <p>25</p>
                                <p>безлимит</p>
                            </div>
                            <div class=card>
                                <div class=divider6></div>
                                <div class=divider6></div>
                                <div class=divider6></div>
                                <h4>В облаке<br><span class=note>(ежемесячно)</span></h4>
                                <div class=divider5></div>
                                <div class=f50><span class=note>За 1 сотрудника</span>
                                    <p>536₽</p>
                                    <p>458₽</p>
                                    <p>410₽</p>
                                    <p>308₽</p>
                                </div>
                                <div class=f50><span class=note>Итого</span>
                                    <p>3 750₽</p>
                                    <p>5 500₽</p>
                                    <p>10 250₽</p>
                                    <p>15 375₽</p>
                                </div>
                            </div>
                            <div class=card>
                                <div class=divider6></div>
                                <div class=divider6></div>
                                <div class=divider6></div>
                                <h4>На своем сервере<br><span class=note>(единоразово)</span></h4>
                                <div class=divider5></div>
                                <div class=f50><span class=note>За 1 сотрудника</span>
                                    <p>7 713₽</p>
                                    <p>4 999₽</p>
                                    <p>3 120₽</p>
                                    <p>2 040₽</p>
                                </div>
                                <div class=f50><span class=note>Итого</span>
                                    <p>53 990₽</p>
                                    <p>59 990₽</p>
                                    <p>77 990₽</p>
                                    <p>101 990₽</p>
                                </div>
                            </div>
                            <div class=card_w>
                                <h4>Советуем начать<br>с пробной версии</h4>
                                <p>Полная функциональность</p>
                                <p>Работает 14 дней</p>
                            </div>
                        </div>
                    </div>
                </section>
                <section class=sec7>
                    <div class=form-tail></div>
                    <div class=wrap>
                        <h2>Протестируйте систему<br>перед приобретением</h2>
                        <form enctype="multipart/form-data" action=ajax/mail.php method=post><a class="tabl active" data-event=FORM5_FREE href=#><span>Бесплатная версия</span> </a><a class=tabr data-event=FORM5_FULL href=#><span>Полная версия</span> </a>
                            <input name=frmid type=hidden value="Форма заявки заявки на 6 экране (Наши цены)">
                            <input name=event type=hidden value=FORM5_FREE>
                            <input name=okgo type=hidden value=pop2t>
                            <input name=package type=hidden value="Бесплатная версия">
                            <input class=name id=name_f2 name=name type=text autocomplete=off placeholder="Как вас зовут?">
                            <label class=note for=name_f2>Пожалуйста, заполните поле</label>
                            <input class=phone id=phone_f2 name=phone type=text autocomplete=off placeholder="Ваш номер телефона">
                            <label class=note for=phone_f2>(перезвоним, если потребуется что-то уточнить)</label>
                            <input class=email id=email_f2 name=email type=text autocomplete=off placeholder="Ваш email">
                            <label class=note for=email_f2>(на него мы пришлем список)</label>
                            <div class=file_gr>
                                <input name=fileinput placeholder="Файл с вашими реквизитами">
                                <input class=true_file_inp id=file_inp1 name=file type=file>
                                <label class=file for=file_inp1>Выбрать файл</label>
                            </div>
                            <button class=disabled type=submit value="ОТПРАВИТЬ ЗАЯВКУ">ОТПРАВИТЬ ЗАЯВКУ</button>
                        </form>
                    </div>
                    <div class=example-tail>
                        <p>Пример внедрения нашей CRM
                            <br>↓</p>
                    </div>
                </section>
                <section class=sec8>
                    <div class=wrap>
                        <h2>Пример индивидуального внедрения CRM для холодных звонков</h2>
                        <div class=sec8_hgr>
                            <div class=h_gr>
                                <h3>Компания:</h3>
                                <h4>Представительство<br>TeleTrade (Москва)</h4></div>
                            <div class=h_gr>
                                <h3>Штат:</h3>
                                <h4>150 менеджеров<br>по холодным звонкам</h4></div>
                            <div class=h_gr>
                                <h3>Срок запуска:</h3>
                                <h4>1,5 месяца</h4></div>
                        </div>
                        <div class=divider7></div>
                        <div class=vipo_r>
                            <h3>Выполненные работы</h3>
                            <h4>Настройка рабочего места менеджера по холодным звонкам</h4>
                            <br>
                            <h4>Интеграция с 8 сайтами</h4>
                            <br>
                            <h4>Настройка 3 дополнительных отчетов</h4>
                            <br>
                            <h4>Интеграция CRM + Asterisk</h4></div>
                        <div class=divider7></div>
                        <div class=prim_gr>
                            <div class=prim1><img class=pr_im1 data-click-event=ORDER_FALSE_CLICK src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACwAAAAAAQABAAACAkQBADs=" data-original=img/example-integration.png alt height=600 width=284>
                                <div class=prim_t>
                                    <h4>1. Интеграция с сайтами клиента</h4>
                                    <p>По каждой заявке мы знаем:
                                        <br>- адрес сайта, на котором ее оставили;
                                        <br>- название лид-формы, через которую оставили заявку;
                                        <br>- предыдущий сайт, на котором находился клиент;
                                        <br>- источник рекламы;
                                        <br>- тип и бренд устройства, с которого была оставлена заявка;
                                        <br>- браузер;
                                        <br>- страна, регион и город клиента;
                                        <br>- оператор связи и тип подключения;
                                        <br>- еще 9 переменных, необходимых для отдела маркетинга.</p>
                                    <div class=prim_r>
                                        <p>Все заявки сразу попадают в CRM и автоматически
                                            <br>распределяются между менеджерами по очереди.
                                            <br>Для подключения менеджера к списку на раздачу заявок
                                            <br>достаточно 1 клика.</p><img width=361 height=96 data-click-event=QUEUE_FALSE_CLICK src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACwAAAAAAQABAAACAkQBADs=" data-original=img/example-labels.png alt></div>
                                    <div class=prim_r>
                                        <p>При назначении менеджеру новой заявки CRM сразу
                                            <br>информирует его об этом. Через 15 минут, если менеджер
                                            <br>еще не позвонил по заявке, CRM уведомляет его руководителя.</p><img data-click-event=REMIND_FALSE_CLICK src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACwAAAAAAQABAAACAkQBADs=" data-original=img/example-remainder.png alt height=91 width=301></div>
                                    <div class=prim_r>
                                        <p>Кроме того, CRM считает время от получения заявки
                                            <br>до начала работы с ней.</p><img data-click-event=TIMING_FALSE_CLICK src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACwAAAAAAQABAAACAkQBADs=" data-original=img/example-request.png alt height=173 width=451></div>
                                </div>
                            </div>
                            <div class=prim2>
                                <div class=prim_t>
                                    <h4>2. Рабочее место менеджера<br>по холодным звонкам</h4>
                                    <p>Так выглядит рабочее место менеджера.
                                        <br>
                                        <br>Рядом с номером телефона отображается
                                        <br>иконка звонка, по нажатию на которую CRM
                                        <br>совершает исходящий звонок клиенту.</p>
                                    <div class=divider8></div>
                                    <p>Справа расположены те же кнопки, что и
                                        <br>в стандартной версии CRM, и добавлены
                                        <br>2 новых кнопки:
                                        <br>- «Абонент не отвечает»;
                                        <br>- «Абонент недоступен».
                                        <br>
                                        <br>В эти кнопки мы заложили специальный
                                        <br>алгоритм, который повышает вероятность
                                        <br>дозвона до клиента с учетом предыдущей
                                        <br>истории звонков ему. Алгоритм пробует различные комбинации времени суток
                                        <br>и интервала между звонками
                                        <br>для повышения вероятности дозвона
                                        <br>до клиента.</p>
                                </div>
                                <div class=pr_im2 data-click-event=WORKPLACE_FALSE_CLICK><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACwAAAAAAQABAAACAkQBADs=" data-original=img/example-zvonok2.png alt height=425 width=496></div>
                            </div>
                        </div>
                        <div class=prim3>
                            <div class=prim_t>
                                <h4>3. Отслеживание выполнения планов продаж</h4>
                                <p>Клиент ежемесячно выставляет планы продаж
                                    <br>по 5 показателям и в любой момент может остследить
                                    <br>их выполнение (в табличном и графическом виде).</p>
                            </div>
                            <div class=pr_im3><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACwAAAAAAQABAAACAkQBADs=" data-original=img/plan-graph.png alt height=60 width=61></div>
                        </div>
                        <div class=divider7></div>
                        <div class=form_gr>
                            <div class=form_t>
                                <h4>Интересуют подробности?<br>Закажите индивидуальную<br>консультацию специалиста →</h4>
                                <p>Индивидуальные консультации
                                    <br>по проекту мы предоставляем
                                    <br>компаниям с количеством
                                    <br>менеджеров по холодным звонкам
                                    <br>от 20 сотрудников</p>
                            </div>
                            <form enctype="multipart/form-data" action=ajax/mail.php method=post>
                                <input name=frmid type=hidden value="Форма заявки на консультацию на 7 экране (пример внедрения TeleTrade)">
                                <input name=event type=hidden value=TELETRADE_CONSULTATION>
                                <input name=okgo type=hidden value=pop3t>
                                <input class=name id=name_f3 name=name type=text autocomplete=off placeholder="Как вас зовут?">
                                <label class=note for=name_f3>Пожалуйста, заполните поле</label>
                                <input class=phone id=phone_f3 name=phone type=text autocomplete=off placeholder="Ваш номер телефона">
                                <label class=note for=phone_f3>(на него мы пришлем список)</label>
                                <textarea name=text placeholder="Что интересует?"></textarea>
                                <button class=disabled type=submit value="ЗАКАЗАТЬ КОНСУЛЬТАЦИЮ">ЗАКАЗАТЬ КОНСУЛЬТАЦИЮ</button>
                            </form>
                        </div>
                    </div>
                </section>
                <footer>
                    <div class=wrap>
                        <p class=copy>©2016 ООО «Маркетинг и консультирование»</p>
                        <div class=kont>
                            <p class=note>Контактный телефон</p>
                            <h4><a data-click-event=CALLING href=tel:+78312351050>+7 831 235-10-50</a></h4></div>
                        <div class=kont>
                            <p class=note>Контактный email</p>
                            <h4><a data-click-event=EMAILING href=mailto:mail@4calls.ru>mail@4calls.ru</a></h4></div>
                        <div class=divider9></div>
                        <div class=diz>
                            <p class=note>Дизайн сайта:
                                <br><span>Евгений Резник</span></p>
                        </div>
                    </div>
                </footer>
                <div id=hidden-box>
                    <div class=pop2 id=pop3>
                        <a class=close href=#></a>
                        <h4>Получите бесплатно список<br>из 100 потенциальных клиентов</h4>
                        <form enctype="multipart/form-data" action=ajax/mail.php method=post>
                            <input name=frmid type=hidden value="Форма запроса списка клиентов на 2 экране (Запуск за 6 часов)">
                            <input name=event type=hidden value=ACCOUNT_LIST_REQUEST>
                            <input name=okgo type=hidden value=pop3t>
                            <input class=name id=name_f4 name=name type=text autocomplete=off placeholder="Как вас зовут?">
                            <label class=note for=name_f4>Пожалуйста, заполните поле</label>
                            <textarea id=textarea-br name=text placeholder="По какому городу и отрасли подоготовить вам список клиентов?"></textarea>
                            <input class=email id=email_f4 name=email type=text autocomplete=off placeholder="Ваш email">
                            <label class=note for=email_f4>(на него мы пришлем список)</label>
                            <button class=disabled type=submit value="ОТПРАВИТЬ ЗАЯВКУ">ОТПРАВИТЬ ЗАЯВКУ</button>
                        </form>
                    </div>
                    <div class=pop2 id=pop4>
                        <a class=close href=#></a> <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACwAAAAAAQABAAACAkQBADs=" data-original=img/form-sent-darkb.png alt height=50 width=61>
                        <h2>Спасибо за вашу заявку!</h2>
                        <p>Мы свяжемся с вами в ближайшие несколько минут</p>
                    </div>
                    <div class=pop3 id=pop5>
                        <a class=close href=#></a>
                        <h2>Протестируйте систему<br>перед приобретением</h2>
                        <form enctype="multipart/form-data" action=ajax/mail.php method=post><a class="tabl active" data-event=FORM2_6HOURS_FREE href=#><span>Бесплатная версия</span> </a><a class=tabr data-event=FORM2_6HOURS_FULL href=#><span>Полная версия</span> </a>
                            <input name=frmid type=hidden value="Форма заявки на второй странице(Запуск за 6 часов)">
                            <input name=event type=hidden value=FORM2_6HOURS_FREE>
                            <input name=okgo type=hidden value=pop2t>
                            <input name=package type=hidden value="Бесплатная версия">
                            <input class=name id=name_f5 name=name type=text autocomplete=off placeholder="Как вас зовут?">
                            <label class=note for=name_f5>Пожалуйста, заполните поле</label>
                            <input class=phone id=phone_f5 name=phone type=text autocomplete=off placeholder="Ваш номер телефона">
                            <label class=note for=phone_f5>(перезвоним, если потребуется что-то уточнить)</label>
                            <input class=email id=email_f5 name=email type=text autocomplete=off placeholder="Ваш email">
                            <label class=note for=email_f5>(на него мы пришлем список)</label>
                            <div class=file_gr>
                                <input name=fileinput type=text placeholder="Файл с вашими реквизитами">
                                <input class=true_file_inp id=file_inp2 name=file type=file>
                                <label class=file for=file_inp2>Выбрать файл</label>
                            </div>
                            <button class=disabled type=submit value="ОТПРАВИТЬ ЗАЯВКУ">ОТПРАВИТЬ ЗАЯВКУ</button>
                        </form>
                    </div>
                    <div class=pop3 id=pop5_1>
                        <a class=close href=#></a>
                        <h2>Протестируйте систему<br>перед приобретением</h2>
                        <form enctype="multipart/form-data" action=ajax/mail.php method=post><a class="tabl active" data-event=FORM3_EXAMPLES_FREE href=#><span>Бесплатная версия</span> </a><a class=tabr data-event=FORM3_EXAMPLES_FULL href=#><span>Полная версия</span> </a>
                            <input name=frmid type=hidden value="Форма заявки на 3 экране (список рекомендованных отраслей)">
                            <input name=event type=hidden value=FORM3_EXAMPLES_FREE>
                            <input name=okgo type=hidden value=pop2t>
                            <input name=package type=hidden value="Бесплатная версия">
                            <input class=name id=name_f6 name=name type=text autocomplete=off placeholder="Как вас зовут?">
                            <label class=note for=name_f6>Пожалуйста, заполните поле</label>
                            <input class=phone id=phone_f6 name=phone type=text autocomplete=off placeholder="Ваш номер телефона">
                            <label class=note for=phone_f6>(перезвоним, если потребуется что-то уточнить)</label>
                            <input class=email id=email_f6 name=email type=text autocomplete=off placeholder="Ваш email">
                            <label class=note for=email_f6>(на него мы пришлем список)</label>
                            <div class=file_gr>
                                <input name=fileinput type=text placeholder="Файл с вашими реквизитами">
                                <input class=true_file_inp id=file_inp3 name=file type=file>
                                <label class=file for=file_inp3>Выбрать файл</label>
                            </div>
                            <button class=disabled type=submit value="ОТПРАВИТЬ ЗАЯВКУ">ОТПРАВИТЬ ЗАЯВКУ</button>
                        </form>
                    </div>
                    <div class=pop3 id=pop5_2>
                        <a class=close href=#></a>
                        <h2>Протестируйте систему<br>перед приобретением</h2>
                        <form enctype="multipart/form-data" action=ajax/mail.php method=post><a class="tabl active" data-event=FORM4_FACTS_FREE href=#><span>Бесплатная версия</span> </a><a class=tabr data-event=FORM4_FACTS_FULL href=#><span>Полная версия</span> </a>
                            <input name=frmid type=hidden value="Форма заявки на 5 экране (CRM для ХЗ в цифрах)">
                            <input name=event type=hidden value=FORM4_FACTS_FREE>
                            <input name=okgo type=hidden value=pop2t>
                            <input name=package type=hidden value="Бесплатная версия">
                            <input class=name id=name_f7 name=name type=text autocomplete=off placeholder="Как вас зовут?">
                            <label class=note for=name_f7>Пожалуйста, заполните поле</label>
                            <input class=phone id=phone_f7 name=phone type=text autocomplete=off placeholder="Ваш номер телефона">
                            <label class=note for=phone_f7>(перезвоним, если потребуется что-то уточнить)</label>
                            <input class=email id=email_f7 name=email type=text autocomplete=off placeholder="Ваш email">
                            <label class=note for=email_f7>(на него мы пришлем список)</label>
                            <div class=file_gr>
                                <input name=fileinput type=text placeholder="Файл с вашими реквизитами">
                                <input class=true_file_inp id=file_inp4 name=file type=file>
                                <label class=file for=file_inp4>Выбрать файл</label>
                            </div>
                            <button class=disabled type=submit value="ОТПРАВИТЬ ЗАЯВКУ">ОТПРАВИТЬ ЗАЯВКУ</button>
                        </form>
                    </div>
                    <div class=pop3 id=pop6>
                        <a class=close href=#></a> <img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACwAAAAAAQABAAACAkQBADs=" data-original=img/form-sent-light.png alt height=50 width=61>
                        <h2>Спасибо за вашу заявку!</h2>
                        <p>Мы свяжемся с вами в ближайшие несколько минут</p>
                    </div>
                    <div class=vcard>
                        <div><span class=category>Настройка CRM-систем</span> <span class="fn org">ООО «Маркетинг и консультирование»</span></div>
                        <div class=adr><span class=locality>Нижний Новгород</span> <span class=street-address>д.Кузнечиха, д.65А</span></div><span class=tel>+7 (831) 235-10-50</span> <span class=workhours>ежедневно с 08:00 до 20:00</span> <span class=url><span class=value-title title=http://4calls.ru></span></span>
                    </div>
                </div>
    </body>

    </html>