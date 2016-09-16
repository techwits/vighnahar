<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SVL RM Print</title>

	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="assets/css/bootstrap.css" rel="stylesheet" type="text/css">
	<link href="assets/css/core.css" rel="stylesheet" type="text/css">
	<link href="assets/css/components.css" rel="stylesheet" type="text/css">
	<link href="assets/css/colors.css" rel="stylesheet" type="text/css">
	<link href="assets/css/icons/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/extras/animate.min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/hover-min.css" rel="stylesheet" type="text/css">
	<link href="assets/css/hover" rel="stylesheet" type="text/css">
    <link href="assets/css/print_bill.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->

	<!-- Core JS files -->
	<script type="text/javascript" src="assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/loaders/blockui.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/ui/nicescroll.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/ui/drilldown.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="assets/js/plugins/tables/datatables/datatables.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/tables/datatables/extensions/fixed_header.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/tables/datatables/extensions/col_reorder.min.js"></script>
	<script type="text/javascript" src="assets/js/plugins/forms/styling/switchery.min.js"></script>

	<script type="text/javascript" src="assets/js/pages/datatables_extension_fixed_header.js"></script>
    <script type="text/javascript" src="assets/js/layout_sidebar_sticky.js"></script>
	<!-- /theme JS files -->
    <script type="text/javascript" src="assets/js/plugins/media/fancybox.min.js"></script>

	<script type="text/javascript" src="assets/js/core/app.js"></script>
	<script type="text/javascript" src="assets/js/pages/gallery.js"></script>
    <!-- Theme JS files -->
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>

	<script type="text/javascript" src="assets/js/pages/invoice_template.js"></script>
	<!-- /theme JS files -->

</head>


<body class="print-mode print-paper-a4">
        <div class="print-papers print-preview">
            <div class="print-paper">
            
				<!-- Invoice template -->
                
                <div class="invoice-top">
                  <div class="row">
                    <div class="invoice-button">
                        <div class="heading-btn text-right">
                            <button type="button" class="btn btn-default btn-xs heading-btn"><i class="icon-file-check position-left"></i> Save</button>
                            <button type="button" class="btn btn-default btn-xs heading-btn"><i class="icon-printer position-left"></i> Print</button>
                        </div>
                    </div>
                  </div>
	                <div class="row">
                        <div class="content-add">
                            <img src="assets/images/logo_svl.png" class="content-group mt-10" alt="" style="width: 120px;">
                            <ul class="list-condensed list-unstyled">
                                <li>2269 Elba Lane</li>
                                <li>Paris, France</li>
                                <li>888-555-2311</li>
                            </ul>
                        </div>

                        <div class="content-date">
                            <div class="invoice-details">
                                <h5 class="text-uppercase text-semibold">Invoice #49029</h5>
                                <ul class="list-condensed list-unstyled">
                                    <li>Date: <span class="text-semibold">January 12, 2015</span></li>
                                    <li>Due date: <span class="text-semibold">May 12, 2015</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="content-group text-right">
                          <span class="text-muted">Invoice To:</span>
                          <ul class="list-condensed list-unstyled">
                              <li><h5>Rebecca Manes</h5></li>
                              <li><span class="text-semibold">Normand axis LTD</span></li>
                              <li>3 Goodman Street</li>
                              <li>London E1 8BF United Kingdom</li>
                              <li>888-555-2311</li>
                              <li><a href="#">rebecca@normandaxis.ltd</a></li>
                          </ul>
                      </div>
                  </div>
                </div>
                <div class="invoice-detail">
                  <div class="table-responsive">
                      <table class="table table-lg">
                          <thead>
                              <tr>
                                  <th>Description</th>
                                  <th class="col-sm-1">Rate</th>
                                  <th class="col-sm-1">Hours</th>
                                  <th class="col-sm-1">Total</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                  <td>
                                      <h6 class="no-margin">Create UI design model</h6>
                                      <span class="text-muted">One morning, when Gregor Samsa woke from troubled.</span>
                                  </td>
                                  <td>$70</td>
                                  <td>57</td>
                                  <td><span class="text-semibold">$3,990</span></td>
                              </tr>
                              <tr>
                                  <td>
                                      <h6 class="no-margin">Support tickets list doesn't support commas</h6>
                                      <span class="text-muted">I'd have gone up to the boss and told him just what i think.</span>
                                  </td>
                                  <td>$70</td>
                                  <td>12</td>
                                  <td><span class="text-semibold">$840</span></td>
                              </tr>
                              <tr>
                                  <td>
                                      <h6 class="no-margin">Fix website issues on mobile</h6>
                                      <span class="text-muted">I am so happy, my dear friend, so absorbed in the exquisite.</span>
                                  </td>
                                  <td>$70</td>
                                  <td>31</td>
                                  <td><span class="text-semibold">$2,170</span></td>
                              </tr>
                          </tbody>
                      </table>
                  </div>
                </div>
                <div class="invoice-payment">
                  <div class="content-payment">
                      <h6>Authorized person</h6>
                      <div class="mb-15 mt-15">
                          <img src="assets/images/signature.png" class="display-block" style="width: 150px;" alt="">
                      </div>
  
                      <ul class="list-condensed list-unstyled text-muted">
                          <li>Eugene Kopyov</li>
                          <li>2269 Elba Lane</li>
                          <li>Paris, France</li>
                          <li>888-555-2311</li>
                      </ul>
                  </div>

                  <div class="content-payment-total">
                    <h6>Total due</h6>
                    <div class="table-responsive no-border">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th>Subtotal:</th>
                                    <td class="text-right">$7,000</td>
                                </tr>
                                <tr>
                                    <th>Tax: <span class="text-regular">(25%)</span></th>
                                    <td class="text-right">$1,750</td>
                                </tr>
                                <tr>
                                    <th>Total:</th>
                                    <td class="text-right text-primary"><h5 class="text-semibold">$8,750</h5></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                          <div class="text-right">
                              <button type="button" class="btn btn-primary btn-labeled"><b><i class="icon-paperplane"></i></b> Send invoice</button>
                          </div>
                      </div>
                      <div class="text-right">
                          <h6>Other information</h6>
							<p class="text-muted">Thank you for using Limitless. This invoice can be paid via PayPal, Bank transfer, Skrill or Payoneer. Payment is due within 30 days from the date of delivery. Late payment is possible, but with with a fee of 10% per month. Company registered in England and Wales #6893003, registered office: 3 Goodman Street, London E1 8BF, United Kingdom. Phone number: 888-555-2311</p>
                      </div>
                  </div>
              </div
                
        </div>
  </body>