<?php
// Processed by afterburner.sh


/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                                   ATTENTION!
 * If you see this message in your browser (Internet Explorer, Mozilla Firefox, Google Chrome, etc.)
 * this means that PHP is not properly installed on your web server. Please refer to the PHP manual
 * for more details: http://php.net/manual/install.php 
 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */

    include_once dirname(__FILE__) . '/components/startup.php';
    include_once dirname(__FILE__) . '/components/application.php';
    include_once dirname(__FILE__) . '/' . 'authorization.php';


    include_once dirname(__FILE__) . '/' . 'database_engine/mysql_engine.php';
    include_once dirname(__FILE__) . '/' . 'components/page/page_includes.php';

    function GetConnectionOptions()
    {
        $result = GetGlobalConnectionOptions();
        $result['client_encoding'] = 'utf8';
        GetApplication()->GetUserAuthentication()->applyIdentityToConnectionOptions($result);
        return $result;
    }

    // OnGlobalBeforePageExecute event handler
    globalOnBeforePageExecute();
    
    
    // OnBeforePageExecute event handler
    
    
    
    class organisation_beziehungPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`organisation_beziehung`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('organisation_id', true),
                    new IntegerField('ziel_organisation_id', true),
                    new StringField('art', true),
                    new StringField('beschreibung'),
                    new StringField('beschreibung_fr'),
                    new StringField('quelle_url'),
                    new IntegerField('quelle_url_gueltig'),
                    new StringField('quelle'),
                    new DateField('von'),
                    new DateField('bis'),
                    new StringField('notizen'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true)
                )
            );
            $this->dataset->AddLookupField('organisation_id', 'v_organisation_simple', new IntegerField('id'), new StringField('searchable_name', false, false, false, false, 'organisation_id_searchable_name', 'organisation_id_searchable_name_v_organisation_simple'), 'organisation_id_searchable_name_v_organisation_simple');
            $this->dataset->AddLookupField('ziel_organisation_id', 'v_organisation_simple', new IntegerField('id'), new StringField('searchable_name', false, false, false, false, 'ziel_organisation_id_searchable_name', 'ziel_organisation_id_searchable_name_v_organisation_simple'), 'ziel_organisation_id_searchable_name_v_organisation_simple');
        }
    
        protected function DoPrepare() {
            globalOnPreparePage($this);
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(12);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
        }
    
        protected function CreateRssGenerator() {
            return setupRSS($this, $this->dataset); /*afterburner*/ 
        }
    
        protected function setupCharts()
        {
    
        }
    
        protected function getFiltersColumns()
        {
            return array(
                new FilterColumn($this->dataset, 'id', 'id', 'Id'),
                new FilterColumn($this->dataset, 'organisation_id', 'organisation_id_searchable_name', 'Organisation'),
                new FilterColumn($this->dataset, 'art', 'art', 'Art'),
                new FilterColumn($this->dataset, 'ziel_organisation_id', 'ziel_organisation_id_searchable_name', 'Ziel Organisation'),
                new FilterColumn($this->dataset, 'beschreibung', 'beschreibung', 'Beschreibung'),
                new FilterColumn($this->dataset, 'beschreibung_fr', 'beschreibung_fr', 'Beschreibung Fr'),
                new FilterColumn($this->dataset, 'quelle_url', 'quelle_url', 'Quelle Url'),
                new FilterColumn($this->dataset, 'quelle_url_gueltig', 'quelle_url_gueltig', 'Quelle Url Gueltig'),
                new FilterColumn($this->dataset, 'quelle', 'quelle', 'Quelle'),
                new FilterColumn($this->dataset, 'von', 'von', 'Von'),
                new FilterColumn($this->dataset, 'bis', 'bis', 'Bis'),
                new FilterColumn($this->dataset, 'notizen', 'notizen', 'Notizen'),
                new FilterColumn($this->dataset, 'eingabe_abgeschlossen_visa', 'eingabe_abgeschlossen_visa', 'Eingabe Abgeschlossen Visa'),
                new FilterColumn($this->dataset, 'eingabe_abgeschlossen_datum', 'eingabe_abgeschlossen_datum', 'Eingabe Abgeschlossen Datum'),
                new FilterColumn($this->dataset, 'kontrolliert_visa', 'kontrolliert_visa', 'Kontrolliert Visa'),
                new FilterColumn($this->dataset, 'kontrolliert_datum', 'kontrolliert_datum', 'Kontrolliert Datum'),
                new FilterColumn($this->dataset, 'freigabe_visa', 'freigabe_visa', 'Freigabe Visa'),
                new FilterColumn($this->dataset, 'freigabe_datum', 'freigabe_datum', 'Freigabe Datum'),
                new FilterColumn($this->dataset, 'created_visa', 'created_visa', 'Created Visa'),
                new FilterColumn($this->dataset, 'created_date', 'created_date', 'Created Date'),
                new FilterColumn($this->dataset, 'updated_visa', 'updated_visa', 'Updated Visa'),
                new FilterColumn($this->dataset, 'updated_date', 'updated_date', 'Updated Date')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id'])
                ->addColumn($columns['organisation_id'])
                ->addColumn($columns['art'])
                ->addColumn($columns['ziel_organisation_id'])
                ->addColumn($columns['beschreibung'])
                ->addColumn($columns['beschreibung_fr'])
                ->addColumn($columns['quelle_url'])
                ->addColumn($columns['quelle'])
                ->addColumn($columns['notizen']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('id')
                ->setOptionsFor('organisation_id')
                ->setOptionsFor('art')
                ->setOptionsFor('ziel_organisation_id')
                ->setOptionsFor('von')
                ->setOptionsFor('bis')
                ->setOptionsFor('eingabe_abgeschlossen_visa')
                ->setOptionsFor('eingabe_abgeschlossen_datum')
                ->setOptionsFor('kontrolliert_visa')
                ->setOptionsFor('kontrolliert_datum')
                ->setOptionsFor('freigabe_visa')
                ->setOptionsFor('freigabe_datum')
                ->setOptionsFor('created_visa')
                ->setOptionsFor('created_date')
                ->setOptionsFor('updated_visa')
                ->setOptionsFor('updated_date');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('id_edit');
            
            $filterBuilder->addColumn(
                $columns['id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('organisation_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_organisation_id_searchable_name_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('organisation_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_organisation_id_searchable_name_search');
            
            $text_editor = new TextEdit('organisation_id');
            
            $filterBuilder->addColumn(
                $columns['organisation_id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new ComboBox('art_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $main_editor->addChoice('mitglied von', 'Mitglied von / Membre de');
            $main_editor->addChoice('arbeitet fuer', 'Arbeitet für / Travail pour');
            $main_editor->addChoice('tochtergesellschaft von', 'Suborganisation von (Tochtergesellschaft, Zweigstelle) / Sous organisation de (filiale, succursale)');
            $main_editor->addChoice('partner von', 'Partner von / Partenaire de');
            $main_editor->addChoice('beteiligt an', 'Beteiligt an / Associé');
            $main_editor->SetAllowNullValue(false);
            
            $multi_value_select_editor = new MultiValueSelect('art');
            $multi_value_select_editor->setChoices($main_editor->getChoices());
            
            $text_editor = new TextEdit('art');
            
            $filterBuilder->addColumn(
                $columns['art'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('ziel_organisation_id_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_ziel_organisation_id_searchable_name_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('ziel_organisation_id', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_ziel_organisation_id_searchable_name_search');
            
            $text_editor = new TextEdit('ziel_organisation_id');
            
            $filterBuilder->addColumn(
                $columns['ziel_organisation_id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('beschreibung_edit');
            $main_editor->SetMaxLength(150);
            
            $filterBuilder->addColumn(
                $columns['beschreibung'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('beschreibung_fr_edit');
            $main_editor->SetMaxLength(150);
            
            $filterBuilder->addColumn(
                $columns['beschreibung_fr'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('quelle_url_edit');
            $main_editor->SetMaxLength(255);
            
            $filterBuilder->addColumn(
                $columns['quelle_url'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('quelle_edit');
            $main_editor->SetMaxLength(80);
            
            $filterBuilder->addColumn(
                $columns['quelle'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('von_edit', false, 'Y-m-d H:i:s');
            
            $filterBuilder->addColumn(
                $columns['von'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('bis_edit', false, 'd.m.Y');
            
            $filterBuilder->addColumn(
                $columns['bis'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('notizen');
            
            $filterBuilder->addColumn(
                $columns['notizen'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('eingabe_abgeschlossen_visa_edit');
            $main_editor->SetMaxLength(10);
            
            $filterBuilder->addColumn(
                $columns['eingabe_abgeschlossen_visa'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('eingabe_abgeschlossen_datum_edit', false, 'd.m.Y H:i:s');
            
            $filterBuilder->addColumn(
                $columns['eingabe_abgeschlossen_datum'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('kontrolliert_visa_edit');
            $main_editor->SetMaxLength(10);
            
            $filterBuilder->addColumn(
                $columns['kontrolliert_visa'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('kontrolliert_datum_edit', false, 'd.m.Y H:i:s');
            
            $filterBuilder->addColumn(
                $columns['kontrolliert_datum'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('freigabe_visa_edit');
            $main_editor->SetMaxLength(10);
            
            $filterBuilder->addColumn(
                $columns['freigabe_visa'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('freigabe_datum_edit', false, 'd.m.Y H:i:s');
            
            $filterBuilder->addColumn(
                $columns['freigabe_datum'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('created_visa_edit');
            $main_editor->SetMaxLength(10);
            
            $filterBuilder->addColumn(
                $columns['created_visa'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('created_date_edit', false, 'd.m.Y H:i:s');
            
            $filterBuilder->addColumn(
                $columns['created_date'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('updated_visa_edit');
            $main_editor->SetMaxLength(10);
            
            $filterBuilder->addColumn(
                $columns['updated_visa'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DateTimeEdit('updated_date_edit', false, 'd.m.Y H:i:s');
            
            $filterBuilder->addColumn(
                $columns['updated_date'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::DATE_EQUALS => $main_editor,
                    FilterConditionOperator::DATE_DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::TODAY => null,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
            $actions = $grid->getActions();
            $actions->setCaption($this->GetLocalizerCaptions()->GetMessageString('Actions'));
            $actions->setPosition(ActionList::POSITION_LEFT);
            
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('View'), OPERATION_VIEW, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
            
            if ($this->GetSecurityInfo()->HasEditGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Edit'), OPERATION_EDIT, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowEditButtonHandler', $this);
            }
            
            if ($this->GetSecurityInfo()->HasDeleteGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Delete'), OPERATION_DELETE, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowDeleteButtonHandler', $this);
                $operation->SetAdditionalAttribute('data-modal-operation', 'delete');
                $operation->SetAdditionalAttribute('data-delete-handler-name', $this->GetModalGridDeleteHandler());
            }
            
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Copy'), OPERATION_COPY, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
        }
    
        protected function AddFieldColumns(Grid $grid, $withDetails = true)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Technischer Schlüssel einer Organisationsbeziehung');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for searchable_name field
            //
            $column = new TextViewColumn('organisation_id', 'organisation_id_searchable_name', 'Organisation', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('organisation.php?operation=view&pk0=%organisation_id%');
            $column->setTarget('_self');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Fremdschlüssel Organisation.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for art field
            //
            $column = new TextViewColumn('art', 'art', 'Art', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Beschreibt die Beziehung einer Organisation zu einer Zielorganisation. Hinweise: <ul><li>Arbeitet für: Transitive Verknüpfung mit Zielorganisation<li>Suborganisation: Transitive Verknüpfung mit beiden Organisationen ("Ober- und Unterorgansiationen")<li>Andere: Keine transitive Erweiterung</ul> Beispiel: Wenn AVES eine Zweigstelle Bern o. die Groupe Mutuel einen Dachverein hat, sollten diese als "Suborganisation" und nicht als "Mitglied von" erfasst werden, denn mit der Suborganisation werden die Verbindungen automatisch auf die Ober- oder Unterorganisation erweitert, d.h. sie verhalten sich wie eine Organisation. Bei "Mitglied von" passiert keine Erweiterung, d.h. sie werden bei Verbindungen als separate Organisation behandelt, z.B. die Mitglieder von Economiesuisse.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for searchable_name field
            //
            $column = new TextViewColumn('ziel_organisation_id', 'ziel_organisation_id_searchable_name', 'Ziel Organisation', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('organisation.php?operation=view&pk0=%ziel_organisation_id%');
            $column->setTarget('_self');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Fremdschlüssel der Zielorganisation.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for beschreibung field
            //
            $column = new TextViewColumn('beschreibung', 'beschreibung', 'Beschreibung', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('organisation_beziehungGrid_beschreibung_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Bezeichung der Organisationsbeziehung. Möglichst kurz. Wird nicht ausgewertet, jedoch angezeigt.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for beschreibung_fr field
            //
            $column = new TextViewColumn('beschreibung_fr', 'beschreibung_fr', 'Beschreibung Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('organisation_beziehungGrid_beschreibung_fr_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Französische Bezeichung der Organisationsbeziehung. Möglichst kurz. Wird nicht ausgewertet, jedoch angezeigt.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for quelle_url field
            //
            $column = new TextViewColumn('quelle_url', 'quelle_url', 'Quelle Url', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('%quelle_url%');
            $column->setTarget('');
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('organisation_beziehungGrid_quelle_url_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('URL der Quelle; zum Beleg');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for quelle field
            //
            $column = new TextViewColumn('quelle', 'quelle', 'Quelle', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('organisation_beziehungGrid_quelle_handler_list');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Quellenangabe, Format: "[Publikation], DD.MM.YYYY", falls vorhanden bitte die URL im Feld "Quelle URL" auch hinzufügen');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for von field
            //
            $column = new DateTimeViewColumn('von', 'von', 'Von', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Beginn der Organisationsbeziehung, leer (NULL) = unbekannt');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for bis field
            //
            $column = new DateTimeViewColumn('bis', 'bis', 'Bis', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Ende der Organisationsbeziehung, leer (NULL) = aktuell gültig, nicht leer = historischer Eintrag');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for notizen field
            //
            $column = new TextViewColumn('notizen', 'notizen', 'Notizen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('organisation_beziehungGrid_notizen_handler_list');
            $column->SetReplaceLFByBR(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Interne Notizen zu diesem Eintrag. Einträge am besten mit Datum und Visa versehen.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_visa field
            //
            $column = new TextViewColumn('eingabe_abgeschlossen_visa', 'eingabe_abgeschlossen_visa', 'Eingabe Abgeschlossen Visa', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Kürzel der Person, welche die Eingabe abgeschlossen hat.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_datum field
            //
            $column = new DateTimeViewColumn('eingabe_abgeschlossen_datum', 'eingabe_abgeschlossen_datum', 'Eingabe Abgeschlossen Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Die Eingabe ist für den Ersteller der Einträge abgeschlossen und bereit für die Kontrolle. (Leer/NULL bedeutet, dass die Eingabe noch im Gange ist.)');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for kontrolliert_visa field
            //
            $column = new TextViewColumn('kontrolliert_visa', 'kontrolliert_visa', 'Kontrolliert Visa', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Kürzel der Person, welche die Eingabe kontrolliert hat.');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for kontrolliert_datum field
            //
            $column = new DateTimeViewColumn('kontrolliert_datum', 'kontrolliert_datum', 'Kontrolliert Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Der Eintrag wurde durch eine zweite Person am angegebenen Datum kontrolliert. (Leer/NULL bedeutet noch nicht kontrolliert.)');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for freigabe_visa field
            //
            $column = new TextViewColumn('freigabe_visa', 'freigabe_visa', 'Freigabe Visa', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Freigabe von (Freigabe = Daten sind fertig)');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for freigabe_datum field
            //
            $column = new DateTimeViewColumn('freigabe_datum', 'freigabe_datum', 'Freigabe Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Freigabedatum (Freigabe = Daten sind fertig)');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for created_visa field
            //
            $column = new TextViewColumn('created_visa', 'created_visa', 'Created Visa', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Erstellt von');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for created_date field
            //
            $column = new DateTimeViewColumn('created_date', 'created_date', 'Created Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Erstellt am');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for updated_visa field
            //
            $column = new TextViewColumn('updated_visa', 'updated_visa', 'Updated Visa', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Abgeändert von');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for updated_date field
            //
            $column = new DateTimeViewColumn('updated_date', 'updated_date', 'Updated Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('Abgeändert am');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for searchable_name field
            //
            $column = new TextViewColumn('organisation_id', 'organisation_id_searchable_name', 'Organisation', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('organisation.php?operation=view&pk0=%organisation_id%');
            $column->setTarget('_self');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for art field
            //
            $column = new TextViewColumn('art', 'art', 'Art', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for searchable_name field
            //
            $column = new TextViewColumn('ziel_organisation_id', 'ziel_organisation_id_searchable_name', 'Ziel Organisation', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('organisation.php?operation=view&pk0=%ziel_organisation_id%');
            $column->setTarget('_self');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for beschreibung field
            //
            $column = new TextViewColumn('beschreibung', 'beschreibung', 'Beschreibung', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('organisation_beziehungGrid_beschreibung_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for beschreibung_fr field
            //
            $column = new TextViewColumn('beschreibung_fr', 'beschreibung_fr', 'Beschreibung Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('organisation_beziehungGrid_beschreibung_fr_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for quelle_url field
            //
            $column = new TextViewColumn('quelle_url', 'quelle_url', 'Quelle Url', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('%quelle_url%');
            $column->setTarget('');
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('organisation_beziehungGrid_quelle_url_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for quelle field
            //
            $column = new TextViewColumn('quelle', 'quelle', 'Quelle', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('organisation_beziehungGrid_quelle_handler_view');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for von field
            //
            $column = new DateTimeViewColumn('von', 'von', 'Von', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for bis field
            //
            $column = new DateTimeViewColumn('bis', 'bis', 'Bis', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for notizen field
            //
            $column = new TextViewColumn('notizen', 'notizen', 'Notizen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('organisation_beziehungGrid_notizen_handler_view');
            $column->SetReplaceLFByBR(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_visa field
            //
            $column = new TextViewColumn('eingabe_abgeschlossen_visa', 'eingabe_abgeschlossen_visa', 'Eingabe Abgeschlossen Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_datum field
            //
            $column = new DateTimeViewColumn('eingabe_abgeschlossen_datum', 'eingabe_abgeschlossen_datum', 'Eingabe Abgeschlossen Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for kontrolliert_visa field
            //
            $column = new TextViewColumn('kontrolliert_visa', 'kontrolliert_visa', 'Kontrolliert Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for kontrolliert_datum field
            //
            $column = new DateTimeViewColumn('kontrolliert_datum', 'kontrolliert_datum', 'Kontrolliert Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for freigabe_visa field
            //
            $column = new TextViewColumn('freigabe_visa', 'freigabe_visa', 'Freigabe Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for freigabe_datum field
            //
            $column = new DateTimeViewColumn('freigabe_datum', 'freigabe_datum', 'Freigabe Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for created_visa field
            //
            $column = new TextViewColumn('created_visa', 'created_visa', 'Created Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for created_date field
            //
            $column = new DateTimeViewColumn('created_date', 'created_date', 'Created Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for updated_visa field
            //
            $column = new TextViewColumn('updated_visa', 'updated_visa', 'Updated Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for updated_date field
            //
            $column = new DateTimeViewColumn('updated_date', 'updated_date', 'Updated Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for organisation_id field
            //
            $editor = new DynamicCombobox('organisation_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_organisation_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_mixed'),
                    new StringField('anzeige_bimixed'),
                    new StringField('searchable_name'),
                    new StringField('anzeige_name_de', true),
                    new StringField('anzeige_name_fr'),
                    new StringField('name'),
                    new IntegerField('id', true),
                    new StringField('name_de', true),
                    new StringField('name_fr'),
                    new StringField('name_it'),
                    new StringField('uid'),
                    new StringField('ort'),
                    new StringField('abkuerzung_de'),
                    new StringField('alias_namen_de'),
                    new StringField('abkuerzung_fr'),
                    new StringField('alias_namen_fr'),
                    new StringField('abkuerzung_it'),
                    new StringField('alias_namen_it'),
                    new IntegerField('land_id'),
                    new IntegerField('interessenraum_id'),
                    new StringField('rechtsform'),
                    new StringField('rechtsform_handelsregister'),
                    new IntegerField('rechtsform_zefix'),
                    new StringField('typ', true),
                    new StringField('vernehmlassung', true),
                    new IntegerField('interessengruppe_id'),
                    new IntegerField('interessengruppe2_id'),
                    new IntegerField('interessengruppe3_id'),
                    new IntegerField('branche_id'),
                    new StringField('homepage'),
                    new StringField('handelsregister_url'),
                    new StringField('twitter_name'),
                    new StringField('beschreibung'),
                    new StringField('beschreibung_fr'),
                    new StringField('sekretariat'),
                    new StringField('adresse_strasse'),
                    new StringField('adresse_zusatz'),
                    new StringField('adresse_plz'),
                    new StringField('notizen'),
                    new DateTimeField('updated_by_import'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('searchable_name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Organisation', 'organisation_id', 'organisation_id_searchable_name', 'edit_organisation_id_searchable_name_search', $editor, $this->dataset, $lookupDataset, 'id', 'searchable_name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for art field
            //
            $editor = new ComboBox('art_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('mitglied von', 'Mitglied von / Membre de');
            $editor->addChoice('arbeitet fuer', 'Arbeitet für / Travail pour');
            $editor->addChoice('tochtergesellschaft von', 'Suborganisation von (Tochtergesellschaft, Zweigstelle) / Sous organisation de (filiale, succursale)');
            $editor->addChoice('partner von', 'Partner von / Partenaire de');
            $editor->addChoice('beteiligt an', 'Beteiligt an / Associé');
            $editColumn = new CustomEditColumn('Art', 'art', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ziel_organisation_id field
            //
            $editor = new DynamicCombobox('ziel_organisation_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_organisation_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_mixed'),
                    new StringField('anzeige_bimixed'),
                    new StringField('searchable_name'),
                    new StringField('anzeige_name_de', true),
                    new StringField('anzeige_name_fr'),
                    new StringField('name'),
                    new IntegerField('id', true),
                    new StringField('name_de', true),
                    new StringField('name_fr'),
                    new StringField('name_it'),
                    new StringField('uid'),
                    new StringField('ort'),
                    new StringField('abkuerzung_de'),
                    new StringField('alias_namen_de'),
                    new StringField('abkuerzung_fr'),
                    new StringField('alias_namen_fr'),
                    new StringField('abkuerzung_it'),
                    new StringField('alias_namen_it'),
                    new IntegerField('land_id'),
                    new IntegerField('interessenraum_id'),
                    new StringField('rechtsform'),
                    new StringField('rechtsform_handelsregister'),
                    new IntegerField('rechtsform_zefix'),
                    new StringField('typ', true),
                    new StringField('vernehmlassung', true),
                    new IntegerField('interessengruppe_id'),
                    new IntegerField('interessengruppe2_id'),
                    new IntegerField('interessengruppe3_id'),
                    new IntegerField('branche_id'),
                    new StringField('homepage'),
                    new StringField('handelsregister_url'),
                    new StringField('twitter_name'),
                    new StringField('beschreibung'),
                    new StringField('beschreibung_fr'),
                    new StringField('sekretariat'),
                    new StringField('adresse_strasse'),
                    new StringField('adresse_zusatz'),
                    new StringField('adresse_plz'),
                    new StringField('notizen'),
                    new DateTimeField('updated_by_import'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('searchable_name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Ziel Organisation', 'ziel_organisation_id', 'ziel_organisation_id_searchable_name', 'edit_ziel_organisation_id_searchable_name_search', $editor, $this->dataset, $lookupDataset, 'id', 'searchable_name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for beschreibung field
            //
            $editor = new TextEdit('beschreibung_edit');
            $editor->SetMaxLength(150);
            $editColumn = new CustomEditColumn('Beschreibung', 'beschreibung', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for beschreibung_fr field
            //
            $editor = new TextEdit('beschreibung_fr_edit');
            $editor->SetMaxLength(150);
            $editColumn = new CustomEditColumn('Beschreibung Fr', 'beschreibung_fr', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for quelle_url field
            //
            $editor = new TextEdit('quelle_url_edit');
            $editor->SetMaxLength(255);
            $editColumn = new CustomEditColumn('Quelle Url', 'quelle_url', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new UrlValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('UrlValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for quelle field
            //
            $editor = new TextEdit('quelle_edit');
            $editor->SetMaxLength(80);
            $editColumn = new CustomEditColumn('Quelle', 'quelle', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for von field
            //
            $editor = new DateTimeEdit('von_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Von', 'von', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for bis field
            //
            $editor = new DateTimeEdit('bis_edit', false, 'd.m.Y');
            $editColumn = new CustomEditColumn('Bis', 'bis', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for notizen field
            //
            $editor = new TextAreaEdit('notizen_edit', 50, 8);
            $editColumn = new CustomEditColumn('Notizen', 'notizen', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for eingabe_abgeschlossen_visa field
            //
            $editor = new TextEdit('eingabe_abgeschlossen_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Eingabe Abgeschlossen Visa', 'eingabe_abgeschlossen_visa', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for eingabe_abgeschlossen_datum field
            //
            $editor = new DateTimeEdit('eingabe_abgeschlossen_datum_edit', false, 'd.m.Y H:i:s');
            $editColumn = new CustomEditColumn('Eingabe Abgeschlossen Datum', 'eingabe_abgeschlossen_datum', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for kontrolliert_visa field
            //
            $editor = new TextEdit('kontrolliert_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Kontrolliert Visa', 'kontrolliert_visa', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for kontrolliert_datum field
            //
            $editor = new DateTimeEdit('kontrolliert_datum_edit', false, 'd.m.Y H:i:s');
            $editColumn = new CustomEditColumn('Kontrolliert Datum', 'kontrolliert_datum', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for freigabe_visa field
            //
            $editor = new TextEdit('freigabe_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Freigabe Visa', 'freigabe_visa', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for freigabe_datum field
            //
            $editor = new DateTimeEdit('freigabe_datum_edit', false, 'd.m.Y H:i:s');
            $editColumn = new CustomEditColumn('Freigabe Datum', 'freigabe_datum', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for created_visa field
            //
            $editor = new TextEdit('created_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Created Visa', 'created_visa', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for created_date field
            //
            $editor = new DateTimeEdit('created_date_edit', false, 'd.m.Y H:i:s');
            $editColumn = new CustomEditColumn('Created Date', 'created_date', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for updated_visa field
            //
            $editor = new TextEdit('updated_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Updated Visa', 'updated_visa', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for updated_date field
            //
            $editor = new DateTimeEdit('updated_date_edit', false, 'd.m.Y H:i:s');
            $editColumn = new CustomEditColumn('Updated Date', 'updated_date', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for organisation_id field
            //
            $editor = new DynamicCombobox('organisation_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_organisation_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_mixed'),
                    new StringField('anzeige_bimixed'),
                    new StringField('searchable_name'),
                    new StringField('anzeige_name_de', true),
                    new StringField('anzeige_name_fr'),
                    new StringField('name'),
                    new IntegerField('id', true),
                    new StringField('name_de', true),
                    new StringField('name_fr'),
                    new StringField('name_it'),
                    new StringField('uid'),
                    new StringField('ort'),
                    new StringField('abkuerzung_de'),
                    new StringField('alias_namen_de'),
                    new StringField('abkuerzung_fr'),
                    new StringField('alias_namen_fr'),
                    new StringField('abkuerzung_it'),
                    new StringField('alias_namen_it'),
                    new IntegerField('land_id'),
                    new IntegerField('interessenraum_id'),
                    new StringField('rechtsform'),
                    new StringField('rechtsform_handelsregister'),
                    new IntegerField('rechtsform_zefix'),
                    new StringField('typ', true),
                    new StringField('vernehmlassung', true),
                    new IntegerField('interessengruppe_id'),
                    new IntegerField('interessengruppe2_id'),
                    new IntegerField('interessengruppe3_id'),
                    new IntegerField('branche_id'),
                    new StringField('homepage'),
                    new StringField('handelsregister_url'),
                    new StringField('twitter_name'),
                    new StringField('beschreibung'),
                    new StringField('beschreibung_fr'),
                    new StringField('sekretariat'),
                    new StringField('adresse_strasse'),
                    new StringField('adresse_zusatz'),
                    new StringField('adresse_plz'),
                    new StringField('notizen'),
                    new DateTimeField('updated_by_import'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('searchable_name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Organisation', 'organisation_id', 'organisation_id_searchable_name', 'multi_edit_organisation_id_searchable_name_search', $editor, $this->dataset, $lookupDataset, 'id', 'searchable_name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for art field
            //
            $editor = new ComboBox('art_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('mitglied von', 'Mitglied von / Membre de');
            $editor->addChoice('arbeitet fuer', 'Arbeitet für / Travail pour');
            $editor->addChoice('tochtergesellschaft von', 'Suborganisation von (Tochtergesellschaft, Zweigstelle) / Sous organisation de (filiale, succursale)');
            $editor->addChoice('partner von', 'Partner von / Partenaire de');
            $editor->addChoice('beteiligt an', 'Beteiligt an / Associé');
            $editColumn = new CustomEditColumn('Art', 'art', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for ziel_organisation_id field
            //
            $editor = new DynamicCombobox('ziel_organisation_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_organisation_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_mixed'),
                    new StringField('anzeige_bimixed'),
                    new StringField('searchable_name'),
                    new StringField('anzeige_name_de', true),
                    new StringField('anzeige_name_fr'),
                    new StringField('name'),
                    new IntegerField('id', true),
                    new StringField('name_de', true),
                    new StringField('name_fr'),
                    new StringField('name_it'),
                    new StringField('uid'),
                    new StringField('ort'),
                    new StringField('abkuerzung_de'),
                    new StringField('alias_namen_de'),
                    new StringField('abkuerzung_fr'),
                    new StringField('alias_namen_fr'),
                    new StringField('abkuerzung_it'),
                    new StringField('alias_namen_it'),
                    new IntegerField('land_id'),
                    new IntegerField('interessenraum_id'),
                    new StringField('rechtsform'),
                    new StringField('rechtsform_handelsregister'),
                    new IntegerField('rechtsform_zefix'),
                    new StringField('typ', true),
                    new StringField('vernehmlassung', true),
                    new IntegerField('interessengruppe_id'),
                    new IntegerField('interessengruppe2_id'),
                    new IntegerField('interessengruppe3_id'),
                    new IntegerField('branche_id'),
                    new StringField('homepage'),
                    new StringField('handelsregister_url'),
                    new StringField('twitter_name'),
                    new StringField('beschreibung'),
                    new StringField('beschreibung_fr'),
                    new StringField('sekretariat'),
                    new StringField('adresse_strasse'),
                    new StringField('adresse_zusatz'),
                    new StringField('adresse_plz'),
                    new StringField('notizen'),
                    new DateTimeField('updated_by_import'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('searchable_name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Ziel Organisation', 'ziel_organisation_id', 'ziel_organisation_id_searchable_name', 'multi_edit_ziel_organisation_id_searchable_name_search', $editor, $this->dataset, $lookupDataset, 'id', 'searchable_name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for beschreibung field
            //
            $editor = new TextEdit('beschreibung_edit');
            $editor->SetMaxLength(150);
            $editColumn = new CustomEditColumn('Beschreibung', 'beschreibung', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for beschreibung_fr field
            //
            $editor = new TextEdit('beschreibung_fr_edit');
            $editor->SetMaxLength(150);
            $editColumn = new CustomEditColumn('Beschreibung Fr', 'beschreibung_fr', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for quelle_url field
            //
            $editor = new TextEdit('quelle_url_edit');
            $editor->SetMaxLength(255);
            $editColumn = new CustomEditColumn('Quelle Url', 'quelle_url', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new UrlValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('UrlValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for quelle_url_gueltig field
            //
            $editor = new TextEdit('quelle_url_gueltig_edit');
            $editColumn = new CustomEditColumn('Quelle Url Gueltig', 'quelle_url_gueltig', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for quelle field
            //
            $editor = new TextEdit('quelle_edit');
            $editor->SetMaxLength(80);
            $editColumn = new CustomEditColumn('Quelle', 'quelle', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for von field
            //
            $editor = new DateTimeEdit('von_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Von', 'von', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for bis field
            //
            $editor = new DateTimeEdit('bis_edit', false, 'd.m.Y');
            $editColumn = new CustomEditColumn('Bis', 'bis', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for notizen field
            //
            $editor = new TextAreaEdit('notizen_edit', 50, 8);
            $editColumn = new CustomEditColumn('Notizen', 'notizen', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for eingabe_abgeschlossen_visa field
            //
            $editor = new TextEdit('eingabe_abgeschlossen_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Eingabe Abgeschlossen Visa', 'eingabe_abgeschlossen_visa', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for eingabe_abgeschlossen_datum field
            //
            $editor = new DateTimeEdit('eingabe_abgeschlossen_datum_edit', false, 'd.m.Y H:i:s');
            $editColumn = new CustomEditColumn('Eingabe Abgeschlossen Datum', 'eingabe_abgeschlossen_datum', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for kontrolliert_visa field
            //
            $editor = new TextEdit('kontrolliert_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Kontrolliert Visa', 'kontrolliert_visa', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for kontrolliert_datum field
            //
            $editor = new DateTimeEdit('kontrolliert_datum_edit', false, 'd.m.Y H:i:s');
            $editColumn = new CustomEditColumn('Kontrolliert Datum', 'kontrolliert_datum', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for freigabe_visa field
            //
            $editor = new TextEdit('freigabe_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Freigabe Visa', 'freigabe_visa', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for freigabe_datum field
            //
            $editor = new DateTimeEdit('freigabe_datum_edit', false, 'd.m.Y H:i:s');
            $editColumn = new CustomEditColumn('Freigabe Datum', 'freigabe_datum', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for created_visa field
            //
            $editor = new TextEdit('created_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Created Visa', 'created_visa', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for created_date field
            //
            $editor = new DateTimeEdit('created_date_edit', false, 'd.m.Y H:i:s');
            $editColumn = new CustomEditColumn('Created Date', 'created_date', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for updated_visa field
            //
            $editor = new TextEdit('updated_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Updated Visa', 'updated_visa', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for updated_date field
            //
            $editor = new DateTimeEdit('updated_date_edit', false, 'd.m.Y H:i:s');
            $editColumn = new CustomEditColumn('Updated Date', 'updated_date', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for organisation_id field
            //
            $editor = new DynamicCombobox('organisation_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_organisation_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_mixed'),
                    new StringField('anzeige_bimixed'),
                    new StringField('searchable_name'),
                    new StringField('anzeige_name_de', true),
                    new StringField('anzeige_name_fr'),
                    new StringField('name'),
                    new IntegerField('id', true),
                    new StringField('name_de', true),
                    new StringField('name_fr'),
                    new StringField('name_it'),
                    new StringField('uid'),
                    new StringField('ort'),
                    new StringField('abkuerzung_de'),
                    new StringField('alias_namen_de'),
                    new StringField('abkuerzung_fr'),
                    new StringField('alias_namen_fr'),
                    new StringField('abkuerzung_it'),
                    new StringField('alias_namen_it'),
                    new IntegerField('land_id'),
                    new IntegerField('interessenraum_id'),
                    new StringField('rechtsform'),
                    new StringField('rechtsform_handelsregister'),
                    new IntegerField('rechtsform_zefix'),
                    new StringField('typ', true),
                    new StringField('vernehmlassung', true),
                    new IntegerField('interessengruppe_id'),
                    new IntegerField('interessengruppe2_id'),
                    new IntegerField('interessengruppe3_id'),
                    new IntegerField('branche_id'),
                    new StringField('homepage'),
                    new StringField('handelsregister_url'),
                    new StringField('twitter_name'),
                    new StringField('beschreibung'),
                    new StringField('beschreibung_fr'),
                    new StringField('sekretariat'),
                    new StringField('adresse_strasse'),
                    new StringField('adresse_zusatz'),
                    new StringField('adresse_plz'),
                    new StringField('notizen'),
                    new DateTimeField('updated_by_import'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('searchable_name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Organisation', 'organisation_id', 'organisation_id_searchable_name', 'insert_organisation_id_searchable_name_search', $editor, $this->dataset, $lookupDataset, 'id', 'searchable_name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for art field
            //
            $editor = new ComboBox('art_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->addChoice('mitglied von', 'Mitglied von / Membre de');
            $editor->addChoice('arbeitet fuer', 'Arbeitet für / Travail pour');
            $editor->addChoice('tochtergesellschaft von', 'Suborganisation von (Tochtergesellschaft, Zweigstelle) / Sous organisation de (filiale, succursale)');
            $editor->addChoice('partner von', 'Partner von / Partenaire de');
            $editor->addChoice('beteiligt an', 'Beteiligt an / Associé');
            $editColumn = new CustomEditColumn('Art', 'art', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ziel_organisation_id field
            //
            $editor = new DynamicCombobox('ziel_organisation_id_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_organisation_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_mixed'),
                    new StringField('anzeige_bimixed'),
                    new StringField('searchable_name'),
                    new StringField('anzeige_name_de', true),
                    new StringField('anzeige_name_fr'),
                    new StringField('name'),
                    new IntegerField('id', true),
                    new StringField('name_de', true),
                    new StringField('name_fr'),
                    new StringField('name_it'),
                    new StringField('uid'),
                    new StringField('ort'),
                    new StringField('abkuerzung_de'),
                    new StringField('alias_namen_de'),
                    new StringField('abkuerzung_fr'),
                    new StringField('alias_namen_fr'),
                    new StringField('abkuerzung_it'),
                    new StringField('alias_namen_it'),
                    new IntegerField('land_id'),
                    new IntegerField('interessenraum_id'),
                    new StringField('rechtsform'),
                    new StringField('rechtsform_handelsregister'),
                    new IntegerField('rechtsform_zefix'),
                    new StringField('typ', true),
                    new StringField('vernehmlassung', true),
                    new IntegerField('interessengruppe_id'),
                    new IntegerField('interessengruppe2_id'),
                    new IntegerField('interessengruppe3_id'),
                    new IntegerField('branche_id'),
                    new StringField('homepage'),
                    new StringField('handelsregister_url'),
                    new StringField('twitter_name'),
                    new StringField('beschreibung'),
                    new StringField('beschreibung_fr'),
                    new StringField('sekretariat'),
                    new StringField('adresse_strasse'),
                    new StringField('adresse_zusatz'),
                    new StringField('adresse_plz'),
                    new StringField('notizen'),
                    new DateTimeField('updated_by_import'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('searchable_name', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Ziel Organisation', 'ziel_organisation_id', 'ziel_organisation_id_searchable_name', 'insert_ziel_organisation_id_searchable_name_search', $editor, $this->dataset, $lookupDataset, 'id', 'searchable_name', '');
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for beschreibung field
            //
            $editor = new TextEdit('beschreibung_edit');
            $editor->SetMaxLength(150);
            $editColumn = new CustomEditColumn('Beschreibung', 'beschreibung', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for beschreibung_fr field
            //
            $editor = new TextEdit('beschreibung_fr_edit');
            $editor->SetMaxLength(150);
            $editColumn = new CustomEditColumn('Beschreibung Fr', 'beschreibung_fr', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for quelle_url field
            //
            $editor = new TextEdit('quelle_url_edit');
            $editor->SetMaxLength(255);
            $editColumn = new CustomEditColumn('Quelle Url', 'quelle_url', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $validator = new UrlValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('UrlValidationMessage'), $editColumn->GetCaption()));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for quelle field
            //
            $editor = new TextEdit('quelle_edit');
            $editor->SetMaxLength(80);
            $editColumn = new CustomEditColumn('Quelle', 'quelle', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for von field
            //
            $editor = new DateTimeEdit('von_edit', false, 'Y-m-d H:i:s');
            $editColumn = new CustomEditColumn('Von', 'von', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for bis field
            //
            $editor = new DateTimeEdit('bis_edit', false, 'd.m.Y');
            $editColumn = new CustomEditColumn('Bis', 'bis', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for notizen field
            //
            $editor = new TextAreaEdit('notizen_edit', 50, 8);
            $editColumn = new CustomEditColumn('Notizen', 'notizen', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for created_visa field
            //
            $editor = new TextEdit('created_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Created Visa', 'created_visa', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for created_date field
            //
            $editor = new DateTimeEdit('created_date_edit', false, 'd.m.Y H:i:s');
            $editColumn = new CustomEditColumn('Created Date', 'created_date', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for updated_visa field
            //
            $editor = new TextEdit('updated_visa_edit');
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Updated Visa', 'updated_visa', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for updated_date field
            //
            $editor = new DateTimeEdit('updated_date_edit', false, 'd.m.Y H:i:s');
            $editColumn = new CustomEditColumn('Updated Date', 'updated_date', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            $grid->SetShowAddButton(true && $this->GetSecurityInfo()->HasAddGrant());
        }
    
        private function AddMultiUploadColumn(Grid $grid)
        {
    
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for searchable_name field
            //
            $column = new TextViewColumn('organisation_id', 'organisation_id_searchable_name', 'Organisation', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('organisation.php?operation=view&pk0=%organisation_id%');
            $column->setTarget('_self');
            $grid->AddPrintColumn($column);
            
            //
            // View column for art field
            //
            $column = new TextViewColumn('art', 'art', 'Art', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for searchable_name field
            //
            $column = new TextViewColumn('ziel_organisation_id', 'ziel_organisation_id_searchable_name', 'Ziel Organisation', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('organisation.php?operation=view&pk0=%ziel_organisation_id%');
            $column->setTarget('_self');
            $grid->AddPrintColumn($column);
            
            //
            // View column for beschreibung field
            //
            $column = new TextViewColumn('beschreibung', 'beschreibung', 'Beschreibung', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('organisation_beziehungGrid_beschreibung_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for beschreibung_fr field
            //
            $column = new TextViewColumn('beschreibung_fr', 'beschreibung_fr', 'Beschreibung Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('organisation_beziehungGrid_beschreibung_fr_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for quelle_url field
            //
            $column = new TextViewColumn('quelle_url', 'quelle_url', 'Quelle Url', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('%quelle_url%');
            $column->setTarget('');
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('organisation_beziehungGrid_quelle_url_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for quelle field
            //
            $column = new TextViewColumn('quelle', 'quelle', 'Quelle', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('organisation_beziehungGrid_quelle_handler_print');
            $grid->AddPrintColumn($column);
            
            //
            // View column for von field
            //
            $column = new DateTimeViewColumn('von', 'von', 'Von', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $grid->AddPrintColumn($column);
            
            //
            // View column for bis field
            //
            $column = new DateTimeViewColumn('bis', 'bis', 'Bis', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $grid->AddPrintColumn($column);
            
            //
            // View column for notizen field
            //
            $column = new TextViewColumn('notizen', 'notizen', 'Notizen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('organisation_beziehungGrid_notizen_handler_print');
            $column->SetReplaceLFByBR(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_visa field
            //
            $column = new TextViewColumn('eingabe_abgeschlossen_visa', 'eingabe_abgeschlossen_visa', 'Eingabe Abgeschlossen Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_datum field
            //
            $column = new DateTimeViewColumn('eingabe_abgeschlossen_datum', 'eingabe_abgeschlossen_datum', 'Eingabe Abgeschlossen Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for kontrolliert_visa field
            //
            $column = new TextViewColumn('kontrolliert_visa', 'kontrolliert_visa', 'Kontrolliert Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for kontrolliert_datum field
            //
            $column = new DateTimeViewColumn('kontrolliert_datum', 'kontrolliert_datum', 'Kontrolliert Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for freigabe_visa field
            //
            $column = new TextViewColumn('freigabe_visa', 'freigabe_visa', 'Freigabe Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for freigabe_datum field
            //
            $column = new DateTimeViewColumn('freigabe_datum', 'freigabe_datum', 'Freigabe Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for created_visa field
            //
            $column = new TextViewColumn('created_visa', 'created_visa', 'Created Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for created_date field
            //
            $column = new DateTimeViewColumn('created_date', 'created_date', 'Created Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddPrintColumn($column);
            
            //
            // View column for updated_visa field
            //
            $column = new TextViewColumn('updated_visa', 'updated_visa', 'Updated Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for updated_date field
            //
            $column = new DateTimeViewColumn('updated_date', 'updated_date', 'Updated Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for searchable_name field
            //
            $column = new TextViewColumn('organisation_id', 'organisation_id_searchable_name', 'Organisation', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('organisation.php?operation=view&pk0=%organisation_id%');
            $column->setTarget('_self');
            $grid->AddExportColumn($column);
            
            //
            // View column for art field
            //
            $column = new TextViewColumn('art', 'art', 'Art', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for searchable_name field
            //
            $column = new TextViewColumn('ziel_organisation_id', 'ziel_organisation_id_searchable_name', 'Ziel Organisation', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('organisation.php?operation=view&pk0=%ziel_organisation_id%');
            $column->setTarget('_self');
            $grid->AddExportColumn($column);
            
            //
            // View column for beschreibung field
            //
            $column = new TextViewColumn('beschreibung', 'beschreibung', 'Beschreibung', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('organisation_beziehungGrid_beschreibung_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for beschreibung_fr field
            //
            $column = new TextViewColumn('beschreibung_fr', 'beschreibung_fr', 'Beschreibung Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('organisation_beziehungGrid_beschreibung_fr_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for quelle_url field
            //
            $column = new TextViewColumn('quelle_url', 'quelle_url', 'Quelle Url', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('%quelle_url%');
            $column->setTarget('');
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('organisation_beziehungGrid_quelle_url_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for quelle field
            //
            $column = new TextViewColumn('quelle', 'quelle', 'Quelle', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('organisation_beziehungGrid_quelle_handler_export');
            $grid->AddExportColumn($column);
            
            //
            // View column for von field
            //
            $column = new DateTimeViewColumn('von', 'von', 'Von', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $grid->AddExportColumn($column);
            
            //
            // View column for bis field
            //
            $column = new DateTimeViewColumn('bis', 'bis', 'Bis', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $grid->AddExportColumn($column);
            
            //
            // View column for notizen field
            //
            $column = new TextViewColumn('notizen', 'notizen', 'Notizen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('organisation_beziehungGrid_notizen_handler_export');
            $column->SetReplaceLFByBR(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_visa field
            //
            $column = new TextViewColumn('eingabe_abgeschlossen_visa', 'eingabe_abgeschlossen_visa', 'Eingabe Abgeschlossen Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_datum field
            //
            $column = new DateTimeViewColumn('eingabe_abgeschlossen_datum', 'eingabe_abgeschlossen_datum', 'Eingabe Abgeschlossen Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for kontrolliert_visa field
            //
            $column = new TextViewColumn('kontrolliert_visa', 'kontrolliert_visa', 'Kontrolliert Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for kontrolliert_datum field
            //
            $column = new DateTimeViewColumn('kontrolliert_datum', 'kontrolliert_datum', 'Kontrolliert Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for freigabe_visa field
            //
            $column = new TextViewColumn('freigabe_visa', 'freigabe_visa', 'Freigabe Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for freigabe_datum field
            //
            $column = new DateTimeViewColumn('freigabe_datum', 'freigabe_datum', 'Freigabe Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for created_visa field
            //
            $column = new TextViewColumn('created_visa', 'created_visa', 'Created Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for created_date field
            //
            $column = new DateTimeViewColumn('created_date', 'created_date', 'Created Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddExportColumn($column);
            
            //
            // View column for updated_visa field
            //
            $column = new TextViewColumn('updated_visa', 'updated_visa', 'Updated Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for updated_date field
            //
            $column = new DateTimeViewColumn('updated_date', 'updated_date', 'Updated Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for searchable_name field
            //
            $column = new TextViewColumn('organisation_id', 'organisation_id_searchable_name', 'Organisation', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('organisation.php?operation=view&pk0=%organisation_id%');
            $column->setTarget('_self');
            $grid->AddCompareColumn($column);
            
            //
            // View column for art field
            //
            $column = new TextViewColumn('art', 'art', 'Art', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for searchable_name field
            //
            $column = new TextViewColumn('ziel_organisation_id', 'ziel_organisation_id_searchable_name', 'Ziel Organisation', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('organisation.php?operation=view&pk0=%ziel_organisation_id%');
            $column->setTarget('_self');
            $grid->AddCompareColumn($column);
            
            //
            // View column for beschreibung field
            //
            $column = new TextViewColumn('beschreibung', 'beschreibung', 'Beschreibung', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('organisation_beziehungGrid_beschreibung_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for beschreibung_fr field
            //
            $column = new TextViewColumn('beschreibung_fr', 'beschreibung_fr', 'Beschreibung Fr', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('organisation_beziehungGrid_beschreibung_fr_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for quelle_url field
            //
            $column = new TextViewColumn('quelle_url', 'quelle_url', 'Quelle Url', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('%quelle_url%');
            $column->setTarget('');
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('organisation_beziehungGrid_quelle_url_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for quelle_url_gueltig field
            //
            $column = new TextViewColumn('quelle_url_gueltig', 'quelle_url_gueltig', 'Quelle Url Gueltig', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for quelle field
            //
            $column = new TextViewColumn('quelle', 'quelle', 'Quelle', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('organisation_beziehungGrid_quelle_handler_compare');
            $grid->AddCompareColumn($column);
            
            //
            // View column for von field
            //
            $column = new DateTimeViewColumn('von', 'von', 'Von', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $grid->AddCompareColumn($column);
            
            //
            // View column for bis field
            //
            $column = new DateTimeViewColumn('bis', 'bis', 'Bis', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y');
            $grid->AddCompareColumn($column);
            
            //
            // View column for notizen field
            //
            $column = new TextViewColumn('notizen', 'notizen', 'Notizen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('organisation_beziehungGrid_notizen_handler_compare');
            $column->SetReplaceLFByBR(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_visa field
            //
            $column = new TextViewColumn('eingabe_abgeschlossen_visa', 'eingabe_abgeschlossen_visa', 'Eingabe Abgeschlossen Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for eingabe_abgeschlossen_datum field
            //
            $column = new DateTimeViewColumn('eingabe_abgeschlossen_datum', 'eingabe_abgeschlossen_datum', 'Eingabe Abgeschlossen Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for kontrolliert_visa field
            //
            $column = new TextViewColumn('kontrolliert_visa', 'kontrolliert_visa', 'Kontrolliert Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for kontrolliert_datum field
            //
            $column = new DateTimeViewColumn('kontrolliert_datum', 'kontrolliert_datum', 'Kontrolliert Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for freigabe_visa field
            //
            $column = new TextViewColumn('freigabe_visa', 'freigabe_visa', 'Freigabe Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for freigabe_datum field
            //
            $column = new DateTimeViewColumn('freigabe_datum', 'freigabe_datum', 'Freigabe Datum', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for created_visa field
            //
            $column = new TextViewColumn('created_visa', 'created_visa', 'Created Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for created_date field
            //
            $column = new DateTimeViewColumn('created_date', 'created_date', 'Created Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddCompareColumn($column);
            
            //
            // View column for updated_visa field
            //
            $column = new TextViewColumn('updated_visa', 'updated_visa', 'Updated Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for updated_date field
            //
            $column = new DateTimeViewColumn('updated_date', 'updated_date', 'Updated Date', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $grid->AddCompareColumn($column);
        }
    
        private function AddCompareHeaderColumns(Grid $grid)
        {
    
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        public function isFilterConditionRequired()
        {
            return false;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
    		$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
        protected function GetEnableModalGridDelete() { return true; }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset);
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(true);
            else
               $result->SetAllowDeleteSelected(false);   
            
            ApplyCommonPageSettings($this, $result);
            
            $result->SetUseImagesForActions(true);
            $defaultSortedColumns = array();
            $defaultSortedColumns[] = new SortColumn('updated_date', 'DESC');
            $result->setDefaultOrdering($defaultSortedColumns);
            $result->SetUseFixedHeader(true);
            $result->SetShowLineNumbers(true);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(true);
            $result->setAllowCompare(true);
            $this->AddCompareHeaderColumns($result);
            $this->AddCompareColumns($result);
            $result->setMultiEditAllowed($this->GetSecurityInfo()->HasEditGrant() && true);
            $result->setIncludeAllFieldsForMultiEditByDefault(false);
            $result->setTableBordered(true);
            $result->setTableCondensed(true);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddMultiEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
            $this->AddMultiUploadColumn($result);
    
    
            $this->SetViewFormTitle('Organisation Beziehung "%organisation_id%" - "%ziel_organisation_id%"');
            $this->SetEditFormTitle('Edit Organisation Beziehung "%organisation_id%" - "%ziel_organisation_id%"');
            $this->SetInsertFormTitle('Add new Organisation Beziehung');
            $this->SetShowPageList(true);
            $this->SetShowTopPageNavigator(false);
            $this->SetShowBottomPageNavigator(true);
            $this->setPrintListAvailable(true);
            $this->setPrintListRecordAvailable(false);
            $this->setPrintOneRecordAvailable(true);
            $this->setAllowPrintSelectedRecords(true);
            $this->setExportListAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportSelectedRecordsAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportListRecordAvailable(array());
            $this->setExportOneRecordAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setDescription('' . $GLOBALS["edit_header_message"] /*afterburner*/  . '
            
            <div class="wiki-table-help">
            <p>Beziehungen wie <em>"Mitglied von"</em> und <em>"arbeitet für"</em> zwischen Organisationen können erfasst werden.
            </p>
            
            <div class="clearfix rbox note"><div class="rbox-title"><img src="' . util_data_uri('img/icons/information.png') . '" alt="Hinweis" title="Hinweis" class="icon" width="16" height="16"><span>Hinweis</span></div><div class="rbox-data">Die richtige Angabe von Organisation und Zielorganisation ist wichtig. Eine Organisation bezieht sich auf eine Zielorganisation.</div></div>
            <p>Beispiel: Novartis ist Mitglied von Interpharma.
            </p>
            <ul><li> Organisation = Novartis
            </li><li> Beziehungsart = Mitglied von
            </li><li> Zielorganisation = Interpharma
            </li></ul><p>
            <br>Beispiel: PR-Büro X arbeitet für Novartis.
            </p>
            <ul><li> Organisation = PR-Büro X
            </li><li> Beziehungsart = arbeitet für
            </li><li> Zielorganisation = Novartis
            </li></ul></div>
            
            ' . $GLOBALS["edit_general_hint"] /*afterburner*/  . '');
            $this->setShowFormErrorsOnTop(true);
    
            return $result;
        }
     
        protected function setClientSideEvents(Grid $grid) {
    
        }
    
        protected function doRegisterHandlers() {
            //
            // View column for beschreibung field
            //
            $column = new TextViewColumn('beschreibung', 'beschreibung', 'Beschreibung', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'organisation_beziehungGrid_beschreibung_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for beschreibung_fr field
            //
            $column = new TextViewColumn('beschreibung_fr', 'beschreibung_fr', 'Beschreibung Fr', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'organisation_beziehungGrid_beschreibung_fr_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for quelle_url field
            //
            $column = new TextViewColumn('quelle_url', 'quelle_url', 'Quelle Url', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('%quelle_url%');
            $column->setTarget('');
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'organisation_beziehungGrid_quelle_url_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for quelle field
            //
            $column = new TextViewColumn('quelle', 'quelle', 'Quelle', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'organisation_beziehungGrid_quelle_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notizen field
            //
            $column = new TextViewColumn('notizen', 'notizen', 'Notizen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetReplaceLFByBR(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'organisation_beziehungGrid_notizen_handler_list', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for beschreibung field
            //
            $column = new TextViewColumn('beschreibung', 'beschreibung', 'Beschreibung', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'organisation_beziehungGrid_beschreibung_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for beschreibung_fr field
            //
            $column = new TextViewColumn('beschreibung_fr', 'beschreibung_fr', 'Beschreibung Fr', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'organisation_beziehungGrid_beschreibung_fr_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for quelle_url field
            //
            $column = new TextViewColumn('quelle_url', 'quelle_url', 'Quelle Url', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('%quelle_url%');
            $column->setTarget('');
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'organisation_beziehungGrid_quelle_url_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for quelle field
            //
            $column = new TextViewColumn('quelle', 'quelle', 'Quelle', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'organisation_beziehungGrid_quelle_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notizen field
            //
            $column = new TextViewColumn('notizen', 'notizen', 'Notizen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetReplaceLFByBR(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'organisation_beziehungGrid_notizen_handler_print', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for beschreibung field
            //
            $column = new TextViewColumn('beschreibung', 'beschreibung', 'Beschreibung', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'organisation_beziehungGrid_beschreibung_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for beschreibung_fr field
            //
            $column = new TextViewColumn('beschreibung_fr', 'beschreibung_fr', 'Beschreibung Fr', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'organisation_beziehungGrid_beschreibung_fr_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for quelle_url field
            //
            $column = new TextViewColumn('quelle_url', 'quelle_url', 'Quelle Url', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('%quelle_url%');
            $column->setTarget('');
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'organisation_beziehungGrid_quelle_url_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for quelle field
            //
            $column = new TextViewColumn('quelle', 'quelle', 'Quelle', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'organisation_beziehungGrid_quelle_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notizen field
            //
            $column = new TextViewColumn('notizen', 'notizen', 'Notizen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetReplaceLFByBR(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'organisation_beziehungGrid_notizen_handler_compare', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_organisation_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_mixed'),
                    new StringField('anzeige_bimixed'),
                    new StringField('searchable_name'),
                    new StringField('anzeige_name_de', true),
                    new StringField('anzeige_name_fr'),
                    new StringField('name'),
                    new IntegerField('id', true),
                    new StringField('name_de', true),
                    new StringField('name_fr'),
                    new StringField('name_it'),
                    new StringField('uid'),
                    new StringField('ort'),
                    new StringField('abkuerzung_de'),
                    new StringField('alias_namen_de'),
                    new StringField('abkuerzung_fr'),
                    new StringField('alias_namen_fr'),
                    new StringField('abkuerzung_it'),
                    new StringField('alias_namen_it'),
                    new IntegerField('land_id'),
                    new IntegerField('interessenraum_id'),
                    new StringField('rechtsform'),
                    new StringField('rechtsform_handelsregister'),
                    new IntegerField('rechtsform_zefix'),
                    new StringField('typ', true),
                    new StringField('vernehmlassung', true),
                    new IntegerField('interessengruppe_id'),
                    new IntegerField('interessengruppe2_id'),
                    new IntegerField('interessengruppe3_id'),
                    new IntegerField('branche_id'),
                    new StringField('homepage'),
                    new StringField('handelsregister_url'),
                    new StringField('twitter_name'),
                    new StringField('beschreibung'),
                    new StringField('beschreibung_fr'),
                    new StringField('sekretariat'),
                    new StringField('adresse_strasse'),
                    new StringField('adresse_zusatz'),
                    new StringField('adresse_plz'),
                    new StringField('notizen'),
                    new DateTimeField('updated_by_import'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('searchable_name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_organisation_id_searchable_name_search', 'id', 'searchable_name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_organisation_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_mixed'),
                    new StringField('anzeige_bimixed'),
                    new StringField('searchable_name'),
                    new StringField('anzeige_name_de', true),
                    new StringField('anzeige_name_fr'),
                    new StringField('name'),
                    new IntegerField('id', true),
                    new StringField('name_de', true),
                    new StringField('name_fr'),
                    new StringField('name_it'),
                    new StringField('uid'),
                    new StringField('ort'),
                    new StringField('abkuerzung_de'),
                    new StringField('alias_namen_de'),
                    new StringField('abkuerzung_fr'),
                    new StringField('alias_namen_fr'),
                    new StringField('abkuerzung_it'),
                    new StringField('alias_namen_it'),
                    new IntegerField('land_id'),
                    new IntegerField('interessenraum_id'),
                    new StringField('rechtsform'),
                    new StringField('rechtsform_handelsregister'),
                    new IntegerField('rechtsform_zefix'),
                    new StringField('typ', true),
                    new StringField('vernehmlassung', true),
                    new IntegerField('interessengruppe_id'),
                    new IntegerField('interessengruppe2_id'),
                    new IntegerField('interessengruppe3_id'),
                    new IntegerField('branche_id'),
                    new StringField('homepage'),
                    new StringField('handelsregister_url'),
                    new StringField('twitter_name'),
                    new StringField('beschreibung'),
                    new StringField('beschreibung_fr'),
                    new StringField('sekretariat'),
                    new StringField('adresse_strasse'),
                    new StringField('adresse_zusatz'),
                    new StringField('adresse_plz'),
                    new StringField('notizen'),
                    new DateTimeField('updated_by_import'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('searchable_name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_ziel_organisation_id_searchable_name_search', 'id', 'searchable_name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_organisation_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_mixed'),
                    new StringField('anzeige_bimixed'),
                    new StringField('searchable_name'),
                    new StringField('anzeige_name_de', true),
                    new StringField('anzeige_name_fr'),
                    new StringField('name'),
                    new IntegerField('id', true),
                    new StringField('name_de', true),
                    new StringField('name_fr'),
                    new StringField('name_it'),
                    new StringField('uid'),
                    new StringField('ort'),
                    new StringField('abkuerzung_de'),
                    new StringField('alias_namen_de'),
                    new StringField('abkuerzung_fr'),
                    new StringField('alias_namen_fr'),
                    new StringField('abkuerzung_it'),
                    new StringField('alias_namen_it'),
                    new IntegerField('land_id'),
                    new IntegerField('interessenraum_id'),
                    new StringField('rechtsform'),
                    new StringField('rechtsform_handelsregister'),
                    new IntegerField('rechtsform_zefix'),
                    new StringField('typ', true),
                    new StringField('vernehmlassung', true),
                    new IntegerField('interessengruppe_id'),
                    new IntegerField('interessengruppe2_id'),
                    new IntegerField('interessengruppe3_id'),
                    new IntegerField('branche_id'),
                    new StringField('homepage'),
                    new StringField('handelsregister_url'),
                    new StringField('twitter_name'),
                    new StringField('beschreibung'),
                    new StringField('beschreibung_fr'),
                    new StringField('sekretariat'),
                    new StringField('adresse_strasse'),
                    new StringField('adresse_zusatz'),
                    new StringField('adresse_plz'),
                    new StringField('notizen'),
                    new DateTimeField('updated_by_import'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('searchable_name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_organisation_id_searchable_name_search', 'id', 'searchable_name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_organisation_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_mixed'),
                    new StringField('anzeige_bimixed'),
                    new StringField('searchable_name'),
                    new StringField('anzeige_name_de', true),
                    new StringField('anzeige_name_fr'),
                    new StringField('name'),
                    new IntegerField('id', true),
                    new StringField('name_de', true),
                    new StringField('name_fr'),
                    new StringField('name_it'),
                    new StringField('uid'),
                    new StringField('ort'),
                    new StringField('abkuerzung_de'),
                    new StringField('alias_namen_de'),
                    new StringField('abkuerzung_fr'),
                    new StringField('alias_namen_fr'),
                    new StringField('abkuerzung_it'),
                    new StringField('alias_namen_it'),
                    new IntegerField('land_id'),
                    new IntegerField('interessenraum_id'),
                    new StringField('rechtsform'),
                    new StringField('rechtsform_handelsregister'),
                    new IntegerField('rechtsform_zefix'),
                    new StringField('typ', true),
                    new StringField('vernehmlassung', true),
                    new IntegerField('interessengruppe_id'),
                    new IntegerField('interessengruppe2_id'),
                    new IntegerField('interessengruppe3_id'),
                    new IntegerField('branche_id'),
                    new StringField('homepage'),
                    new StringField('handelsregister_url'),
                    new StringField('twitter_name'),
                    new StringField('beschreibung'),
                    new StringField('beschreibung_fr'),
                    new StringField('sekretariat'),
                    new StringField('adresse_strasse'),
                    new StringField('adresse_zusatz'),
                    new StringField('adresse_plz'),
                    new StringField('notizen'),
                    new DateTimeField('updated_by_import'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('searchable_name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_ziel_organisation_id_searchable_name_search', 'id', 'searchable_name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for beschreibung field
            //
            $column = new TextViewColumn('beschreibung', 'beschreibung', 'Beschreibung', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'organisation_beziehungGrid_beschreibung_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for beschreibung_fr field
            //
            $column = new TextViewColumn('beschreibung_fr', 'beschreibung_fr', 'Beschreibung Fr', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'organisation_beziehungGrid_beschreibung_fr_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for quelle_url field
            //
            $column = new TextViewColumn('quelle_url', 'quelle_url', 'Quelle Url', $this->dataset);
            $column->SetOrderable(true);
            $column->setHrefTemplate('%quelle_url%');
            $column->setTarget('');
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'organisation_beziehungGrid_quelle_url_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for quelle field
            //
            $column = new TextViewColumn('quelle', 'quelle', 'Quelle', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'organisation_beziehungGrid_quelle_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            //
            // View column for notizen field
            //
            $column = new TextViewColumn('notizen', 'notizen', 'Notizen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetReplaceLFByBR(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'organisation_beziehungGrid_notizen_handler_view', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_organisation_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_mixed'),
                    new StringField('anzeige_bimixed'),
                    new StringField('searchable_name'),
                    new StringField('anzeige_name_de', true),
                    new StringField('anzeige_name_fr'),
                    new StringField('name'),
                    new IntegerField('id', true),
                    new StringField('name_de', true),
                    new StringField('name_fr'),
                    new StringField('name_it'),
                    new StringField('uid'),
                    new StringField('ort'),
                    new StringField('abkuerzung_de'),
                    new StringField('alias_namen_de'),
                    new StringField('abkuerzung_fr'),
                    new StringField('alias_namen_fr'),
                    new StringField('abkuerzung_it'),
                    new StringField('alias_namen_it'),
                    new IntegerField('land_id'),
                    new IntegerField('interessenraum_id'),
                    new StringField('rechtsform'),
                    new StringField('rechtsform_handelsregister'),
                    new IntegerField('rechtsform_zefix'),
                    new StringField('typ', true),
                    new StringField('vernehmlassung', true),
                    new IntegerField('interessengruppe_id'),
                    new IntegerField('interessengruppe2_id'),
                    new IntegerField('interessengruppe3_id'),
                    new IntegerField('branche_id'),
                    new StringField('homepage'),
                    new StringField('handelsregister_url'),
                    new StringField('twitter_name'),
                    new StringField('beschreibung'),
                    new StringField('beschreibung_fr'),
                    new StringField('sekretariat'),
                    new StringField('adresse_strasse'),
                    new StringField('adresse_zusatz'),
                    new StringField('adresse_plz'),
                    new StringField('notizen'),
                    new DateTimeField('updated_by_import'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('searchable_name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_organisation_id_searchable_name_search', 'id', 'searchable_name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_organisation_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_mixed'),
                    new StringField('anzeige_bimixed'),
                    new StringField('searchable_name'),
                    new StringField('anzeige_name_de', true),
                    new StringField('anzeige_name_fr'),
                    new StringField('name'),
                    new IntegerField('id', true),
                    new StringField('name_de', true),
                    new StringField('name_fr'),
                    new StringField('name_it'),
                    new StringField('uid'),
                    new StringField('ort'),
                    new StringField('abkuerzung_de'),
                    new StringField('alias_namen_de'),
                    new StringField('abkuerzung_fr'),
                    new StringField('alias_namen_fr'),
                    new StringField('abkuerzung_it'),
                    new StringField('alias_namen_it'),
                    new IntegerField('land_id'),
                    new IntegerField('interessenraum_id'),
                    new StringField('rechtsform'),
                    new StringField('rechtsform_handelsregister'),
                    new IntegerField('rechtsform_zefix'),
                    new StringField('typ', true),
                    new StringField('vernehmlassung', true),
                    new IntegerField('interessengruppe_id'),
                    new IntegerField('interessengruppe2_id'),
                    new IntegerField('interessengruppe3_id'),
                    new IntegerField('branche_id'),
                    new StringField('homepage'),
                    new StringField('handelsregister_url'),
                    new StringField('twitter_name'),
                    new StringField('beschreibung'),
                    new StringField('beschreibung_fr'),
                    new StringField('sekretariat'),
                    new StringField('adresse_strasse'),
                    new StringField('adresse_zusatz'),
                    new StringField('adresse_plz'),
                    new StringField('notizen'),
                    new DateTimeField('updated_by_import'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('searchable_name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_ziel_organisation_id_searchable_name_search', 'id', 'searchable_name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_organisation_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_mixed'),
                    new StringField('anzeige_bimixed'),
                    new StringField('searchable_name'),
                    new StringField('anzeige_name_de', true),
                    new StringField('anzeige_name_fr'),
                    new StringField('name'),
                    new IntegerField('id', true),
                    new StringField('name_de', true),
                    new StringField('name_fr'),
                    new StringField('name_it'),
                    new StringField('uid'),
                    new StringField('ort'),
                    new StringField('abkuerzung_de'),
                    new StringField('alias_namen_de'),
                    new StringField('abkuerzung_fr'),
                    new StringField('alias_namen_fr'),
                    new StringField('abkuerzung_it'),
                    new StringField('alias_namen_it'),
                    new IntegerField('land_id'),
                    new IntegerField('interessenraum_id'),
                    new StringField('rechtsform'),
                    new StringField('rechtsform_handelsregister'),
                    new IntegerField('rechtsform_zefix'),
                    new StringField('typ', true),
                    new StringField('vernehmlassung', true),
                    new IntegerField('interessengruppe_id'),
                    new IntegerField('interessengruppe2_id'),
                    new IntegerField('interessengruppe3_id'),
                    new IntegerField('branche_id'),
                    new StringField('homepage'),
                    new StringField('handelsregister_url'),
                    new StringField('twitter_name'),
                    new StringField('beschreibung'),
                    new StringField('beschreibung_fr'),
                    new StringField('sekretariat'),
                    new StringField('adresse_strasse'),
                    new StringField('adresse_zusatz'),
                    new StringField('adresse_plz'),
                    new StringField('notizen'),
                    new DateTimeField('updated_by_import'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('searchable_name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_organisation_id_searchable_name_search', 'id', 'searchable_name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`v_organisation_simple`');
            $lookupDataset->addFields(
                array(
                    new StringField('anzeige_name'),
                    new StringField('anzeige_mixed'),
                    new StringField('anzeige_bimixed'),
                    new StringField('searchable_name'),
                    new StringField('anzeige_name_de', true),
                    new StringField('anzeige_name_fr'),
                    new StringField('name'),
                    new IntegerField('id', true),
                    new StringField('name_de', true),
                    new StringField('name_fr'),
                    new StringField('name_it'),
                    new StringField('uid'),
                    new StringField('ort'),
                    new StringField('abkuerzung_de'),
                    new StringField('alias_namen_de'),
                    new StringField('abkuerzung_fr'),
                    new StringField('alias_namen_fr'),
                    new StringField('abkuerzung_it'),
                    new StringField('alias_namen_it'),
                    new IntegerField('land_id'),
                    new IntegerField('interessenraum_id'),
                    new StringField('rechtsform'),
                    new StringField('rechtsform_handelsregister'),
                    new IntegerField('rechtsform_zefix'),
                    new StringField('typ', true),
                    new StringField('vernehmlassung', true),
                    new IntegerField('interessengruppe_id'),
                    new IntegerField('interessengruppe2_id'),
                    new IntegerField('interessengruppe3_id'),
                    new IntegerField('branche_id'),
                    new StringField('homepage'),
                    new StringField('handelsregister_url'),
                    new StringField('twitter_name'),
                    new StringField('beschreibung'),
                    new StringField('beschreibung_fr'),
                    new StringField('sekretariat'),
                    new StringField('adresse_strasse'),
                    new StringField('adresse_zusatz'),
                    new StringField('adresse_plz'),
                    new StringField('notizen'),
                    new DateTimeField('updated_by_import'),
                    new StringField('eingabe_abgeschlossen_visa'),
                    new DateTimeField('eingabe_abgeschlossen_datum'),
                    new StringField('kontrolliert_visa'),
                    new DateTimeField('kontrolliert_datum'),
                    new StringField('freigabe_visa'),
                    new DateTimeField('freigabe_datum'),
                    new StringField('created_visa', true),
                    new DateTimeField('created_date', true),
                    new StringField('updated_visa'),
                    new DateTimeField('updated_date', true),
                    new IntegerField('created_date_unix', true),
                    new IntegerField('updated_date_unix', true),
                    new IntegerField('eingabe_abgeschlossen_datum_unix'),
                    new IntegerField('kontrolliert_datum_unix'),
                    new IntegerField('freigabe_datum_unix')
                )
            );
            $lookupDataset->setOrderByField('searchable_name', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_ziel_organisation_id_searchable_name_search', 'id', 'searchable_name', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
        }
       
        protected function doCustomRenderColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
            customOnCustomRenderColumn('organisation_beziehung', $fieldName, $fieldData, $rowData, $customText, $handled);
        }
    
        protected function doCustomRenderPrintColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderExportColumn($exportType, $fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomDrawRow($rowData, &$cellFontColor, &$cellFontSize, &$cellBgColor, &$cellItalicAttr, &$cellBoldAttr)
        {
    
        }
    
        protected function doExtendedCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles, &$rowClasses, &$cellClasses)
        {
            customDrawRow('organisation_beziehung', $rowData, $rowCellStyles, $rowStyles);
        }
    
        protected function doCustomRenderTotal($totalValue, $aggregate, $columnName, &$customText, &$handled)
        {
    
        }
    
        protected function doCustomDefaultValues(&$values, &$handled) 
        {
    
        }
    
        protected function doCustomCompareColumn($columnName, $valueA, $valueB, &$result)
        {
    
        }
    
        protected function doBeforeInsertRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
            check_bis_date($page, $rowData, $cancel, $message, $tableName);
        }
    
        protected function doBeforeUpdateRecord($page, $oldRowData, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
            check_bis_date($page, $rowData, $cancel, $message, $tableName);
        }
    
        protected function doBeforeDeleteRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterInsertRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterUpdateRecord($page, $oldRowData, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterDeleteRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doCustomHTMLHeader($page, &$customHtmlHeaderText)
        { 
    
        }
    
        protected function doGetCustomTemplate($type, $part, $mode, &$result, &$params)
        {
            defaultOnGetCustomTemplate($this, $part, $mode, $result, $params);
        }
    
        protected function doGetCustomExportOptions(Page $page, $exportType, $rowData, &$options)
        {
    
        }
    
        protected function doFileUpload($fieldName, $rowData, &$result, &$accept, $originalFileName, $originalFileExtension, $fileSize, $tempFileName)
        {
    
        }
    
        protected function doPrepareChart(Chart $chart)
        {
    
        }
    
        protected function doPrepareColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function doPrepareFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
    
        }
    
        protected function doGetSelectionFilters(FixedKeysArray $columns, &$result)
        {
    
        }
    
        protected function doGetCustomFormLayout($mode, FixedKeysArray $columns, FormLayout $layout)
        {
    
        }
    
        protected function doGetCustomColumnGroup(FixedKeysArray $columns, ViewColumnGroup $columnGroup)
        {
    
        }
    
        protected function doPageLoaded()
        {
    
        }
    
        protected function doCalculateFields($rowData, $fieldName, &$value)
        {
    
        }
    
        protected function doGetCustomPagePermissions(Page $page, PermissionSet &$permissions, &$handled)
        {
    
        }
    
        protected function doGetCustomRecordPermissions(Page $page, &$usingCondition, $rowData, &$allowEdit, &$allowDelete, &$mergeWithDefault, &$handled)
        {
    
        }
    
    }

    SetUpUserAuthorization();

    try
    {
        $Page = new organisation_beziehungPage("organisation_beziehung", "organisation_beziehung.php", GetCurrentUserPermissionSetForDataSource("organisation_beziehung"), 'UTF-8');
        $Page->SetTitle('Organisation Beziehung');
        $Page->SetMenuLabel('<span class="relation">Organisation Beziehung</span>');
        $Page->SetHeader(GetPagesHeader());
        $Page->SetFooter(GetPagesFooter());
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("organisation_beziehung"));
        GetApplication()->SetMainPage($Page);
        before_render($Page); /*afterburner*/ 
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
