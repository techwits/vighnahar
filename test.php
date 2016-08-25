<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Limitless - Responsive Web Application Kit by Eugene Kopyov</title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
    <link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
    <link href="assets/css/core.css" rel="stylesheet" type="text/css">
    <link href="assets/css/components.css" rel="stylesheet" type="text/css">
    <link href="assets/css/colors.css" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <!-- Core JS files -->
    <script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>
    <script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
    <script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="assets/js/plugins/forms/styling/uniform.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/styling/switchery.min.js"></script>
    <script type="text/javascript" src="assets/js/plugins/forms/styling/switch.min.js"></script>

    <script type="text/javascript" src="assets/js/core/app.js"></script>
    <script type="text/javascript" src="assets/js/pages/form_checkboxes_radios.js"></script>
    <!-- /theme JS files -->

</head>

<body>


                <!-- Switchery toggles -->
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Switchery toggles</h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                                <li><a data-action="close"></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="row">


                            <div class="col-md-6">
                                <div class="content-group-lg">
                                    <h6 class="text-semibold">Switcher colors</h6>
                                    <p class="content-group">You can change the default color of the switch to fit your design perfectly. According to the color system, any of its color can be applied to the switchery. Custom colors are also supported.</p>

                                    <div class="checkbox checkbox-switchery">
                                        <label>
                                            <input type="checkbox" class="switchery-primary" checked="checked">
                                            Switch in <span class="text-semibold">primary</span> context
                                        </label>
                                    </div>

                                    <div class="checkbox checkbox-switchery">
                                        <label>
                                            <input type="checkbox" class="switchery-danger" checked="checked">
                                            Switch in <span class="text-semibold">danger</span> context
                                        </label>
                                    </div>

                                    <div class="checkbox checkbox-switchery">
                                        <label>
                                            <input type="checkbox" class="switchery-info" checked="checked">
                                            Switch in <span class="text-semibold">info</span> context
                                        </label>
                                    </div>

                                    <div class="checkbox checkbox-switchery">
                                        <label>
                                            <input type="checkbox" class="switchery-warning" checked="checked">
                                            Switch in <span class="text-semibold">warning</span> context
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>


                        </div>
                    </div>
                </div>
                <!-- /switchery toggles -->


                <!-- Bootstrap switch -->
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h5 class="panel-title">Bootstrap switch</h5>
                        <div class="heading-elements">
                            <ul class="icons-list">
                                <li><a data-action="collapse"></a></li>
                                <li><a data-action="reload"></a></li>
                                <li><a data-action="close"></a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="content-group">
                                    <h6 class="text-semibold">Switch states</h6>
                                    <p>By default Bootstrap Switch supports standard attributes for checkboxes such as <code>disabled</code>, <code>checked</code> and <code>readonly</code> or use <code>true</code> or <code>false</code> in plugin options.</p>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="checkbox checkbox-switch">
                                                <label>
                                                    <input type="checkbox" class="switch" data-on-text="On" data-off-text="Off" checked="checked">
                                                    Checked switch
                                                </label>
                                            </div>

                                            <div class="checkbox checkbox-switch">
                                                <label>
                                                    <input type="checkbox" data-on-text="On" data-off-text="Off" class="switch" checked="checked" disabled="disabled">
                                                    Checked disabled
                                                </label>
                                            </div>

                                            <div class="checkbox checkbox-switch">
                                                <label>
                                                    <input type="checkbox" data-on-text="On" data-off-text="Off" class="switch" readonly="readonly" checked="checked">
                                                    Checked readonly
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="checkbox checkbox-switch">
                                                <label>
                                                    <input type="checkbox" data-on-text="On" data-off-text="Off" class="switch">
                                                    Unchecked switch
                                                </label>
                                            </div>

                                            <div class="checkbox checkbox-switch">
                                                <label>
                                                    <input type="checkbox" data-on-text="On" data-off-text="Off" class="switch" disabled="disabled">
                                                    Unchecked disabled
                                                </label>
                                            </div>

                                            <div class="checkbox checkbox-switch">
                                                <label>
                                                    <input type="checkbox" data-on-text="On" data-off-text="Off" class="switch" readonly="readonly">
                                                    Unchecked readonly
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="content-group">
                                    <h6 class="text-semibold">Switch colors</h6>
                                    <p>You can change the default color of the switch by choosing one of 6 predefined classes and use them in <code>data-on-color</code> and <code>data-off-color</code> attributes.</p>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="checkbox checkbox-switch">
                                                <label>
                                                    <input type="checkbox" class="switch" data-on-text="On" data-off-text="Off" data-on-color="default" data-off-color="danger" checked="checked">
                                                    Default color
                                                </label>
                                            </div>

                                            <div class="checkbox checkbox-switch">
                                                <label>
                                                    <input type="checkbox" class="switch" data-on-text="On" data-off-text="Off" data-on-color="primary" data-off-color="default" checked="checked">
                                                    Primary color
                                                </label>
                                            </div>

                                            <div class="checkbox checkbox-switch">
                                                <label>
                                                    <input type="checkbox" class="switch" data-on-text="On" data-off-text="Off" data-on-color="danger" data-off-color="default" checked="checked">
                                                    Danger color
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                            <div class="checkbox checkbox-switch">
                                                <label>
                                                    <input type="checkbox" class="switch" data-on-text="On" data-off-text="Off" data-on-color="success" data-off-color="default" checked="checked">
                                                    Success color
                                                </label>
                                            </div>

                                            <div class="checkbox checkbox-switch">
                                                <label>
                                                    <input type="checkbox" class="switch" data-on-text="On" data-off-text="Off" data-on-color="warning" data-off-color="default" checked="checked">
                                                    Warning color
                                                </label>
                                            </div>

                                            <div class="checkbox checkbox-switch">
                                                <label>
                                                    <input type="checkbox" class="switch" data-on-text="On" data-off-text="Off" data-on-color="info" data-off-color="default" checked="checked">
                                                    Info color
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="content-group">
                                    <h6 class="text-semibold">Switch sizes</h6>
                                    <p>Default height is equal to input field height, but you can also choose one of 4 available sizes (large, small and mini) by changing <code>data-size</code> attribute.</p>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="checkbox checkbox-switch">
                                                <label>
                                                    <input type="checkbox" class="switch" data-on-text="On" data-off-text="Off" data-size="large" checked="checked">
                                                    Large switch
                                                </label>
                                            </div>

                                            <div class="checkbox checkbox-switch">
                                                <label>
                                                    <input type="checkbox" data-on-text="On" data-off-text="Off" class="switch" data-size="small" checked="checked">
                                                    Small switch
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="checkbox checkbox-switch">
                                                <label>
                                                    <input type="checkbox" data-on-text="On" data-off-text="Off" class="switch" checked="checked">
                                                    Default switch
                                                </label>
                                            </div>

                                            <div class="checkbox checkbox-switch">
                                                <label>
                                                    <input type="checkbox" data-on-text="On" data-off-text="Off" class="switch" data-size="mini" checked="checked">
                                                    Mini switch
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="content-group">
                                    <h6 class="text-semibold">Label options</h6>
                                    <p>Labels support any text or icon via <code>data-on-text</code> and <code>data-off-text</code> attributes. If no custom text specified, switch will display default on/off text.</p>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="checkbox checkbox-switch">
                                                <label>
                                                    <input type="checkbox" data-off-color="danger" data-on-text="Yes" data-off-text="No" class="switch" checked="checked">
                                                    Default text
                                                </label>
                                            </div>

                                            <div class="checkbox checkbox-switch">
                                                <label>
                                                    <input type="checkbox" data-on-color="warning" data-off-color="info" data-on-text="<i class='icon-link'></i>" data-off-text="<i class='icon-unlink'></i>" class="switch" checked="checked">
                                                    Icons only
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="checkbox checkbox-switch">
                                                <label>
                                                    <input type="checkbox" data-on-color="danger" data-off-color="primary" data-on-text="Enable" data-off-text="Disable" class="switch" checked="checked">
                                                    Enable/Disable
                                                </label>
                                            </div>

                                            <div class="checkbox checkbox-switch">
                                                <label>
                                                    <input type="checkbox" data-on-color="success" data-off-color="danger" data-on-text="Online" data-off-text="Offline" class="switch" checked="checked">
                                                    Online/Offline
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /bootstrap switch -->


                <!-- Footer -->
                <div class="footer text-muted">
                    &copy; 2015. <a href="#">Limitless Web App Kit</a> by <a href="http://themeforest.net/user/Kopyov" target="_blank">Eugene Kopyov</a>
                </div>
                <!-- /footer -->

            </div>
            <!-- /content area -->

        </div>
        <!-- /content wrapper -->

    </div>
    <!-- /page content -->

</div>
<!-- /page container -->

</body>
</html>
