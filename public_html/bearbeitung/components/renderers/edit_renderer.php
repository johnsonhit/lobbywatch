<?php
// Processed by afterburner.sh



// require_once 'renderer.php';
include_once dirname(__FILE__) . '/' . 'renderer.php';

class EditRenderer extends Renderer
{
    #region Pages

    protected function GetPageViewData(Page $page) {
        return $page->GetSeparatedEditViewData();
    }

    protected function getPageMode() {
        return PageMode::Edit;
    }

    function RenderPage(Page $page) {
        $this->SetHTTPContentTypeByPage($page);
        $page->BeforePageRender->Fire(array(&$page));

        $customParams = array();
        $layoutTemplate = $page->GetCustomTemplate(PagePart::Layout, $this->getPageMode(), 'common/layout.tpl', $customParams);

        $this->DisplayTemplate('edit/page.tpl',
            array(
                'Page' => $page
            ),
            array_merge($customParams,
                array(
                    'App' => $this->GetPageViewData($page),
                    'Authentication' => $page->GetAuthenticationViewData(),

                    'HideSideBarByDefault' => $page->GetHidePageListByDefault(),
                    'LayoutTemplateName' => $layoutTemplate,
                    'PageList' => $this->RenderDef($page->GetReadyPageList()),
                    'Grid' => $this->Render($page->GetGrid(), true, true, $GLOBALS['customParams'])  /* Afterburner */,
                    'Variables' => $this->GetPageVariables($page)
                )
            )
        );
    }

    function RenderDetailPageEdit($Page) {

        $customParams = array();
        $layoutTemplate = $Page->GetCustomTemplate(PagePart::Layout, PageMode::Edit, 'common/layout.tpl', $customParams);

        $this->DisplayTemplate('edit/page.tpl',
            array(
                'Page' => $Page
            ),
            array_merge($customParams,
                array(
                    'App' => $Page->GetSeparatedEditViewData(),
                    'Authentication' => $Page->GetAuthenticationViewData(),

                    'HideSideBarByDefault' => $Page->GetHidePageListByDefault(),
                    'PageList' => $this->RenderDef($Page->GetReadyPageList()),
                    'LayoutTemplateName' => $layoutTemplate,
                    'Grid' => $this->Render($Page->GetGrid())
                )
            )
        );
    }

    #endregion

    #region Page parts

    function RenderGrid(Grid $grid) {
        $hiddenValues = array(OPERATION_PARAMNAME => OPERATION_COMMIT);
        AddPrimaryKeyParametersToArray($hiddenValues, $grid->GetDataset()->GetPrimaryKeyValues());

        $customParams = array();
        $template = $grid->GetPage()->GetCustomTemplate(PagePart::VerticalGrid, PageMode::Edit, 'edit/grid.tpl', $customParams);

        $this->DisplayTemplate($template,
            array(
                'Grid' => $grid->GetEditViewData($this),
            ),
            array_merge($customParams,
                array(
                    'Authentication' => $grid->GetPage()->GetAuthenticationViewData(),
                    'HiddenValues' => $hiddenValues
                )
            )
        );
    }

    #endregion
}
