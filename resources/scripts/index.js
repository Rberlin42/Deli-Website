const apiUrl = window.location.origin + '/api/';

$(document).ready(function(){
    // get announcements
    $.get(apiUrl + 'announcement', insertAnnouncements, "json");
    // get welcome blurb
    $.get(apiUrl + 'other', {'id': 1}, insertWelcomeMessage, "json");
    // get hours
    $.get(apiUrl + 'other', {'id': 3}, insertHours, "json");
    // get specials
    $.get(apiUrl + 'menu', {'type': 'special'}, insertSpecials, "json");
});

/**
 * Add announcements to the page
 * Start the cycle
 */
function insertAnnouncements(announcements) {
    if(announcements.length === 0) {
        $('#announcements').hide();
        return;
    }

    const container = $('#announcement-cards');
    announcements.forEach(a => {
        const announcement = $(`
            <div class='hidden-announcement'>
                <h3>${a['title']}</h3>
                <p>${a['description']}</p>
            </div>
        `);

        container.append(announcement);
    });

    cycleAnnouncements();
}

/**
 * set an interval to cycle through the announcements
 */
function cycleAnnouncements() {
    const announcements = $('#announcement-cards div');
    const index = $('#announce-index');
    index.text('1/' + announcements.length);

    // initialze first announcement
    announcements[0].classList.remove('hidden-announcement');
    let current_announcement = 0;

    // function to switch the announcement
    const nextAnnouncment = () => {
        announcements[current_announcement].classList.add('hidden-announcement');
        if (current_announcement === announcements.length - 1) {
            current_announcement = 0;
        } else {
            current_announcement++;
        }
        announcements[current_announcement].classList.remove('hidden-announcement');
        index.text((current_announcement+1) + '/' + announcements.length);
    };

    setInterval(nextAnnouncment, 7000);
}

/**
 * insert the welcome message
 */
function insertWelcomeMessage(data) {
    const message = nl2br(data['sectionText']);
    $('#welcome-blurb').html(message);
}

/**
 * insert the hours
 */
function insertHours(data) {
    const hours = nl2br(data['sectionText']);
    $('#hours').html(hours);
}

/**
 * convert new lines to <br> tags
 */
function nl2br(str, is_xhtml) {   
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';    
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
}

/**
 * Insert the specials menu
 */
function insertSpecials(menu) {
    // hide if its empty
    if(menu.length === 0) {
        $('#specials-container').hide();
        return;
    }

    const container = $('#specials');
    menu.forEach(section => {
        const sectionContainer = $(`
            <div class="menu_section d-flex flex-wrap justify-content-between">
                <h3 class="section-title w-100">${section['sectionName']}</h3>
            </div>
        `);

    // add section description
    if(section['sectionDescription'] !== '')
        sectionContainer.append(`<p class="section-description w-100 p-3 font-italic">${section['sectionDescription']}</p>`);
        
        section['items'].forEach(item => {
            const itemContainer = $(`
                <div class="item w-100 mx-auto">
                    <h5 class="item-name">
                        ${item['name']}
                        <span class="price">${item['price']}</span>
                    </h5>
                    <p>${item['description']}</p>
                </div>
            `);
            sectionContainer.append(itemContainer);
        });
        
        container.append(sectionContainer);
    });
}