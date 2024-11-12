<div class="window dashboard hide" id="dashboard">
	<?php require_once("./partials/popup_add_new.php"); ?>
	<div class="container">
		<div class="header">
			<div>
				<h1 class="logo">
					<img src="https://d2k5nsl2zxldvw.cloudfront.net/images/brand/expensify-logo-green.svg" alt="" width="200px">
					<p>Transactions Dashboard</p>
				</h1>
			</div>
			
			<div>
				<button onClick="toggle_el('overlay')"  id="addNew">
					<strong><i class="fa fa-plus"></i> Add New</strong>
				</button>
				<button onClick="process_logout()"  id="logoutLink">
					<strong><i class="fa fa-sign-out"></i></strong>
				</button>
			</div>
		</div>

		<?php require_once("./partials/dashboard_filters.php"); ?>

		<div id="transactionTable">
			<table cellspacing="0px" cellpadding="0px">
				<thead>
					<tr>
						<th>Transaction Date</th>
						<th>Merchant</th>
						<th>Type</th>
						<th>Amount</th>
						<th>Card Name</th>
					</tr>
				</thead>

				<tbody id="transactionTableBody"></tbody>
			</table>
		</div>
	</div>
</div>