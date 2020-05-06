const modified = new Set();
const apiUrl = window.location.origin + '/api/';

$(document).ready(function() {
    // get about
    $.get(apiUrl + 'other', {'id': 1}, (data)=>{fillInfo(data, '#about')}, 'json');
    // get catering info
    $.get(apiUrl + 'other', {'id': 2}, (data)=>{fillInfo(data, '#catering')}, 'json');
    // get hours
    $.get(apiUrl + 'other', {'id': 3}, (data)=>{fillInfo(data, '#hours')}, 'json');

    //listen for changes
    $('textarea').change((e) => {
        modified.add('#' + e.target.id);
    });
});

/**
 * Insert the information into the given container
 */
function fillInfo(data, containerID) {
    $(containerID).text(data['sectionText']);
}

/**
 * Save the modified info
 */
function save() {
    if(modified.size === 0)
        return;

    startSpinner();

    // create updates object
    const updates = []
    modified.forEach(id => {

        const text = $(id)[0].value;
        let ID = 0;
        if(id === '#about')
            ID = 1;
        else if(id === '#catering')
            ID = 2;
        else
            ID = 3;

        updates.push({'id': ID, 'info': text});
    });

    // make request
    $.ajax({
        url: apiUrl + 'other',
        type: 'PUT',
        success: showSuccess,
        error: showError,
        complete: stopSpinner,
        data: JSON.stringify(updates)
    });

    modified.clear();
}