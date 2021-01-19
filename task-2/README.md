#Задача №2
 
 Имеется строка:
 `https://www.somehost.com/test/index.html?param1=4&param2=3&param3=2&param4=1&param5=3`
 
 Напишите функцию (предпочтительно с использованием механизмов Yii2), которая:
 
 1) удалит параметры со значением “3”;
 2) отсортирует параметры по значению;
 3) добавит параметр url со значением из переданной ссылки без параметров (в примере: /test/index.html);
 4) сформирует и вернёт валидный URL на корень указанного в ссылке хоста.
 
 В указанном примере функцией должно быть возвращено:
 `https://www.somehost.com/?param4=1&param3=2&param1=4&url=%2Ftest%2Findex.html`
 
 ```
public function handle(string $string): string
{
    list(
    	'scheme' => $scheme,
    	'host' => $host,
    	'path' => $url,
    	'query' => $query
    ) = parse_url($string);
    parse_str($query, $params);
    $modifyParams = array_diff($params, [3]);
    asort($modifyParams);
    $modifyParams['url'] = $url;
    $stringParams = http_build_query($modifyParams);

    return  "{$scheme}://{$host}?{$stringParams}";
}
 ```