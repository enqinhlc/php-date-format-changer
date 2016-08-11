# php-date-format-changer
String olarak girilen tarihin yeniden formatlanması için kullanılır.

# Örnek

Default diye belirtilen satırlar sınıf içerisinde öntanımlı olarak gelmektedir.

```php
$dfc = new DateFormatChanger();
$dfc->setDate('11/08/2016');
$dfc->setFormat('d/m/y'); // default
$dfc->setSeperator('/'); // default
$dfc->setReturnFormat('dmy');
$dfc->setReturnSeperator('-'); // default
echo $dfc->getDate() . "\n"; // 11-08-2016
$dfc->setReturnSeperator('/');
echo $dfc->getDate() . "\n"; // 11/08/2016
```
