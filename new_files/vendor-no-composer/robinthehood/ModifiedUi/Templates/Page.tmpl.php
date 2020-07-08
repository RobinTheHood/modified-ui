<?php $stylePath = DIR_FS_DOCUMENT_ROOT . '/vendor-no-composer/robinthehood/ModifiedUi/Templates/Styles/'; ?>
<?php $webStylePath = '/vendor-no-composer/robinthehood/ModifiedUi/Templates/Styles/'; ?>

<?php require (DIR_WS_INCLUDES . 'head.php'); ?>
    <link href="<?php echo $webStylePath; ?>fontawesome.all.css" rel="stylesheet"> <!--load all styles -->

        <style type="text/css">
            /* .table {
                width: 100%;
                border: 1px solid #a3a3a3;
                margin-bottom:20px;
                background: #f3f3f3;
                padding:2px;
            }

            .heading {
                font-family: Verdana, Arial, sans-serif;
                font-size: 12px;
                font-weight: bold;
                padding:2px;
            }

            .last_row {
                background-color: #ffdead;
            }

            .error-message {
                margin: 10px 5px 10px 5px;
                padding: 10px;
                border: 2px solid red;
            }

            .action-separator {
                margin-top: 18px;
                border-bottom: 2px solid #B3417B;
            } */

            .rth-modified-ui-page {
                padding: 2px;
                font-family: Verdana, Arial, sans-serif;
                font-size: 12px;
                border: 1px solid;
                border-color: #cccccc;
                background: #F7F7F7;
                margin: 4px;
            }


            .rth-modified-ui-splitpanel {
                width: 100%;
                display: flex;
                flex-direction: row;
                justify-content: space-between;
            }

            .rth-modified-ui-splitpanel-left {
                margin-right: 2px;
            }

            .rth-modified-ui-splitpanel-right {

            }

            <?php include $stylePath . 'ActionPanel.css'; ?>
            <?php include $stylePath . 'FilterPanel.css'; ?>
            <?php include $stylePath . 'Heading.css'; ?>
            <?php include $stylePath . 'Input.css'; ?>
            <?php include $stylePath . 'TabPanel.css'; ?>
            <?php include $stylePath . 'Pagination.css'; ?>
            <?php include $stylePath . 'Table.css'; ?>

            /* CSS für die kleine Tabelle - START */

            /* .rth-modified-ui-table * {
                box-sizing: border-box;
            }

            .rth-modified-ui-table {
                width: 100%;
                border: 1px solid #cccccc;
                border-collapse: collapse;
            }

            .rth-modified-ui-table thead, .rth-modified-ui-table tbody, .rth-modified-ui-table tr {
                display: block;
            }

            .rth-modified-ui-table thead {
                text-align: left;
                background-color: #aaaaaa;
            }

            .rth-modified-ui-table thead tr {
                display: block;
            }

            .rth-modified-ui-table thead th {
                width: 25%;
                float: left;
                padding: 5px 0px 5px 5px;
                border-left: 1px solid #bbbbbb;
                border-right: 1px solid #dddddd;
                background-color: #cccccc;
                background-image: linear-gradient(#dddddd, #bbbbbb);
            }

            .rth-modified-ui-table tbody {
                height: 50px;
                overflow-y: auto;
                width: 100%;
                background-color: #ffffff;
            }

            .rth-modified-ui-table tbody td {
                width: 25%;
                float: left;
                padding: 5px 0px 5px 5px;
                border-bottom: 1px solid #dddddd;
            }

            .rth-modified-ui-table tbody tr:nth-child(odd) td {
                background-color: #ffffff;
            }

            .rth-modified-ui-table tbody tr:nth-child(even) td {
                background-color: #eeeeee;
            }

            .rth-modified-ui-table tr:after {
                content: ' ';
                display: block;
                visibility: hidden;
                clear: both;
            } */

            /* CSS für die kleine Tabelle - END */

        </style>

        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>

        <script>
            function rthRegisterTabPanel(name)
            {
                var tabPanel = document.getElementById(name);

                var navItems = tabPanel.children[0].children;
                //var navItems = tabPanel.getElementsByClassName('rth-modified-ui-tabpanel-navitem');
                var contentItems = tabPanel.children[1].children;
                //var contentItems = tabPanel.getElementsByClassName('rth-modified-ui-tabpanel-content-item');

                var index = 0;
                for (let item of navItems) {
                    item.classList.remove('active');
                    contentItems[index].classList.remove('active');
                    item.onclick = rthCreateOnClickFunction(tabPanel, item, index);
                    index++;
                }

                navItems[0].classList.add('active');
                contentItems[0].classList.add('active');
            }

            function rthCreateOnClickFunction(tabPanel, item, index)
            {
                return function() {
                    var navItems = tabPanel.children[0].children;
                    //var navItems = tabPanel.getElementsByClassName('rth-modified-ui-tabpanel-navitem');
                    var contentItems = tabPanel.children[1].children;
                    //var contentItems = tabPanel.getElementsByClassName('rth-modified-ui-tabpanel-content-item');

                    var contentIndex = 0;
                    for (let item of navItems) {
                        item.classList.remove('active');
                        contentItems[contentIndex++].classList.remove('active');
                    }

                    item.classList.add('active');
                    contentItems[index].classList.add('active');
                };
            }
        </script>
    </head>

    <body>
        <!-- Navigation -->
        <?php require(DIR_WS_INCLUDES . 'header.php'); ?>

        <!-- Content -->
        <?php if ($error) { ?>
            <div class="error-message">
                Fehler: <?php echo $error; ?>
            </div>
        <?php } ?>

        <div class="rth-modified-ui-page">
            <?php echo $this->heading->render() ?>
            <?php echo $this->pageNavigation; ?>
            <?php echo $this->content; ?>
        </div>

        <!-- Footer -->
        <?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
        <br>

        <script type="text/javascript">
            $('tbody').sortable({
                axis: "y",
                update: function(event, ui) {
                    var rows = $('tbody tr');
                    console.log(rows);
                }
            });
        </script>
    </body>
</html>

<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
