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


    include_once dirname(__FILE__) . '/' . 'components/utils/check_utils.php';
    CheckPHPVersion();
    CheckTemplatesCacheFolderIsExistsAndWritable();


    include_once dirname(__FILE__) . '/' . 'phpgen_settings.php';
    include_once dirname(__FILE__) . '/' . 'database_engine/mysql_engine.php';
    include_once dirname(__FILE__) . '/' . 'components/page.php';
    include_once dirname(__FILE__) . '/' . 'authorization.php';

    function GetConnectionOptions()
    {
        $result = GetGlobalConnectionOptions();
        $result['client_encoding'] = 'utf8';
        GetApplication()->GetUserAuthorizationStrategy()->ApplyIdentityToConnectionOptions($result);
        return $result;
    }

    
    
    // OnBeforePageExecute event handler
    
    
    
    class organisation_beziehungPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->dataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`organisation_beziehung`');
            $field = new IntegerField('id', null, null, true);
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, true);
            $field = new IntegerField('organisation_id');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new IntegerField('ziel_organisation_id');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new StringField('art');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new StringField('notizen');
            $this->dataset->AddField($field, false);
            $field = new StringField('freigabe_von');
            $this->dataset->AddField($field, false);
            $field = new DateTimeField('freigabe_datum');
            $this->dataset->AddField($field, false);
            $field = new StringField('created_visa');
            $this->dataset->AddField($field, false);
            $field = new DateTimeField('created_date');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $field = new StringField('updated_visa');
            $this->dataset->AddField($field, false);
            $field = new DateTimeField('updated_date');
            $field->SetIsNotNull(true);
            $this->dataset->AddField($field, false);
            $this->dataset->AddLookupField('organisation_id', 'organisation', new IntegerField('id', null, null, true), new StringField('name_de', 'organisation_id_name_de', 'organisation_id_name_de_organisation'), 'organisation_id_name_de_organisation');
            $this->dataset->AddLookupField('ziel_organisation_id', 'organisation', new IntegerField('id', null, null, true), new StringField('name_de', 'ziel_organisation_id_name_de', 'ziel_organisation_id_name_de_organisation'), 'ziel_organisation_id_name_de_organisation');
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(100);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
        }
    
        public function GetPageList()
        {
            $currentPageCaption = $this->GetShortCaption();
            $result = new PageList($this);
            if (GetCurrentUserGrantForDataSource('branche')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Branche'), 'branche.php', $this->RenderText('Branche'), $currentPageCaption == $this->RenderText('Branche')));
            if (GetCurrentUserGrantForDataSource('in_kommission')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('In Kommission'), 'in_kommission.php', $this->RenderText('In Kommission'), $currentPageCaption == $this->RenderText('In Kommission')));
            if (GetCurrentUserGrantForDataSource('interessenbindung')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Interessenbindung'), 'interessenbindung.php', $this->RenderText('Interessenbindung'), $currentPageCaption == $this->RenderText('Interessenbindung')));
            if (GetCurrentUserGrantForDataSource('interessengruppe')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Interessengruppe'), 'interessengruppe.php', $this->RenderText('Interessengruppe'), $currentPageCaption == $this->RenderText('Interessengruppe')));
            if (GetCurrentUserGrantForDataSource('kommission')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Kommission'), 'kommission.php', $this->RenderText('Kommission'), $currentPageCaption == $this->RenderText('Kommission')));
            if (GetCurrentUserGrantForDataSource('mandat')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Mandat'), 'mandat.php', $this->RenderText('Mandat'), $currentPageCaption == $this->RenderText('Mandat')));
            if (GetCurrentUserGrantForDataSource('organisation')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Organisation'), 'organisation.php', $this->RenderText('Organisation'), $currentPageCaption == $this->RenderText('Organisation')));
            if (GetCurrentUserGrantForDataSource('organisation_beziehung')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Organisation Beziehung'), 'organisation_beziehung.php', $this->RenderText('Organisation Beziehung'), $currentPageCaption == $this->RenderText('Organisation Beziehung')));
            if (GetCurrentUserGrantForDataSource('parlamentarier')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Parlamentarier'), 'parlamentarier.php', $this->RenderText('Parlamentarier'), $currentPageCaption == $this->RenderText('Parlamentarier')));
            if (GetCurrentUserGrantForDataSource('partei')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Partei'), 'partei.php', $this->RenderText('Partei'), $currentPageCaption == $this->RenderText('Partei')));
            if (GetCurrentUserGrantForDataSource('zugangsberechtigung')->HasViewGrant())
                $result->AddPage(new PageLink($this->RenderText('Zugangsberechtigung'), 'zugangsberechtigung.php', $this->RenderText('Zugangsberechtigung'), $currentPageCaption == $this->RenderText('Zugangsberechtigung')));
            
            if ( HasAdminPage() && GetApplication()->HasAdminGrantForCurrentUser() )
              $result->AddPage(new PageLink($this->GetLocalizerCaptions()->GetMessageString('AdminPage'), 'phpgen_admin.php', $this->GetLocalizerCaptions()->GetMessageString('AdminPage'), false, true));
            return $result;
        }
    
        protected function CreateRssGenerator() {
            return setupRSS($this, $this->dataset);
        }
    
        protected function CreateGridSearchControl(Grid $grid)
        {
            $grid->UseFilter = true;
            $grid->SearchControl = new SimpleSearch('organisation_beziehungssearch', $this->dataset,
                array('id', 'organisation_id_name_de', 'ziel_organisation_id_name_de', 'art', 'notizen', 'freigabe_von', 'freigabe_datum', 'created_visa', 'created_date', 'updated_visa', 'updated_date'),
                array($this->RenderText('Id'), $this->RenderText('Organisation Id'), $this->RenderText('Ziel Organisation Id'), $this->RenderText('Art'), $this->RenderText('Notizen'), $this->RenderText('Freigabe Von'), $this->RenderText('Freigabe Datum'), $this->RenderText('Created Visa'), $this->RenderText('Created Date'), $this->RenderText('Updated Visa'), $this->RenderText('Updated Date')),
                array(
                    '=' => $this->GetLocalizerCaptions()->GetMessageString('equals'),
                    '<>' => $this->GetLocalizerCaptions()->GetMessageString('doesNotEquals'),
                    '<' => $this->GetLocalizerCaptions()->GetMessageString('isLessThan'),
                    '<=' => $this->GetLocalizerCaptions()->GetMessageString('isLessThanOrEqualsTo'),
                    '>' => $this->GetLocalizerCaptions()->GetMessageString('isGreaterThan'),
                    '>=' => $this->GetLocalizerCaptions()->GetMessageString('isGreaterThanOrEqualsTo'),
                    'ILIKE' => $this->GetLocalizerCaptions()->GetMessageString('Like'),
                    'STARTS' => $this->GetLocalizerCaptions()->GetMessageString('StartsWith'),
                    'ENDS' => $this->GetLocalizerCaptions()->GetMessageString('EndsWith'),
                    'CONTAINS' => $this->GetLocalizerCaptions()->GetMessageString('Contains')
                    ), $this->GetLocalizerCaptions(), $this, 'CONTAINS'
                );
        }
    
        protected function CreateGridAdvancedSearchControl(Grid $grid)
        {
            $this->AdvancedSearchControl = new AdvancedSearchControl('organisation_beziehungasearch', $this->dataset, $this->GetLocalizerCaptions(), $this->GetColumnVariableContainer(), $this->CreateLinkBuilder());
            $this->AdvancedSearchControl->setTimerInterval(1000);
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('id', $this->RenderText('Id')));
            
            $lookupDataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`organisation`');
            $field = new IntegerField('id', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('name_de');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('name_fr');
            $lookupDataset->AddField($field, false);
            $field = new StringField('name_it');
            $lookupDataset->AddField($field, false);
            $field = new StringField('ort');
            $lookupDataset->AddField($field, false);
            $field = new StringField('rechtsform');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('typ');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('vernehmlassung');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('interessengruppe_id');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('branche_id');
            $lookupDataset->AddField($field, false);
            $field = new StringField('url');
            $lookupDataset->AddField($field, false);
            $field = new StringField('beschreibung');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('ALT_parlam_verbindung');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('notizen');
            $lookupDataset->AddField($field, false);
            $field = new StringField('freigabe_von');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('freigabe_datum');
            $lookupDataset->AddField($field, false);
            $field = new StringField('created_visa');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('created_date');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('updated_visa');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('updated_date');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateLookupSearchInput('organisation_id', $this->RenderText('Organisation Id'), $lookupDataset, 'id', 'name_de', false));
            
            $lookupDataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`organisation`');
            $field = new IntegerField('id', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('name_de');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('name_fr');
            $lookupDataset->AddField($field, false);
            $field = new StringField('name_it');
            $lookupDataset->AddField($field, false);
            $field = new StringField('ort');
            $lookupDataset->AddField($field, false);
            $field = new StringField('rechtsform');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('typ');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('vernehmlassung');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('interessengruppe_id');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('branche_id');
            $lookupDataset->AddField($field, false);
            $field = new StringField('url');
            $lookupDataset->AddField($field, false);
            $field = new StringField('beschreibung');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('ALT_parlam_verbindung');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('notizen');
            $lookupDataset->AddField($field, false);
            $field = new StringField('freigabe_von');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('freigabe_datum');
            $lookupDataset->AddField($field, false);
            $field = new StringField('created_visa');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('created_date');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('updated_visa');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('updated_date');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateLookupSearchInput('ziel_organisation_id', $this->RenderText('Ziel Organisation Id'), $lookupDataset, 'id', 'name_de', false));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('art', $this->RenderText('Art')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('notizen', $this->RenderText('Notizen')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('freigabe_von', $this->RenderText('Freigabe Von')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateDateTimeSearchInput('freigabe_datum', $this->RenderText('Freigabe Datum')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('created_visa', $this->RenderText('Created Visa')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateDateTimeSearchInput('created_date', $this->RenderText('Created Date')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateStringSearchInput('updated_visa', $this->RenderText('Updated Visa')));
            $this->AdvancedSearchControl->AddSearchColumn($this->AdvancedSearchControl->CreateDateTimeSearchInput('updated_date', $this->RenderText('Updated Date')));
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
            $actionsBandName = 'actions';
            $grid->AddBandToBegin($actionsBandName, $this->GetLocalizerCaptions()->GetMessageString('Actions'), true);
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('View'), OPERATION_VIEW, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
                $column->SetImagePath('images/view_action.png');
            }
            if ($this->GetSecurityInfo()->HasEditGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('Edit'), OPERATION_EDIT, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
                $column->SetImagePath('images/edit_action.png');
                $column->OnShow->AddListener('ShowEditButtonHandler', $this);
            }
            if ($this->GetSecurityInfo()->HasDeleteGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('Delete'), OPERATION_DELETE, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
                $column->SetImagePath('images/delete_action.png');
                $column->OnShow->AddListener('ShowDeleteButtonHandler', $this);
            $column->SetAdditionalAttribute("data-modal-delete", "true");
            $column->SetAdditionalAttribute("data-delete-handler-name", $this->GetModalGridDeleteHandler());
            }
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $column = new RowOperationByLinkColumn($this->GetLocalizerCaptions()->GetMessageString('Copy'), OPERATION_COPY, $this->dataset);
                $grid->AddViewColumn($column, $actionsBandName);
                $column->SetImagePath('images/copy_action.png');
            }
        }
    
        protected function AddFieldColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->SetDescription($this->RenderText('Technischer Schl�ssel einer Organisationsbeziehung'));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for name_de field
            //
            $column = new TextViewColumn('organisation_id_name_de', 'Organisation Id', $this->dataset);
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for organisation_id field
            //
            $editor = new ComboBox('organisation_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`organisation`');
            $field = new IntegerField('id', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('name_de');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('name_fr');
            $lookupDataset->AddField($field, false);
            $field = new StringField('name_it');
            $lookupDataset->AddField($field, false);
            $field = new StringField('ort');
            $lookupDataset->AddField($field, false);
            $field = new StringField('rechtsform');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('typ');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('vernehmlassung');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('interessengruppe_id');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('branche_id');
            $lookupDataset->AddField($field, false);
            $field = new StringField('url');
            $lookupDataset->AddField($field, false);
            $field = new StringField('beschreibung');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('ALT_parlam_verbindung');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('notizen');
            $lookupDataset->AddField($field, false);
            $field = new StringField('freigabe_von');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('freigabe_datum');
            $lookupDataset->AddField($field, false);
            $field = new StringField('created_visa');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('created_date');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('updated_visa');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('updated_date');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('name_de', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Organisation Id', 
                'organisation_id', 
                $editor, 
                $this->dataset, 'id', 'name_de', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for organisation_id field
            //
            $editor = new ComboBox('organisation_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`organisation`');
            $field = new IntegerField('id', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('name_de');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('name_fr');
            $lookupDataset->AddField($field, false);
            $field = new StringField('name_it');
            $lookupDataset->AddField($field, false);
            $field = new StringField('ort');
            $lookupDataset->AddField($field, false);
            $field = new StringField('rechtsform');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('typ');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('vernehmlassung');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('interessengruppe_id');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('branche_id');
            $lookupDataset->AddField($field, false);
            $field = new StringField('url');
            $lookupDataset->AddField($field, false);
            $field = new StringField('beschreibung');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('ALT_parlam_verbindung');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('notizen');
            $lookupDataset->AddField($field, false);
            $field = new StringField('freigabe_von');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('freigabe_datum');
            $lookupDataset->AddField($field, false);
            $field = new StringField('created_visa');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('created_date');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('updated_visa');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('updated_date');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('name_de', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Organisation Id', 
                'organisation_id', 
                $editor, 
                $this->dataset, 'id', 'name_de', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText('Fremdschl�ssel Organisation.'));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for name_de field
            //
            $column = new TextViewColumn('ziel_organisation_id_name_de', 'Ziel Organisation Id', $this->dataset);
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for ziel_organisation_id field
            //
            $editor = new ComboBox('ziel_organisation_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`organisation`');
            $field = new IntegerField('id', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('name_de');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('name_fr');
            $lookupDataset->AddField($field, false);
            $field = new StringField('name_it');
            $lookupDataset->AddField($field, false);
            $field = new StringField('ort');
            $lookupDataset->AddField($field, false);
            $field = new StringField('rechtsform');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('typ');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('vernehmlassung');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('interessengruppe_id');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('branche_id');
            $lookupDataset->AddField($field, false);
            $field = new StringField('url');
            $lookupDataset->AddField($field, false);
            $field = new StringField('beschreibung');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('ALT_parlam_verbindung');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('notizen');
            $lookupDataset->AddField($field, false);
            $field = new StringField('freigabe_von');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('freigabe_datum');
            $lookupDataset->AddField($field, false);
            $field = new StringField('created_visa');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('created_date');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('updated_visa');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('updated_date');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('name_de', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Ziel Organisation Id', 
                'ziel_organisation_id', 
                $editor, 
                $this->dataset, 'id', 'name_de', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for ziel_organisation_id field
            //
            $editor = new ComboBox('ziel_organisation_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`organisation`');
            $field = new IntegerField('id', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('name_de');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('name_fr');
            $lookupDataset->AddField($field, false);
            $field = new StringField('name_it');
            $lookupDataset->AddField($field, false);
            $field = new StringField('ort');
            $lookupDataset->AddField($field, false);
            $field = new StringField('rechtsform');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('typ');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('vernehmlassung');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('interessengruppe_id');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('branche_id');
            $lookupDataset->AddField($field, false);
            $field = new StringField('url');
            $lookupDataset->AddField($field, false);
            $field = new StringField('beschreibung');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('ALT_parlam_verbindung');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('notizen');
            $lookupDataset->AddField($field, false);
            $field = new StringField('freigabe_von');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('freigabe_datum');
            $lookupDataset->AddField($field, false);
            $field = new StringField('created_visa');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('created_date');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('updated_visa');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('updated_date');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('name_de', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Ziel Organisation Id', 
                'ziel_organisation_id', 
                $editor, 
                $this->dataset, 'id', 'name_de', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText('Fremdschl�ssel der Zielorganisation.'));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for art field
            //
            $column = new TextViewColumn('art', 'Art', $this->dataset);
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for art field
            //
            $editor = new ComboBox('art_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->AddValue('mandat fuer', $this->RenderText('mandat fuer'));
            $editor->AddValue('mitglied von', $this->RenderText('mitglied von'));
            $editColumn = new CustomEditColumn('Art', 'art', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for art field
            //
            $editor = new ComboBox('art_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->AddValue('mandat fuer', $this->RenderText('mandat fuer'));
            $editor->AddValue('mitglied von', $this->RenderText('mitglied von'));
            $editColumn = new CustomEditColumn('Art', 'art', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText('Beschreibt die Beziehung einer Organisation zu einer Zielorgansation'));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for notizen field
            //
            $column = new TextViewColumn('notizen', 'Notizen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('notizen_handler');
            
            /* <inline edit column> */
            //
            // Edit column for notizen field
            //
            $editor = new TextAreaEdit('notizen_edit', 50, 8);
            $editColumn = new CustomEditColumn('Notizen', 'notizen', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for notizen field
            //
            $editor = new TextAreaEdit('notizen_edit', 50, 8);
            $editColumn = new CustomEditColumn('Notizen', 'notizen', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText('Interne Notizen zu diesem Eintrag. Eintr�ge am besten mit Datum und Visa versehen.'));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for freigabe_von field
            //
            $column = new TextViewColumn('freigabe_von', 'Freigabe Von', $this->dataset);
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for freigabe_von field
            //
            $editor = new ComboBox('freigabe_von_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->AddValue('otto', $this->RenderText('otto'));
            $editor->AddValue('rebecca', $this->RenderText('rebecca'));
            $editor->AddValue('thomas', $this->RenderText('thomas'));
            $editor->AddValue('bane', $this->RenderText('bane'));
            $editor->AddValue('roland', $this->RenderText('roland'));
            $editColumn = new CustomEditColumn('Freigabe Von', 'freigabe_von', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for freigabe_von field
            //
            $editor = new ComboBox('freigabe_von_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->AddValue('otto', $this->RenderText('otto'));
            $editor->AddValue('rebecca', $this->RenderText('rebecca'));
            $editor->AddValue('thomas', $this->RenderText('thomas'));
            $editor->AddValue('bane', $this->RenderText('bane'));
            $editor->AddValue('roland', $this->RenderText('roland'));
            $editColumn = new CustomEditColumn('Freigabe Von', 'freigabe_von', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText('Freigabe von (Freigabe = Daten sind fertig)'));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for freigabe_datum field
            //
            $column = new DateTimeViewColumn('freigabe_datum', 'Freigabe Datum', $this->dataset);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for freigabe_datum field
            //
            $editor = new DateTimeEdit('freigabe_datum_edit', true, 'Y-m-d H:i:s', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Freigabe Datum', 'freigabe_datum', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for freigabe_datum field
            //
            $editor = new DateTimeEdit('freigabe_datum_edit', true, 'Y-m-d H:i:s', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Freigabe Datum', 'freigabe_datum', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText('Freigabedatum (Freigabe = Daten sind fertig)'));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for created_visa field
            //
            $column = new TextViewColumn('created_visa', 'Created Visa', $this->dataset);
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for created_visa field
            //
            $editor = new TextEdit('created_visa_edit');
            $editor->SetSize(10);
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Created Visa', 'created_visa', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for created_visa field
            //
            $editor = new TextEdit('created_visa_edit');
            $editor->SetSize(10);
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Created Visa', 'created_visa', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText('Erstellt von'));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for created_date field
            //
            $column = new DateTimeViewColumn('created_date', 'Created Date', $this->dataset);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for created_date field
            //
            $editor = new DateTimeEdit('created_date_edit', true, 'Y-m-d H:i:s', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Created Date', 'created_date', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for created_date field
            //
            $editor = new DateTimeEdit('created_date_edit', true, 'Y-m-d H:i:s', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Created Date', 'created_date', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToDefault(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText('Erstellt am'));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for updated_visa field
            //
            $column = new TextViewColumn('updated_visa', 'Updated Visa', $this->dataset);
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for updated_visa field
            //
            $editor = new TextEdit('updated_visa_edit');
            $editor->SetSize(10);
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Updated Visa', 'updated_visa', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for updated_visa field
            //
            $editor = new TextEdit('updated_visa_edit');
            $editor->SetSize(10);
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Updated Visa', 'updated_visa', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText('Abg�endert von'));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for updated_date field
            //
            $column = new DateTimeViewColumn('updated_date', 'Updated Date', $this->dataset);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for updated_date field
            //
            $editor = new DateTimeEdit('updated_date_edit', true, 'Y-m-d H:i:s', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Updated Date', 'updated_date', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for updated_date field
            //
            $editor = new DateTimeEdit('updated_date_edit', true, 'Y-m-d H:i:s', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Updated Date', 'updated_date', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToDefault(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $column->SetDescription($this->RenderText('Abg�endert am'));
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name_de field
            //
            $column = new TextViewColumn('organisation_id_name_de', 'Organisation Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for name_de field
            //
            $column = new TextViewColumn('ziel_organisation_id_name_de', 'Ziel Organisation Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for art field
            //
            $column = new TextViewColumn('art', 'Art', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for notizen field
            //
            $column = new TextViewColumn('notizen', 'Notizen', $this->dataset);
            $column->SetOrderable(true);
            $column->SetMaxLength(75);
            $column->SetFullTextWindowHandlerName('notizen_handler');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for freigabe_von field
            //
            $column = new TextViewColumn('freigabe_von', 'Freigabe Von', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for freigabe_datum field
            //
            $column = new DateTimeViewColumn('freigabe_datum', 'Freigabe Datum', $this->dataset);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for created_visa field
            //
            $column = new TextViewColumn('created_visa', 'Created Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for created_date field
            //
            $column = new DateTimeViewColumn('created_date', 'Created Date', $this->dataset);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for updated_visa field
            //
            $column = new TextViewColumn('updated_visa', 'Updated Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for updated_date field
            //
            $column = new DateTimeViewColumn('updated_date', 'Updated Date', $this->dataset);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for organisation_id field
            //
            $editor = new ComboBox('organisation_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`organisation`');
            $field = new IntegerField('id', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('name_de');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('name_fr');
            $lookupDataset->AddField($field, false);
            $field = new StringField('name_it');
            $lookupDataset->AddField($field, false);
            $field = new StringField('ort');
            $lookupDataset->AddField($field, false);
            $field = new StringField('rechtsform');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('typ');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('vernehmlassung');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('interessengruppe_id');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('branche_id');
            $lookupDataset->AddField($field, false);
            $field = new StringField('url');
            $lookupDataset->AddField($field, false);
            $field = new StringField('beschreibung');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('ALT_parlam_verbindung');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('notizen');
            $lookupDataset->AddField($field, false);
            $field = new StringField('freigabe_von');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('freigabe_datum');
            $lookupDataset->AddField($field, false);
            $field = new StringField('created_visa');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('created_date');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('updated_visa');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('updated_date');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('name_de', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Organisation Id', 
                'organisation_id', 
                $editor, 
                $this->dataset, 'id', 'name_de', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for ziel_organisation_id field
            //
            $editor = new ComboBox('ziel_organisation_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`organisation`');
            $field = new IntegerField('id', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('name_de');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('name_fr');
            $lookupDataset->AddField($field, false);
            $field = new StringField('name_it');
            $lookupDataset->AddField($field, false);
            $field = new StringField('ort');
            $lookupDataset->AddField($field, false);
            $field = new StringField('rechtsform');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('typ');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('vernehmlassung');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('interessengruppe_id');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('branche_id');
            $lookupDataset->AddField($field, false);
            $field = new StringField('url');
            $lookupDataset->AddField($field, false);
            $field = new StringField('beschreibung');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('ALT_parlam_verbindung');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('notizen');
            $lookupDataset->AddField($field, false);
            $field = new StringField('freigabe_von');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('freigabe_datum');
            $lookupDataset->AddField($field, false);
            $field = new StringField('created_visa');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('created_date');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('updated_visa');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('updated_date');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('name_de', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Ziel Organisation Id', 
                'ziel_organisation_id', 
                $editor, 
                $this->dataset, 'id', 'name_de', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for art field
            //
            $editor = new ComboBox('art_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->AddValue('mandat fuer', $this->RenderText('mandat fuer'));
            $editor->AddValue('mitglied von', $this->RenderText('mitglied von'));
            $editColumn = new CustomEditColumn('Art', 'art', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            // Edit column for freigabe_von field
            //
            $editor = new ComboBox('freigabe_von_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->AddValue('otto', $this->RenderText('otto'));
            $editor->AddValue('rebecca', $this->RenderText('rebecca'));
            $editor->AddValue('thomas', $this->RenderText('thomas'));
            $editor->AddValue('bane', $this->RenderText('bane'));
            $editor->AddValue('roland', $this->RenderText('roland'));
            $editColumn = new CustomEditColumn('Freigabe Von', 'freigabe_von', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for freigabe_datum field
            //
            $editor = new DateTimeEdit('freigabe_datum_edit', true, 'Y-m-d H:i:s', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Freigabe Datum', 'freigabe_datum', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for created_visa field
            //
            $editor = new TextEdit('created_visa_edit');
            $editor->SetSize(10);
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Created Visa', 'created_visa', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for created_date field
            //
            $editor = new DateTimeEdit('created_date_edit', true, 'Y-m-d H:i:s', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Created Date', 'created_date', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for updated_visa field
            //
            $editor = new TextEdit('updated_visa_edit');
            $editor->SetSize(10);
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Updated Visa', 'updated_visa', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for updated_date field
            //
            $editor = new DateTimeEdit('updated_date_edit', true, 'Y-m-d H:i:s', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Updated Date', 'updated_date', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for organisation_id field
            //
            $editor = new ComboBox('organisation_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`organisation`');
            $field = new IntegerField('id', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('name_de');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('name_fr');
            $lookupDataset->AddField($field, false);
            $field = new StringField('name_it');
            $lookupDataset->AddField($field, false);
            $field = new StringField('ort');
            $lookupDataset->AddField($field, false);
            $field = new StringField('rechtsform');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('typ');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('vernehmlassung');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('interessengruppe_id');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('branche_id');
            $lookupDataset->AddField($field, false);
            $field = new StringField('url');
            $lookupDataset->AddField($field, false);
            $field = new StringField('beschreibung');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('ALT_parlam_verbindung');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('notizen');
            $lookupDataset->AddField($field, false);
            $field = new StringField('freigabe_von');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('freigabe_datum');
            $lookupDataset->AddField($field, false);
            $field = new StringField('created_visa');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('created_date');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('updated_visa');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('updated_date');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('name_de', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Organisation Id', 
                'organisation_id', 
                $editor, 
                $this->dataset, 'id', 'name_de', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for ziel_organisation_id field
            //
            $editor = new ComboBox('ziel_organisation_id_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $lookupDataset = new TableDataset(
                new MyPDOConnectionFactory(),
                GetConnectionOptions(),
                '`organisation`');
            $field = new IntegerField('id', null, null, true);
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, true);
            $field = new StringField('name_de');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('name_fr');
            $lookupDataset->AddField($field, false);
            $field = new StringField('name_it');
            $lookupDataset->AddField($field, false);
            $field = new StringField('ort');
            $lookupDataset->AddField($field, false);
            $field = new StringField('rechtsform');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('typ');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('vernehmlassung');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('interessengruppe_id');
            $lookupDataset->AddField($field, false);
            $field = new IntegerField('branche_id');
            $lookupDataset->AddField($field, false);
            $field = new StringField('url');
            $lookupDataset->AddField($field, false);
            $field = new StringField('beschreibung');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('ALT_parlam_verbindung');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('notizen');
            $lookupDataset->AddField($field, false);
            $field = new StringField('freigabe_von');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('freigabe_datum');
            $lookupDataset->AddField($field, false);
            $field = new StringField('created_visa');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('created_date');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $field = new StringField('updated_visa');
            $lookupDataset->AddField($field, false);
            $field = new DateTimeField('updated_date');
            $field->SetIsNotNull(true);
            $lookupDataset->AddField($field, false);
            $lookupDataset->SetOrderBy('name_de', GetOrderTypeAsSQL(otAscending));
            $editColumn = new LookUpEditColumn(
                'Ziel Organisation Id', 
                'ziel_organisation_id', 
                $editor, 
                $this->dataset, 'id', 'name_de', $lookupDataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for art field
            //
            $editor = new ComboBox('art_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->AddValue('mandat fuer', $this->RenderText('mandat fuer'));
            $editor->AddValue('mitglied von', $this->RenderText('mitglied von'));
            $editColumn = new CustomEditColumn('Art', 'art', $editor, $this->dataset);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
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
            // Edit column for freigabe_von field
            //
            $editor = new ComboBox('freigabe_von_edit', $this->GetLocalizerCaptions()->GetMessageString('PleaseSelect'));
            $editor->AddValue('otto', $this->RenderText('otto'));
            $editor->AddValue('rebecca', $this->RenderText('rebecca'));
            $editor->AddValue('thomas', $this->RenderText('thomas'));
            $editor->AddValue('bane', $this->RenderText('bane'));
            $editor->AddValue('roland', $this->RenderText('roland'));
            $editColumn = new CustomEditColumn('Freigabe Von', 'freigabe_von', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for freigabe_datum field
            //
            $editor = new DateTimeEdit('freigabe_datum_edit', true, 'Y-m-d H:i:s', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Freigabe Datum', 'freigabe_datum', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for created_visa field
            //
            $editor = new TextEdit('created_visa_edit');
            $editor->SetSize(10);
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Created Visa', 'created_visa', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for created_date field
            //
            $editor = new DateTimeEdit('created_date_edit', true, 'Y-m-d H:i:s', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Created Date', 'created_date', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToDefault(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for updated_visa field
            //
            $editor = new TextEdit('updated_visa_edit');
            $editor->SetSize(10);
            $editor->SetMaxLength(10);
            $editColumn = new CustomEditColumn('Updated Visa', 'updated_visa', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for updated_date field
            //
            $editor = new DateTimeEdit('updated_date_edit', true, 'Y-m-d H:i:s', GetFirstDayOfWeek());
            $editColumn = new CustomEditColumn('Updated Date', 'updated_date', $editor, $this->dataset);
            $editColumn->SetReadOnly(true);
            $editColumn->SetAllowSetToDefault(true);
            $validator = new RequiredValidator(StringUtils::Format($this->GetLocalizerCaptions()->GetMessageString('RequiredValidationMessage'), $this->RenderText($editColumn->GetCaption())));
            $editor->GetValidatorCollection()->AddValidator($validator);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $grid->SetShowAddButton(true);
                $grid->SetShowInlineAddButton(false);
            }
            else
            {
                $grid->SetShowInlineAddButton(false);
                $grid->SetShowAddButton(false);
            }
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for name_de field
            //
            $column = new TextViewColumn('organisation_id_name_de', 'Organisation Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for name_de field
            //
            $column = new TextViewColumn('ziel_organisation_id_name_de', 'Ziel Organisation Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for art field
            //
            $column = new TextViewColumn('art', 'Art', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for notizen field
            //
            $column = new TextViewColumn('notizen', 'Notizen', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for freigabe_von field
            //
            $column = new TextViewColumn('freigabe_von', 'Freigabe Von', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for freigabe_datum field
            //
            $column = new DateTimeViewColumn('freigabe_datum', 'Freigabe Datum', $this->dataset);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for created_visa field
            //
            $column = new TextViewColumn('created_visa', 'Created Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for created_date field
            //
            $column = new DateTimeViewColumn('created_date', 'Created Date', $this->dataset);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for updated_visa field
            //
            $column = new TextViewColumn('updated_visa', 'Updated Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for updated_date field
            //
            $column = new DateTimeViewColumn('updated_date', 'Updated Date', $this->dataset);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new TextViewColumn('id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for name_de field
            //
            $column = new TextViewColumn('organisation_id_name_de', 'Organisation Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for name_de field
            //
            $column = new TextViewColumn('ziel_organisation_id_name_de', 'Ziel Organisation Id', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for art field
            //
            $column = new TextViewColumn('art', 'Art', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for notizen field
            //
            $column = new TextViewColumn('notizen', 'Notizen', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for freigabe_von field
            //
            $column = new TextViewColumn('freigabe_von', 'Freigabe Von', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for freigabe_datum field
            //
            $column = new DateTimeViewColumn('freigabe_datum', 'Freigabe Datum', $this->dataset);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for created_visa field
            //
            $column = new TextViewColumn('created_visa', 'Created Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for created_date field
            //
            $column = new DateTimeViewColumn('created_date', 'Created Date', $this->dataset);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for updated_visa field
            //
            $column = new TextViewColumn('updated_visa', 'Updated Visa', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for updated_date field
            //
            $column = new DateTimeViewColumn('updated_date', 'Updated Date', $this->dataset);
            $column->SetDateTimeFormat('d.m.Y H:i:s');
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetShowSetToNullCheckBox(true);
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
        public function ShowEditButtonHandler(&$show)
        {
            if ($this->GetRecordPermission() != null)
                $show = $this->GetRecordPermission()->HasEditGrant($this->GetDataset());
        }
        public function ShowDeleteButtonHandler(&$show)
        {
            if ($this->GetRecordPermission() != null)
                $show = $this->GetRecordPermission()->HasDeleteGrant($this->GetDataset());
        }
        
        public function GetModalGridDeleteHandler() { return 'organisation_beziehung_modal_delete'; }
        protected function GetEnableModalGridDelete() { return true; }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset, 'organisation_beziehungGrid');
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(true);
            else
               $result->SetAllowDeleteSelected(false);   
            
            ApplyCommonPageSettings($this, $result);
            
            $result->SetUseImagesForActions(true);
            $result->SetUseFixedHeader(false);
            
            $result->SetShowLineNumbers(false);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $this->CreateGridSearchControl($result);
            $this->CreateGridAdvancedSearchControl($result);
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
    
            $this->SetShowPageList(true);
            $this->SetHidePageListByDefault(false);
            $this->SetExportToExcelAvailable(true);
            $this->SetExportToWordAvailable(true);
            $this->SetExportToXmlAvailable(true);
            $this->SetExportToCsvAvailable(true);
            $this->SetExportToPdfAvailable(false);
            $this->SetPrinterFriendlyAvailable(true);
            $this->SetSimpleSearchAvailable(true);
            $this->SetAdvancedSearchAvailable(true);
            $this->SetFilterRowAvailable(true);
            $this->SetVisualEffectsEnabled(true);
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(true);
    
            //
            // Http Handlers
            //
            //
            // View column for notizen field
            //
            $column = new TextViewColumn('notizen', 'Notizen', $this->dataset);
            $column->SetOrderable(true);
            
            /* <inline edit column> */
            //
            // Edit column for notizen field
            //
            $editor = new TextAreaEdit('notizen_edit', 50, 8);
            $editColumn = new CustomEditColumn('Notizen', 'notizen', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetEditOperationColumn($editColumn);
            /* </inline edit column> */
            
            /* <inline insert column> */
            //
            // Edit column for notizen field
            //
            $editor = new TextAreaEdit('notizen_edit', 50, 8);
            $editColumn = new CustomEditColumn('Notizen', 'notizen', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $column->SetInsertOperationColumn($editColumn);
            /* </inline insert column> */
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'notizen_handler', $column);
            GetApplication()->RegisterHTTPHandler($handler);//
            // View column for notizen field
            //
            $column = new TextViewColumn('notizen', 'Notizen', $this->dataset);
            $column->SetOrderable(true);
            $handler = new ShowTextBlobHandler($this->dataset, $this, 'notizen_handler', $column);
            GetApplication()->RegisterHTTPHandler($handler);
            return $result;
        }
        
        public function OpenAdvancedSearchByDefault()
        {
            return false;
        }
    
        protected function DoGetGridHeader()
        {
            return '';
        }
    }

    SetUpUserAuthorization(GetApplication());

    try
    {
        $Page = new organisation_beziehungPage("organisation_beziehung.php", "organisation_beziehung", GetCurrentUserGrantForDataSource("organisation_beziehung"), 'UTF-8');
        $Page->SetShortCaption('Organisation Beziehung');
        $Page->SetHeader(GetPagesHeader());
        $Page->SetFooter(GetPagesFooter());
        $Page->SetCaption('Organisation Beziehung');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("organisation_beziehung"));
        GetApplication()->SetEnableLessRunTimeCompile(GetEnableLessFilesRunTimeCompilation());
        GetApplication()->SetCanUserChangeOwnPassword(
            !function_exists('CanUserChangeOwnPassword') || CanUserChangeOwnPassword());
        GetApplication()->SetMainPage($Page);
        before_render($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e->getMessage());
    }