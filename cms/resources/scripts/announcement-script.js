const apiUrl = window.location.origin + '/api/';
let deletes = []
let oldAnnouncements = {};

$(document).ready(function() {
    // get announcements
    $.get(apiUrl + 'announcement', fillAnnouncements, 'json');

    // make items sortable
    new Sortable(document.querySelector('#announcements'), {
        animation: 150,
        ghostClass: 'ghost',
        handle: '.drag-handle'
    });
});

/**
 * Add announcements to the page
 */
function fillAnnouncements(announcements) {
    if(announcements.length === 0)
        return;

    const container = $('#announcements');
    announcements.forEach(a => {
        container.append(`
            <div id="announcement_${a['id']}" class="announcement list-group-item d-flex justify-content-between align-items-center">
                <i class="fas fa-bars drag-handle" aria-hidden="true"></i>
                <div class="d-flex flex-column w-75">
                    <input class="title form-control w-50 mb-1" type="text" placeholder="Title" value="${a['title']}">
                    <textarea class="description form-control w-100" placeholder="Description...">${a['description']}</textarea>
                </div>
                <i class="far fa-times-circle delete" aria-hidden="true" onclick="deleteAnnouncement(this)"></i>
            </div>
        `);

        oldAnnouncements[a['id']] = a;
    });
}

/**
 * Remove an announcement
 * Add to modified object
 */
function deleteAnnouncement(e) {
    const container = $(e.parentElement);
    if(container.attr('id'))
        deletes.push(parseInt(container.attr('id').split('_')[1]));
    container.remove();
}

/**
 * Add a blank announcement to the page
 */
function addAnnouncement() {
    const container = $('#announcements');

    const announcement = $(`
        <div class="announcement list-group-item d-flex justify-content-between align-items-center">
            <i class="fas fa-bars drag-handle" aria-hidden="true"></i>
            <div class="d-flex flex-column w-75">
                <input class="title form-control w-50 mb-1" type="text" placeholder="Title">
                <textarea class="description form-control w-100" placeholder="Description..."></textarea>
            </div>
            <i class="far fa-times-circle delete" aria-hidden="true" onclick="deleteAnnouncement(this)"></i>
        </div>
    `);
    container.append(announcement);

    // focus on the new element
    announcement.find('.title').focus();
}

/**
 * Save all changes made
 */
function save() {
    startSpinner();

    const updates = {
        'delete': deletes,
        'add': [],
        'update': []
    }

    // fill adds and updates
    $('.announcement').each((i, a) => {
        if(a.id === ''){
            updates['add'].push({
                'position': i,
                'title': $(a).find('.title').val(),
                'description': $(a).find('.description').val()
             });
        }
        else if(changed(a, i)){
            updates['update'].push({
                'id': parseInt(a.id.split('_')[1]),
                'position': i,
                'title': $(a).find('.title').val(),
                'description': $(a).find('.description').val()
            });
        }
    });

    // make request
    $.ajax({
        url: apiUrl + 'announcement',
        type: 'POST',
        success: (ids) => {addNewIds(ids); showSuccess();},
        error: showError,
        complete: stopSpinner,
        data: JSON.stringify(updates),
        dataType: 'json'
    });

    deletes = [];
}

/**
 * Check whether the given announcement was updated
 */
function changed(a, pos) {
    const id = a.id.split('_')[1];
    const title = $(a).find('.title').val();
    const desc = $(a).find('.description').val();
    const old = oldAnnouncements[id];

    return (title !== old['title']) || (desc !== old['description']) || (pos !== parseInt(old['position']));
}

/**
 * Add the new ids
 */
function addNewIds(ids) {
    $('.announcement').each((i, a) => {
        if(a.id === '') {
            id = ids.shift();
            a.id = 'announcement_' + id;
        }
    });
}