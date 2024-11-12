<div id="overlay" class="hide">
	<div id="modal">
		<button type="button" id="close-window" onclick="close_modal()"><i class="fa fa-close"></i></button>
		<h3>Add Transaction</h3>
		<hr>
		<form id="newTrForm">
			<div class="field">
				<input 
					type="text" 
					placeholder="Merchant" 
					id="newTrMerchantName" 
				/>
			</div>

			<div class="field">
				<div>
					<select id="newTrCurrency" required>

					</select>
				</div>
				<div class="long">
					<input 
						type="number" 
						placeholder="Amount" 
						id="newTrAmount"
					/>
				</div>
				
			</div>

			<div class="field">
				<input 
					type="date" 
					placeholder="Select Date" 
					id="newTrDate"
					pattern="YYYY-MM-DD"
				/>
			</div>

			<div class="field">
				<button type="button" onclick="create_transaction(this)">Submit</button>
			</div>
		</form>
	</div>
</div>