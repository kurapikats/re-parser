(function(){
    //alert('http://www.zillow.com/webservice/GetRegionChildren.htm?zws-id=X1-ZWz1dlnsqnlmob_211k7&state=new%20york');

    var zws_id = 'X1-ZWz1dlnsqnlmob_211k7';
    var state = 'new york';
    var api_url = 'http://www.zillow.com/webservice/GetRegionChildren.htm';

    $.get('proxy.php', {'url': api_url, 'zws-id': zws_id, 'state': state }, function(data) {
        //console.log(data);
    });

    var selected_state = getURLParameter('state');
    var selected_address = getURLParameter('addresses');

    set_opt_states();

    if (selected_state !== null) {
        setSelectedState(selected_state);
        setDropdownAddresses(selected_state);
    } else {
        setDropdownAddresses('AL');
    }

})();

function get_opt_addresses(elm) {
    var states = document.getElementById("states");
    var my_state = states.options[states.selectedIndex].value;

    setDropdownAddresses(my_state);
}

function setDropdownAddresses(state) {
    var opt_states = document.getElementById(state);
    var dropdown_addresses = $('#addresses');
    dropdown_addresses.html($(opt_states).html());
}

function getURLParameter(name) {
    return decodeURI(
        (RegExp(name + '=' + '(.+?)(&|$)').exec(location.search)||[,null])[1]
    );
}

function setSelectedState(state) {
    var element = document.getElementById('states');
    element.value = state;
}

function highlightSearch() {
    //$('#btn-search').toggleClass('btn-primary');
    $('#btn-search').focus();
}

function set_opt_states() {
    var hidden_states = $('#hidden_states').html();
    var dropdown = $('#states');
    var dropdown_free = $('#states-free');
    dropdown.html(hidden_states);
    dropdown_free.html(hidden_states);
}

function highlightAddress() {
    $('#addresses-free').focus();
}