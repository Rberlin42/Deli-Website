const apiUrl = window.location.origin + '/api/';
$(document).ready(function() {
    // get catering info
    $.get(apiUrl + 'other', {'id': 2}, insertInfo, 'json');
    // get catering menu
    $.get(apiUrl + 'menu', {'type': 'catering'}, insertMenu, 'json');
});

/**
 * Insert catering info
 */
function insertInfo(data) {
    const info = nl2br(data['sectionText']);
    $('#catering-info').html(info);
}

/**
 * convert new lines to <br> tags
 */
function nl2br(str, is_xhtml) {   
    var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br />' : '<br>';    
    return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1'+ breakTag +'$2');
}

/**
 * Insert catering menu
 */
function insertMenu(menu) {
    const menuContainer = $('#catering');

    menu.forEach(section => {
        // create the section
        const sectionContainer = $(`
            <div class="menu_section d-flex flex-wrap justify-content-between" id="${section['sectionName']}">
                <h3 class="section-title w-100">${section['sectionName']}</h3>
            </div>
        `);
        
        // create each item
        section['items'].forEach(item => {
            const itemContainer = $(`
                <div class="item col-lg-6 pr-xl-5 pr-lg-4">
                    <h5 class="item-name">${item['name']}<span class="price">${item['price']}</span></h5>
                    <p>${item['description']}</p>
                </div>
            `);
            
            sectionContainer.append(itemContainer);
        });
        
        menuContainer.append(sectionContainer);
    });
}