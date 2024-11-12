<div class="filters">
	<form id="filter-form">
		<div class="field">
			<div>
				<h4>Search for Merchant</h4>
				<input type="text" id="filterSearch" />
			</div>
		</div>

		<div class="field">
			<div>
				<h4>Minimum Amount</h4>
				<div class="field" style="margin: 0;">
					<div>
						<select name="currency" id="currencySelector"></select>
					</div>
					<div>
						<input 
							type="number" 
							id="filterMinAmount" 
							placeholder="Amount" 
							value=0
							min=0
						/>
					</div>
				</div>
				
			</div>
		</div>
		<div class="field">
			<div>
				<h4>Sort by:</h4>
				<select id="filterSort">
					<option value="desc">Date - Desc</option>
					<option value="asc">Date - Asc</option>
				</select>
			</div>
			<div>
				<h4>Type:</h4>
				<select id="filterType">
					<option value="">All</option>
					<option value="sale">Sale</option>
					<option value="return">Return</option>
				</select>
			</div>
		</div>
		<div class="field">
			<div>
				<h4>Options:</h4>

				<label for="filterBillable">
					<input type="checkbox" id="filterBillable" />
					Billable
				</label> 
				<br />
				<label for="filterReimb">
					<input type="checkbox" id="filterReimb" />
					Reimbursable 
				</label>
			</div>

			<div>
				<button type="button" onclick="render_transactions()">Apply</button>
			</div>
		</div>
	</form>
</div>