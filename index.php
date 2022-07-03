<?php

declare(strict_types=1);
mb_internal_encoding('utf-8');

$email = 'test1@gmail.com';
$password = 'frjswen9';
$username = 'Anton';

$lang =	[
    'ua' => 'Ukraine',
    'en' => 'English',
    "es" => 'Espanol',
];

$users = [
    '40' => ['name' => 'Vlad', 'email' => 'vlad@gmail.com', 'lang' => 'fr'],
    '2' => ['name' => 'Anton', 'email' => 'anton3434@gmail.com', 'lang' => 'fr'],
    '0' => ['name' => 'Eduard', 'email' => 'edic8345@gmail.com', 'lang' => 'en'],
    '29' => ['name' => 'Anton', 'email' => 'romaha234@gmail.com', 'lang' => 'fr'],
    '18' => ['name' => 'Rostik', 'email' => 'bugiman34@gmail.com', 'lang' => 'de'],
    '6' => ['name' => 'Vlad', 'email' => 'milki34@gmail.com', 'lang' => 'de'],
];

$text = 'Главным фактором языка РНР является практичность. РНР должен предоставить программисту средства для быстрого и эффективного решения поставленных задач. Практический характер РНР обусловлен пятью важными характеристиками: традиционностью, простотой, эффективностью, безопасностью, гибкостью. Существует еще одна «характеристика», которая делает РНР особенно привлекательным: он распространяется бесплатно! Причем, с открытыми исходными кодами ( Open Source ). Язык РНР будет казаться знакомым программистам, работающим в разных областях. Многие конструкции языка позаимствованы из Си, Perl. Код РНР очень похож на тот, который встречается в типичных программах на С или Pascal. Это заметно снижает начальные усилия при изучении РНР. PHP — язык, сочетающий достоинства Perl и Си и специально нацеленный на работу в Интернете, язык с универсальным (правда, за некоторыми оговорками) и ясным синтаксисом. И хотя PHP является довольно молодым языком, он обрел такую популярность среди web-программистов, что на данный момент является чуть ли не самым популярным языком для создания web-приложений (скриптов).';

function str_pad_unicode($str, $pad_len, $pad_str = ' ', $dir = STR_PAD_RIGHT) {
    $str_len = mb_strlen($str);
    $pad_str_len = mb_strlen($pad_str);
    if (!$str_len && ($dir == STR_PAD_RIGHT || $dir == STR_PAD_LEFT)) {
        $str_len = 1; // @debug
    }
    if (!$pad_len || !$pad_str_len || $pad_len <= $str_len) {
        return $str;
    }

    $result = null;
    $repeat = (int) ceil($str_len - $pad_str_len + $pad_len);
    if ($dir == STR_PAD_RIGHT) {
        $result = $str . str_repeat($pad_str, $repeat);
        $result = mb_substr($result, 0, $pad_len);
    } else if ($dir == STR_PAD_LEFT) {
        $result = str_repeat($pad_str, $repeat) . $str;
        $result = mb_substr($result, -$pad_len);
    } else if ($dir == STR_PAD_BOTH) {
        $length = ceil(($pad_len - $str_len) / 2);
        $repeat = (int) ceil($length / $pad_str_len);
        $result = mb_substr(str_repeat($pad_str, $repeat), 0, (int) floor($length))
                    . $str
                    . mb_substr(str_repeat($pad_str, $repeat), 0, (int) ceil($length));
    }

    return $result;
}

function fillSpaces(array $words, int $strLength, int $wordsSumLength): string {
    $spacesCount = $strLength - $wordsSumLength;
    $wordCount = count($words);
    $lastWord = 1;
    $space = 1;
    $spaceDistribution = ceil($spacesCount / ($wordCount - $lastWord));
    $result = '';
    $minLengthStr = $wordsSumLength + ($wordCount - $lastWord - $space);

    for($wordIdx = 0; $wordIdx < $wordCount; $wordIdx++){
        $word = $words[$wordIdx];
        $wordLength = mb_strlen($word);
        $wordLengthWithSpaces = null;

        if($wordIdx === $wordCount - 1){
            $result .= $word;
            break;
        }

        for($spaceWidth = (int) $spaceDistribution; $spaceWidth >= 1; $spaceWidth--){
            if(($minLengthStr + $spaceWidth) <= $strLength){
                $wordLengthWithSpaces = $wordLength + $spaceWidth;
                $minLengthStr += $spaceWidth - $space;
                break;
            } else if($spaceWidth === 1){
                $wordLengthWithSpaces = $wordLength + $space;
                break;
            } else  continue;
        }

        $result .= str_pad_unicode($word, $wordLengthWithSpaces, ' ');
    }
    return $result;
};



function formatedText(string $text, int $strLength): string {
    $result = '';
    $textLength = mb_strlen($text);
    $words = explode(' ', $text);
    $numbersOfSubStr = $textLength / $strLength;
    $offset = 0;
    $minSpace = 1;

    for($subStrIdx = 0; $subStrIdx < $numbersOfSubStr; $subStrIdx++){
        $acc = [];
        $lengthSubStr = 0;
        $spaceCount = 0;

        for($wordIdx = $offset; $wordIdx < count($words); $wordIdx++){
            $wordLength = mb_strlen($words[$wordIdx]);

            if(($lengthSubStr + $wordLength + $spaceCount) < $strLength){
                $lengthSubStr += $wordLength;
                $spaceCount += $minSpace;
                array_push($acc, $words[$wordIdx]);
            } else {
                $offset = $wordIdx;
                break;
            }
        }
        $subStr = fillSpaces($acc, $strLength, $lengthSubStr);

        $result .= $subStr . ' => ' . mb_strlen($subStr) . '<br>';
    }
    return $result;
};

echo '<pre>';
echo formatedText($text, 80);
echo '</pre>';

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="index.css">
  <title>SignUp</title>
</head>

<body>
  <div class="card">
    <h2 class="card-heading">
      Sign up
    </h2>
    <form class="card-form">
      <div class="input">
        <input type="text" class="input-field" value="<?php echo $username ?>" required />
        <label class="input-label">Username</label>
      </div>
      <div class="input">
        <input type="text" class="input-field" value="<?php echo $email ?>" required />
        <label class="input-label">Email</label>
      </div>
      <div class="input">
        <input type="password" class="input-field" required value="<?php echo $password ?>" />
        <label class="input-label">Password</label>
      </div>
      <div class="input">
        <select class="input-field" name="langs" required>
          <?php foreach($langs as $langCode => $lang):?>
          <option value="<?php echo $langCode; ?>">
            <?php echo $lang; ?>
          </option>
          <?php endforeach; ?>
        </select>
        <label class="input-label">Change language</label>
      </div>
      <div class="action">
        <button class="action-button">Sign up</button>
      </div>
    </form>
  </div>
</body>

</html>