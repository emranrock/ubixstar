<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>YourLibaas</b> Admin Panel | Version 1.0
  </div>
  <strong>Copyright &copy; 2018-<?= date('Y'); ?> <a href="#" target="_blank">YourLibaas</a>.</strong> All rights reserved.
</footer>


<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url('assets/admin/plugins/jquery-ui/jquery-ui.min.js'); ?>" type="text/javascript"></script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?= base_url('assets/admin/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script>

<script src="<?= base_url('assets/admin/js/jquery.validate.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/admin/plugins/bootstrap-daterangepicker/daterangepicker.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/admin/plugins/iCheck/icheck.min.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/admin/plugins/pace/pace.min.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/admin/plugins/select2/select2.full.min.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/admin/plugins/datatables/jquery.dataTables.min.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/admin/plugins/datatables/dataTables.bootstrap.min.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js'); ?>" type="text/javascript"></script>
<script>
        var AdminLTEOptions = {
        //Add slimscroll to navbar menus
        //This requires you to load the slimscroll plugin
        //in every page before app.js
        navbarMenuSlimscroll: true,
        navbarMenuSlimscrollWidth: "3px", //The width of the scroll bar
        navbarMenuHeight: "200px", //The height of the inner menu
        //General animation speed for JS animated elements such as box collapse/expand and
        //sidebar treeview slide up/down. This option accepts an integer as milliseconds,
        //'fast', 'normal', or 'slow'
        animationSpeed: 500,
        //Sidebar push menu toggle button selector
        sidebarToggleSelector: "[data-toggle='offcanvas']",
        //Activate sidebar push menu
        sidebarPushMenu: true,
        //Activate sidebar slimscroll if the fixed layout is set (requires SlimScroll Plugin)
        sidebarSlimScroll: true,
        //Enable sidebar expand on hover effect for sidebar mini
        //This option is forced to true if both the fixed layout and sidebar mini
        //are used together
        sidebarExpandOnHover: false,
        //BoxRefresh Plugin
        enableBoxRefresh: true,
        //Bootstrap.js tooltip
        enableBSToppltip: true,
        BSTooltipSelector: "[data-toggle='tooltip']",
        //Enable Fast Click. Fastclick.js creates a more
        //native touch experience with touch devices. If you
        //choose to enable the plugin, make sure you load the script
        //before AdminLTE's app.js
        enableFastclick: true,
        //Control Sidebar Tree Views
        enableControlTreeView: true,
        //Control Sidebar Options
        enableControlSidebar: false,
        controlSidebarOptions: {
          //Which button should trigger the open/close event
          toggleBtnSelector: "[data-toggle='control-sidebar']",
          //The sidebar selector
          selector: ".control-sidebar",
          //Enable slide over content
          slide: true
        },
        //Box Widget Plugin. Enable this plugin
        //to allow boxes to be collapsed and/or removed
        enableBoxWidget: true,
        //Box Widget plugin options
        boxWidgetOptions: {
          boxWidgetIcons: {
            //Collapse icon
            collapse: 'fa-minus',
            //Open icon
            open: 'fa-plus',
            //Remove icon
            remove: 'fa-times'
          },
          boxWidgetSelectors: {
            //Remove button selector
            remove: '[data-widget="remove"]',
            //Collapse button selector
            collapse: '[data-widget="collapse"]'
          }
        },
        //Direct Chat plugin options
        directChat: {
          //Enable direct chat by default
          enable: true,
          //The button to open and close the chat contacts pane
          contactToggleSelector: '[data-widget="chat-pane-toggle"]'
        },
        //Define the set of colors to use globally around the website
        colors: {
          lightBlue: "#3c8dbc",
          red: "#f56954",
          green: "#00a65a",
          aqua: "#00c0ef",
          yellow: "#f39c12",
          blue: "#0073b7",
          navy: "#001F3F",
          teal: "#39CCCC",
          olive: "#3D9970",
          lime: "#01FF70",
          orange: "#FF851B",
          fuchsia: "#F012BE",
          purple: "#8E24AA",
          maroon: "#D81B60",
          black: "#222222",
          gray: "#d2d6de"
        },
        //The standard screen sizes that bootstrap uses.
        //If you change these in the variables.less file, change
        //them here too.
        screenSizes: {
          xs: 480,
          sm: 768,
          md: 992,
          lg: 1200
        }
      };
      </script>
<script src="<?= base_url('assets/admin/dist/js/app.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/admin/dist/js/demo.js'); ?>" type="text/javascript"></script>
<script src="<?= base_url('assets/admin/js/common.js'); ?>" type="text/javascript"></script>
</body>

</html>