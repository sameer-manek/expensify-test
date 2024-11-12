// page specific script.
var transactions = [];

async function init() {
	var authenticated = parseInt(await $.post('/api?command=verifySession'))

	if (authenticated) {
		toggle_el('loginForm');

		show_dashboard().catch(err => {
			show_error_toast("there was and error fetching records, please refresh the page.")
			console.log("there was some error fetching records", err)
		});
	}
}

function toggle_login_btn (text) {
	let btn = document.getElementById('login_btn')

	if (btn) {
		btn.disabled = !btn.disabled
		btn.innerHTML = text
	}
}

async function handle_login() {
	toggle_login_btn("Processing..")
	const username = document.getElementById("username").value
	const password = document.getElementById("password").value

	if (!username || !password || username === "" || password === "") {
		toggle_login_btn("Submit")
		show_error_toast("Invalid Input! Please try again.")
		return
	}

	const uri 	= "/api?command=login"
	const data 	= {
		partnerUserID: username,
		partnerUserSecret: password
	}
	try {
		const res 	= JSON.parse(await $.post(uri, data))
	
		if (res.success) {
			toggle_el('loginForm')
			document.getElementById("password").value = "" // reset pswd field.
			show_dashboard()
		} else {
			let error_message = "There was some issue on the backend. Please try again."
			switch (res.error_code) {
			case 401:
				error_message = "Invalid credentials. Please try again."
			case 404:
				error_message = "User not found. Please check the email."
			default:
				show_error_toast(error_message)
			}
		}
	} catch {
		show_error_toast("We experienced a problem fetching data, Please try again or raise a support ticket. We're sorry for the inconvenience")
	}

	toggle_login_btn("Submit")
}

async function apply_filters(trns = transactions) {
	let search 		= document.getElementById('filterSearch').value || ""
	let sort 		= document.getElementById('filterSort').value || "desc"
	let currency 	= document.getElementById('currencySelector').value
	let min_amt 	= parseFloat(document.getElementById('filterMinAmount').value || 0) - 1
	let type		= document.getElementById("filterType").value
	let billable 	= document.getElementById('filterBillable').checked
	let reimburse 	= document.getElementById('filterReimb').checked

	let filtered_trns = []

	trns.forEach(t => {
		if (t.merchant.includes(search) && 
			t.reimbursable === reimburse && 
			t.billable === billable &&
			t.currency.includes(currency) &&
			(type === "" || (type !== "" && ((type === "sale" && t.amount < 0) || 
				(type === "return" && t.amount > -1)))) &&
			Math.abs(t.amount) > min_amt) {
			filtered_trns.push(t)
		}
	})

	if (sort === "asc") {
		filtered_trns.sort((a,b) => 
			(a.created > b.created) ? 
				1 : ((b.created > a.created) ? -1 : 0))
	} else {
		filtered_trns.sort((a,b) => 
			(a.created > b.created) ? 
				-1 : ((b.created > a.created) ? 1 : 0))
	}

	return filtered_trns
}

async function render_transactions() {
	let displayed_transactions = [...transactions];

	displayed_transactions = await apply_filters(displayed_transactions)

	$("#transactionTableBody").html("");

	let rows_html = ``

	displayed_transactions.forEach(tr => {
		rows_html += `
			<tr>
				<td>${tr.created}</td>
				<td>${tr.merchant}</td>
				<td>${tr.amount > -1 ? "Return" : "Sale"}</td>
				<td>${currency_to_sumbol(tr.currency)} ${Math.abs(tr.amount)}</td>
				<td>${tr.cardName}</td>
			</tr>
		`;
	});
	
	$("#transactionTableBody").append(rows_html);
}

async function show_dashboard() {
	toggle_el('loader')

	let uri 		= `/api?command=getTransactions`
	try {
		let data = JSON.parse(await $.post(uri));

		if (data.jsonCode !== 200) {
			if (res.jsonCode === 407) {
				show_error_toast("Your session has expired. Please login again.")
				session_logout();
			} 
			toggle_el('loader')
			return false;
		} else {
			if (data.transactionList) {
				fill_currency_filter();
				new_tr_currency_options();
				transactions = [...data.transactionList];
				render_transactions();
				toggle_el('loader');
				toggle_el('dashboard');
			}
		}
	} catch {
		session_logout();
		toggle_el('loader');
		show_error_toast("We experienced a problem fetching data, Please refresh the page or raise a support ticket. We're sorry for the inconvenience")
	}
	
}

async function create_transaction(btn) {
	btn.disabled = true
	btn.innerHTML = "Processing.."


	let merchant 	= document.getElementById('newTrMerchantName').value
	let currency 	= document.getElementById('newTrCurrency').value
	let amount 		= document.getElementById('newTrAmount').value
	let created		= document.getElementById('newTrDate').value

	if (!merchant || merchant === "" || 
		!amount || amount === "" ||
		!currency || currency === "" || 
		!created || created === "") {
		show_error_toast("Invalid Input")
		btn.disabled = false
		btn.innerHTML = "Add"
		return
	}

	const uri = "/api?command=addTransaction"

	let res = JSON.parse(await $.post(uri, 
		{merchant, currency, amount, created}))

	if(res.jsonCode !== 200) {
		if (res.jsonCode === 407) {
			process_logout()
			show_error_toast("Your session has expired. Please login again");
		}
		btn.disabled = false
		btn.innerHTML = "Add"
		return
	}

	/*
		[BugReport] : Billable and Reimbursable inside newly added 
		transaction is a string (eg. "false") instead of boolean like in response of 
		Get endpoint.
	*/

	if (res.transactionList) {
		res.transactionList.forEach(tr => {
			tr.billable = tr.billable !== "false"
			tr.reimbursable = tr.reimbursable !== "false"
			transactions.push(tr)
		})

	}

	await render_transactions()

	show_success_toast("transaction has been added.")
	btn.disabled = false
	btn.innerHTML = "Add"
	close_modal()
}

function process_logout() {
	// reset local data
	transactions = []
	reset_forms()

	toggle_el('dashboard')
	session_logout()
}

init()
