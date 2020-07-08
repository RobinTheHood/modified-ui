<?php
namespace RobinTheHood\ModifiedUi\Classes\Admin;

use RobinTheHood\ModifiedUi\Classes\Admin\View;

class Pagination extends View
{
    // private $count;
    // private $entrysPerPage = 20;
    // private $split;
    // private $page = 0;

    private $itemsSelect;

    // public function init($sql)
    // {
    //     $this->page = $_GET['page'];
    //     $this->split = new \splitPageResults($this->page, $this->entrysPerPage, $sql, $this->count);
    //     return $sql;
    // }

    public function __construct()
    {
        $itemsSelect = new Select('hunger');
        $itemsSelect->setOptions([
            ['value' => 10, 'name' => 10],
            ['value' => 25, 'name' => 25],
            ['value' => 50, 'name' => 50],
            ['value' => 100, 'name' => 100],
            ['value' => 250, 'name' => 250],
            ['value' => 500, 'name' => 500]
        ]);

        $this->itemsSelect = $itemsSelect;
        $this->addComponent($itemsSelect);
    }

    public function getViewName()
    {
        return 'Pagination';
    }
    
    public function render()
    {
        return '
            <div class="rth-modified-ui-pagination">
                <div class="rth-modified-ui-pagination-right">
                    <div class="rth-modified-ui-pagination-page-items-label">
                        Zeilen pro Seite:
                    </div>

                    <div class="rth-modified-ui-pagination-page-items-select">
                        ' . $this->itemsSelect->render() . '
                    </div>

                    <div class="rth-modified-ui-pagination-page">
                        1-10 von 15
                    </div>

                    <div class="rth-modified-ui-pagination-prev">
                        <
                    </div>

                    <div class="rth-modified-ui-pagination-next">
                        >
                    </div>
                </div>
            </div>
        ';

        // return '
        //     <div class="smallText pdg2 flt-l">
        //     ' . $this->split->display_count(
        //             $this->count,
        //             $this->entrysPerPage,
        //             $this->page,
        //             TEXT_DISPLAY_NUMBER_OF_ORDERS
        //         ) . '
        //     </div>
        //
        //     <div class="smallText pdg2 flt-r">
        //     ' . $this->split->display_links(
        //             $this->count,
        //             $this->entrysPerPage,
        //             MAX_DISPLAY_PAGE_LINKS,
        //             $this->page,
        //             xtc_get_all_get_params(array('page', 'oID', 'action'))
        //         ) . '
        //     </div>
        //     ' . draw_input_per_page($PHP_SELF, 'FW_MAX_DISPLAY_MULTI_ORDER_RESULTS', $this->entrysPerPage);
    }
}
