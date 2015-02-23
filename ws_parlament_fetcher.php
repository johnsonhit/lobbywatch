<?php
require_once dirname(__FILE__) . '/public_html/settings/settings.php';
require_once dirname(__FILE__) . '/public_html/common/utils.php';
// Run: /opt/lampp/bin/php -f ws_parlament_fetcher.php

// http://www.parlament.ch/D/DOKUMENTATION/WEBSERVICES-OPENDATA/Seiten/default.aspx

// TODO multipage handling
// TODO Datenquelle angeben
// TODO historized handlen
// TODO historized fragen

$kommission_ids = array();

// $url = 'http://ws.parlament.ch/committees?ids=1;2;3&mainOnly=false&permanentOnly=true&currentOnly=true&lang=de&pageNumber=1&format=xml';
// $url = 'http://lobbywatch.ch/de/data/interface/v1/json/table/branche/flat/id/1';

// $json = fopen($url, 'r');
// $json = file_get_contents($url);
// $json = new_get_file_contents($url);

// Set user agent, otherwise only HTML will be returned instead of JSON, ref http://stackoverflow.com/questions/2107759/php-file-get-contents-and-headers
$options = array(
  'http'=>array(
    'method'=>"GET",
    'header'=>"Accept-language: en\r\n" .
              "Cookie: foo=bar\r\n" .  // check function.stream-context-create on php.net
              "User-Agent: Mozilla/5.0\r\n" // i.e. An iPad
  )
);

$context = stream_context_create($options);

for($page = 1, $hasMorePages = true, $i = 0; $hasMorePages; $page++) {
  $ws_parlament_url = "http://ws.parlament.ch/committees?currentOnly=true&mainOnly=true&permanentOnly=false&format=json&lang=de&pageNumber=$page";
  $json = file_get_contents($ws_parlament_url, false, $context);

  // $handle = @fopen($url, "r");
  // if ($handle) {
  //     while (($buffer = fgets($handle, 4096)) !== false) {
  //         echo $buffer;
  //     }
  //     if (!feof($handle)) {
  //         echo "Error: unexpected fgets() fail\n";
  //     }
  //     fclose($handle);
  // }

  // var_dump($json);
  $obj = json_decode($json);
  // var_dump($obj);

  $hasMorePages = false;
  print("Page: $page\n");
  foreach($obj as $kommission) {
    if(property_exists($kommission, 'hasMorePages')) {
      $hasMorePages = $kommission->hasMorePages;
    }
    $i++;
    print($i . '. Kommission: ' . $kommission->id . ' ' . $kommission->abbreviation . ': ' . $kommission->name . ', '
         . $kommission->council->abbreviation . ', ' . $kommission->typeCode . "\n");
    show_members(array($kommission->id), 1, $context);
  }
}

function show_members(array $ids, $level = 1, $context) {
  $ids_str = implode(';', $ids);

  for($page = 1, $hasMorePages = true, $i = 0, $j = 0; $hasMorePages; $page++) {
    $ws_parlament_url = "http://ws.parlament.ch/committees?ids=$ids_str&format=json&lang=de&subcom=true&pageNumber=$page";
    $json = file_get_contents($ws_parlament_url, false, $context);

    // $handle = @fopen($url, "r");
    // if ($handle) {
    //     while (($buffer = fgets($handle, 4096)) !== false) {
    //         echo $buffer;
    //     }
    //     if (!feof($handle)) {
    //         echo "Error: unexpected fgets() fail\n";
    //     }
    //     fclose($handle);
    // }

    // var_dump($json);
    $obj = json_decode($json);
    // var_dump($obj);

    $hasMorePages = false;
//     print("Mitgliederpage: $page\n");
    foreach($obj as $kommission) {
      if(property_exists($kommission, 'hasMorePages')) {
        $hasMorePages = $kommission->hasMorePages;
      }
      $i++;

      $memberNames = '';
      foreach($kommission->members as $member) {
        $memberNames .= $member->lastName . ', ';
        print(str_repeat("\t", $level) . $member->id . ' (' . $member->id . ') ' . $member->firstName . ' ' . $member->lastName . ' ' . $member->committeeFunction  . '=' . $member->committeeFunctionName . ', ' . $member->party . ', ' . $member->canton . "\n");
      }
//       print(str_repeat("\t", $level) . ' Kommissionsmitglieder: ' . $kommission->id . ' ' . $kommission->abbreviation . ': ' . $memberNames . "\n");

      foreach($kommission->subcommittees as $subCom) {
        $j++;
        print(str_repeat("\t", $level) . $j . '. Subkommission: ' . $subCom->id . ' ' . $subCom->abbreviation . ': ' . $subCom->name . ', '
            . $subCom->council->abbreviation . "\n");
        show_members(array($subCom->id), $level + 1, $context);
      }
    }
  }
}

// function to replace file_get_contents()
function new_get_file_contents($url) {
$ch = curl_init();
$timeout = 10; // set to zero for no timeout
curl_setopt ($ch, CURLOPT_URL, $url);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
$file_contents = curl_exec($ch); // take out the spaces of curl statement!!
curl_close($ch);
return $file_contents;
}
