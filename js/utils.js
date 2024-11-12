const currencyMap = {
	'USD': '$',
	'EUR': '€',
	'GBP': '£',
	'PLN': 'zł',
	'AUD': 'A$',
	'COP': '$',
	'CAD': 'C$',
	'CHF': 'Fr',
	'INR': '₹',
	'AED': 'د.إ',
	'CNY': '¥',
	'JPY': '¥',
	'SGD': 'S$',
	'BHD': '.د.ب',
	'PYG': '₲',
	'BRL': 'R$'
};

function toggle_el(elID) {
	let loader = document.getElementById(elID);
	if (loader) {
		loader.classList.contains('hide') ? 
			loader.classList.remove('hide') : 
			loader.classList.add('hide')
	}
}

function close_modal() {
	document.getElementById('newTrForm').reset()
	toggle_el("overlay")
}

function show_error_toast(message) {
	$.toast({
		heading: 'Error',
		text: message,				
		icon: 'error',
		bgColor: 'marron',
		loaderBg: 'red'
	})
}

function show_success_toast(message) {
	$.toast({
		heading: 'Success',
		text: message,				
		icon: 'success',
		bgColor: 'var(--ex-light)',
		textColor: 'var(--ex-dark)',
		loaderBg: 'var(--ex-dark)'
	})
}

function reset_forms() {
	document.getElementById('filter-form').reset()
	document.getElementById('newTrForm').reset()
}

function session_logout() {
	$.post("/api?command=logout");
	toggle_el('loginForm');
}

function currency_to_sumbol (currencyCode) {
	return currencyMap[currencyCode] || `(${currencyCode})`;
};

function fill_currency_filter () {
	let currency_options = `<option value="">Any Currency</option>`;
	Object.keys(currencyMap).forEach(cr => {
		currency_options += `<option value="${cr}">${cr} (${currency_to_sumbol(cr)})</option>`
	})
	document.getElementById("currencySelector").innerHTML = currency_options;
}

function new_tr_currency_options () {
	let currency_options = ``;
	Object.keys(currencyMap).forEach(cr => {
		currency_options += `<option value="${cr}">${cr} (${currency_to_sumbol(cr)})</option>`
	})
	document.getElementById("newTrCurrency").innerHTML = currency_options;
}