<?php

require_once dirname(__FILE__) . "/../common/utils.php";
require_once dirname(__FILE__) . '/../bearbeitung/components/grid/grid_state.php';

define('OPERATION_AUTHORIZE_SELECTED', 'autsel');
define('OPERATION_DE_AUTHORIZE_SELECTED', 'deautsel');
define('OPERATION_RELEASE_SELECTED', 'relsel');
define('OPERATION_DE_RELEASE_SELECTED', 'derelsel');
define('OPERATION_SET_IMRATBIS_SELECTED', 'setimratbissel');
define('OPERATION_CLEAR_IMRATBIS_SELECTED', 'clearimratbissel');

$edit_header_message = "<div class=\"simplebox\"><b>Stand (Version $version $build_date_short)</b>: Die Tabellen <i>In_kommission</i>, <i>Kommission</i>, <i>Partei</i>, <i>Branche</i> k�nnen bearbeitet werden. Die anderen �nderungen gehen wieder verloren.</div>";

$edit_general_hint = '<div class="clearfix rbox note"><div class="rbox-title"><img src="img/icons/book_open.png" alt="Hinweis" title="Hinweis" class="icon" width="16" height="16"><span>Hinweis</span></div><div class="rbox-data">Bitte die Bearbeitungsdokumentation (vor einer Bearbeitung) beachten und bei Unklarheiten anpassen, siehe <a href="http://lobbycontrol.ch/wiki/tiki-index.php?page=Datenerfassung&structure=Lobbycontrol-Wiki" target="_blank">Wiki Datenbearbeitung</a> und <a href="' . $env_dir . 'lobbycontrol_datenmodell.pdf">Datenmodell</a> (PDF).</div></div>';

//df_clean();

function setupRSS($page, $dataset) {
  $title = ucwords ( $page->GetCaption () );
  $table = str_replace ( '`', '', $dataset->GetName () );
  switch ($table) {
    case 'parlamentarier' :
      $rss_title = 'Parlamentarier %vorname% %nachname% changed by %updated_visa% at %updated_date%';
      $rss_body = 'Beruf: %beruf%<br>Kanton: %kanton%';
      break;
    case 'interessenbindung' :
      $rss_title = 'Interessenbindung %beschreibung% changed by %updated_visa% at %updated_date%';
      $rss_body = '';
      break;
    case 'mandat' :
      $rss_title = 'Mandat %beschreibung% changed by %updated_visa% at %updated_date%';
      $rss_body = '';
      break;
    case 'interessengruppe' :
      $rss_title = 'Interessengruppe %name% changed by %updated_visa% at %updated_date%';
      $rss_body = '%beschreibung%';
      break;
    case 'branche' :
      $rss_title = 'Branche %name% changed by %updated_visa% at %updated_date%';
      $rss_body = '%beschreibung%<br>%angaben%';
      break;
    case 'partei' :
      $rss_title = 'Partei %abkuerzung% changed by %updated_visa% at %updated_date%';
      $rss_body = 'Name: %name%<br>Gr�ndung: %gruendung%<br>Position: %position%';
      break;
    case 'zugangsberechtigung' :
      $rss_title = 'Zutrittsberechtigung %vorname% %nachname% changed by %updated_visa% at %updated_date%';
      $rss_body = 'Funktion: %funktion%';
      break;
    case 'organisation' :
      $rss_title = 'Organisation %name% changed by %updated_visa% at %updated_date%';
      $rss_body = '%beschreibung%<br>Typ: %typ%<br>Vernehmlassung: %vernehmlassung%';
      break;
    case 'organisation_beziehung' :
      $rss_title = 'Organisation_Beziehung ID %id% changed by %updated_visa% at %updated_date%';
      $rss_body = '%beziehungsart%';
      break;
      case 'kommission' :
      $rss_title = 'Kommission %name% (%abkuerzung%) changed by %updated_visa% at %updated_date%';
      $rss_body = '%sachbereiche%';
      break;
    case 'in_kommission' :
      $rss_title = 'In_Kommission ID %id% changed by %updated_visa% at %updated_date%';
      $rss_body = '';
      $no_body_id = true;
      break;
    default :
      $rss_title = "$title ID %id% changed by %updated_visa% at %updated_date%";
      $rss_body = '';
      $no_body_id = true;
  }

  $rss_body .= "<br>%notizen%";

  if (!isset($no_body_id) || $no_body_id === false)
    $rss_body .= "<br>$title ID %id%<br>Updated by %updated_visa% at %updated_date%";

  $base_url = "http://$_SERVER[HTTP_HOST]";
  $generator = new DatasetRssGenerator ( $dataset, convert_utf8 ( $title . ' RSS' ), $base_url, convert_utf8('�nderungen der Lobbycontrol-Datenbank als RSS Feed'), convert_utf8 ($rss_title), $table . ' at %id%', convert_utf8 ($rss_body) );
  $generator->SetItemPublicationDateFieldName ( 'updated_date' );
  $generator->SetOrderByFieldName ( 'updated_date' );
  $generator->SetOrderType ( otDescending );

  return $generator;
}

function convert_utf8($text) {
  return ConvertTextToEncoding($text, GetAnsiEncoding(), 'UTF-8' );
}

function convert_ansi($text) {
  return ConvertTextToEncoding($text, 'UTF-8', GetAnsiEncoding());
}

function before_render(Page $page) {
  $page->OnCustomHTMLHeader->AddListener('add_custom_header');

  $hints = array();
  foreach($page->GetGrid()->GetViewColumns() as $column) {
    $raw_name = $column->GetName();
    $name = preg_replace('/^(.*?_id).*/', '\1', $raw_name);
    $name = preg_replace('/_anzeige_name$/', '', $name);
    $hints[$name] = htmlspecialchars($column->GetDescription());
//      df("Names: $raw_name -> $name");
  }
  $GLOBALS['customParams'] = array( 'Hints' => $hints);
}

function add_custom_header(&$page, &$result) {
$result = <<<'EOD'
  <script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-45624114-1', 'lobbycontrol.ch');
    ga('send', 'pageview');

  </script>
  <meta name="Generator" content="PHP Generator for MySQL (http://sqlmaestro.com)" />
  <link rel="shortcut icon" href="/favicon.png" type="image/png" />
EOD;
$result .= <<<EOD
  <link rel="alternate" type="application/rss+xml" title="{$page->GetCaption()} Update RSS" href="{$page->GetRssLink()}" />
EOD;

}

function parlamentarier_update_photo_metadata($page, &$rowData, &$cancel, &$message, $tableName)
{
  // df($rowData);
  $file = $rowData['photo'];

  // A photo filename ending with / means there was no photo
  if ($file !== null && !endsWith($file, '/')) {
    $path_parts = pathinfo($file);

    $finfo_mime = new finfo(FILEINFO_MIME_TYPE); // return mime type ala mimetype extension

    $rowData['photo_dateiname'] = $path_parts['filename'];
    if (isset($path_parts['extension'])) {
      $rowData['photo_dateierweiterung'] = $path_parts['extension'];
    }
    $rowData['photo_dateiname_voll'] = $path_parts['basename'];
    $rowData['photo_mime_type'] = $finfo_mime->file($file);

    // Kleinbild
    $file = $rowData['kleinbild'];

    $path_parts = pathinfo($file);

    $rowData['kleinbild'] = $path_parts['basename'];
  } else {
    $rowData['photo'] = null;
    $rowData['photo_dateiname'] = null;
    $rowData['photo_dateierweiterung'] = null;
    $rowData['photo_dateiname_voll'] = null;
    $rowData['photo_mime_type'] = null;
    $rowData['kleinbild'] = null;
  }
}

function parlamentarier_remove_old_photo($page, &$rowData, &$cancel, &$message, $tableName)
{
//   df($rowData);
//   df($tableName);
  $file = $rowData['photo'];
  $id = $rowData['id'];

  // prevent SQL injection
  if (!is_numeric($id)) {
    return false;
  }

  $values = array();
  $page->GetConnection()->ExecQueryToArray("SELECT `id`, `photo` FROM $tableName WHERE `id`=$id", $values);
//   df("SELECT `photo` FROM $tableName WHERE id=$id");
//   df($values);
  if (count($values) > 0 ) {
    $old_file = $values[0]['photo'];
  } else {
    return false;
  }
  // A photo filename ending with / means there was no photo
  if ($old_file !== null && $old_file !== $file) {
    if (FileUtils::FileExists($old_file))
      $result = FileUtils::RemoveFile($old_file);
    $message = "Deleted old photo $old_file";
  }
}

function parlamentarier_check_imRatBis($page, &$rowData, &$cancel, &$message, $tableName)
{
  // df($rowData);
  $imRatBis = $rowData['im_rat_bis'];

    df($imRatBis);
//    df($imRatBis === null);
//    df($imRatBis === '');
//   df($imRatBis->GetTimestamp());
//   df($imRatBis->GetDateTime());
  if ($imRatBis !== null && $imRatBis->GetTimestamp() > SMDateTime::Now()->GetTimestamp()) {
    $cancel = true;
    $message = '"Im Rat bis"-Datum darf nicht in der Zukunft liegen: ' . $imRatBis->ToString('d.m.Y');
  }

}

function check_bis_date($page, &$rowData, &$cancel, &$message, $tableName)
{
  // df($rowData);
  $bis = $rowData['bis'];
//   df($bis);
//   df($bis->GetTimestamp());
  if ($bis !== null && $bis->GetTimestamp() > SMDateTime::Now()->GetTimestamp()) {
    $cancel = true;
    $message = 'Bis-Datum darf nicht in der Zukunft liegen: ' . $bis->ToString('d.m.Y');
  }
}


abstract class SelectedOperationGridState extends GridState {
  protected $date;

  protected function DoCanChangeData(&$rowValues, &$message) {
    $cancel = false;
    $this->grid->BeforeUpdateRecord->Fire ( array (
        $this->GetPage (),
        &$rowValues,
        &$cancel,
        &$message,
        $this->GetDataset ()->GetName ()
    ) );
    return ! $cancel;
  }
  protected function DoAfterChangeData($rowValues) {
    $this->grid->AfterUpdateRecord->Fire ( array (
        $this->GetPage (),
        &$rowValues,
        $this->GetDataset ()->GetName ()
    ) );
  }
  protected abstract function DoOperation();

  protected function isValidDate($date) {
    $date_array = date_parse($date);
    return preg_match('/^(0[1-9]|[12][0-9]|3[01])\.(0[1-9]|1[012])\.(20)\d\d$/', $date) && checkdate($date_array["month"], $date_array["day"], $date_array["year"]);
  }

  public function ProcessMessages() {
    $primaryKeysArray = array ();
    for($i = 0; $i < GetApplication ()->GetPOSTValue ( 'recordCount' ); $i ++) {
      if (GetApplication ()->IsPOSTValueSet ( 'rec' . $i )) {
        // TODO : move GetPrimaryKeyFieldNames function to private
        $primaryKeys = array ();
        $primaryKeyNames = $this->grid->GetDataset ()->GetPrimaryKeyFieldNames ();
        for($j = 0; $j < count ( $primaryKeyNames ); $j ++)
          $primaryKeys [] = GetApplication ()->GetPOSTValue ( 'rec' . $i . '_pk' . $j );
        $primaryKeysArray [] = $primaryKeys;
      }
    }

    // df($primaryKeysArray);

    $inlineInsertedRecordPrimaryKeyNames = GetApplication ()->GetSuperGlobals ()->GetPostVariablesIf ( create_function ( '$str', 'return StringUtils::StartsWith($str, \'inline_inserted_rec_\') && !StringUtils::Contains($str, \'pk\');' ) );

    // df($inlineInsertedRecordPrimaryKeyNames);

    foreach ( $inlineInsertedRecordPrimaryKeyNames as $name => $value ) {
      $primaryKeys = array ();
      $primaryKeyNames = $this->grid->GetDataset ()->GetPrimaryKeyFieldNames ();
      for($i = 0; $i < count ( $primaryKeyNames ); $i ++)
        $primaryKeys [] = GetApplication ()->GetSuperGlobals ()->GetPostValue ( $name . '_pk' . $i );
      $primaryKeysArray [] = $primaryKeys;
    }

    // df($primaryKeysArray);

    $input_date = GetApplication ()->GetPOSTValue ( 'date' );
    df('Dates:');
//     df($input_date);
//     df($this->GetPage ()->GetEnvVar ( 'CURRENT_DATETIME' ));
    if ($this->isValidDate($input_date)) {
      $this->date = $input_date;
    } else { // includes empty date
      $this->date = $this->GetPage ()->GetEnvVar ( 'CURRENT_DATETIME' );
    }
//     df($this->date);

    foreach ( $primaryKeysArray as $primaryKeyValues ) {
      $this->grid->GetDataset ()->SetSingleRecordState ( $primaryKeyValues );
      $this->grid->GetDataset ()->Open ();
      $this->grid->GetDataset ()->Edit ();

      if ($this->grid->GetDataset ()->Next ()) {
        $message = '';

        $fieldValues = $this->grid->GetDataset ()->GetCurrentFieldValues ();
        if ($this->CanChangeData ( $fieldValues, $message )) {
          try {
            $this->DoOperation ();
            $this->grid->GetDataset ()->Post ();
            // Refetch field values as the may have changed
            $fieldValues = $this->grid->GetDataset ()->GetCurrentFieldValues ();
            $this->DoAfterChangeData ( $fieldValues );
          } catch ( Exception $e ) {
            $this->grid->GetDataset ()->SetAllRecordsState ();
            $this->ChangeState ( OPERATION_VIEWALL );
            $this->SetGridErrorMessage ( $e );
            return;
          }
        } else {
          $this->grid->GetDataset ()->SetAllRecordsState ();
          $this->ChangeState ( OPERATION_VIEWALL );
          $this->SetGridSimpleErrorMessage ( $message );
          return;
        }
      }
      $this->grid->GetDataset ()->Close ();
    }

    $this->ApplyState ( OPERATION_VIEWALL );
  }
}
class AuthorizeSelectedGridState extends SelectedOperationGridState {
  protected function DoOperation() {
    // df($this->grid->GetDataset()->GetFieldValueByName('id'));
    $userName = $this->GetPage ()->GetEnvVar ( 'CURRENT_USER_NAME' );

    $this->grid->GetDataset ()->SetFieldValueByName ( 'autorisiert_visa', $userName );
    $this->grid->GetDataset ()->SetFieldValueByName ( 'autorisiert_datum', $this->date );
  }
}
class DeAuthorizeSelectedGridState extends SelectedOperationGridState {
  protected function DoOperation() {
    // df($this->grid->GetDataset()->GetFieldValueByName('id'));
    $this->grid->GetDataset ()->SetFieldValueByName ( 'autorisiert_visa', null );
    $this->grid->GetDataset ()->SetFieldValueByName ( 'autorisiert_datum', null );
  }
}
class ReleaseSelectedGridState extends SelectedOperationGridState {
  protected function DoOperation() {
    // df($this->grid->GetDataset()->GetFieldValueByName('id'));
    $userName = $this->GetPage ()->GetEnvVar ( 'CURRENT_USER_NAME' );
    $datetime = $this->GetPage ()->GetEnvVar ( 'CURRENT_DATETIME' );

    $this->grid->GetDataset ()->SetFieldValueByName ( 'freigabe_visa', $userName );
    $this->grid->GetDataset ()->SetFieldValueByName ( 'freigabe_datum', $datetime );
  }
}
class DeReleaseSelectedGridState extends SelectedOperationGridState {
  protected function DoOperation() {
    // df($this->grid->GetDataset()->GetFieldValueByName('id'));
    $this->grid->GetDataset ()->SetFieldValueByName ( 'freigabe_visa', null );
    $this->grid->GetDataset ()->SetFieldValueByName ( 'freigabe_datum', null );
  }
}

class SetImRatBisSelectedGridState extends SelectedOperationGridState {
  protected function DoOperation() {
    $this->grid->GetDataset ()->SetFieldValueByName ( 'im_rat_bis', $this->date );
  }
}
class ClearImRatBisSelectedGridState extends SelectedOperationGridState {
  protected function DoOperation() {
    $this->grid->GetDataset ()->SetFieldValueByName ( 'im_rat_bis', null );
  }
}
