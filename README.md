Функция запрашивает курс валют с сайта ЦБР.

Пример:

    $rates = cbr_rates();
    
Пример с указанием даты:

    $rates = cbr_rates('01/01/2010'); // курс валют на 1 января 2010