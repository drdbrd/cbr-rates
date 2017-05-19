<?php

/**
 * Запрос курса валют ЦБР
 *
 * @param null|string $date дата в формате 'dd/mm/yyyy'
 * @return array
 *
 * @author Dmitrii Redbird
 */
function cbr_rates($date = null)
{
    $data = [];
    $url = 'http://www.cbr.ru/scripts/XML_daily.asp';
    if ($date !== null) {
        $url .= '?date_req=' . $date;
    }
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch);
    $info = curl_getinfo($ch);
    $error = curl_error($ch);
    curl_close($ch);
    if (!$error && $info['http_code'] === 200) {
        $rates = new \SimpleXMLElement($result);
        foreach ($rates->Valute as $rate) {
            $data[(string)$rate->CharCode] = floatval(str_replace(',', '.', $rate->Value));
        }
    }
    return $data;
}