<?php require DIR_WS_INCLUDES . 'head.php'; ?>

<?php $stylePath = DIR_FS_DOCUMENT_ROOT . '/vendor-mmlc/robinthehood/modified-ui/Templates/Styles/'; ?>
<?php $webStylePath = '/vendor-mmlc/robinthehood/modified-ui/Templates/Styles/'; ?>
    <link href="<?php echo $webStylePath; ?>fontawesome.all.css" rel="stylesheet"> <!--load all styles -->

        <style type="text/css">
            <?php include $stylePath . 'Page.css'; ?>
            <?php include $stylePath . 'SplitPanel.css'; ?>
            <?php include $stylePath . 'ActionPanel.css'; ?>
            <?php include $stylePath . 'FilterPanel.css'; ?>
            <?php include $stylePath . 'Heading.css'; ?>
            <?php include $stylePath . 'Input.css'; ?>
            <?php include $stylePath . 'TabPanel.css'; ?>
            <?php include $stylePath . 'Pagination.css'; ?>
            <?php include $stylePath . 'Table.css'; ?>

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
        <?php if ($error ?? '') { ?>
            <div class="error-message">
                Fehler: <?php echo $error; ?>
            </div>
        <?php } ?>

        <div class="rth-modified-ui-page">
            <?php echo $this->heading->render() ?>
            <?php echo $this->pageNavigation ?? ''; ?>
            <?php echo $this->content ?? ''; ?>
        </div>

        <!-- Footer -->
        <?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
        <br>

        <script type="text/javascript">
            // $('tbody').sortable({
            //     axis: "y",
            //     update: function(event, ui) {
            //         var rows = $('tbody tr');
            //         console.log(rows);
            //     }
            // });
        </script>
    </body>
</html>

<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
