$(document).ready(function() {
    $.get(window.location.origin + '/api/menu', {'type': 'regular'}, fillMenu, 'json');
});

/**
 * Fill in the menu
 */
function fillMenu(menu) {
    const menuContainer = $('#regular');
    const nav = $('#sidenav');

    menu.forEach(section => {
        // create the navbar item
        nav.append(`<a class="navlink" href="#${section['sectionName']}">${section['sectionName']}</a>`);
        
        // create the section
        const sectionContainer = $(`
            <div class="menu_section d-flex flex-wrap justify-content-between" id="${section['sectionName']}">
                <h3 class="section-title w-100">${section['sectionName']}</h3>
            </div>
        `);

        // add section description
        if(section['sectionDescription'] !== '')
            sectionContainer.append(`<p class="section-description w-100 p-3 font-italic">${section['sectionDescription']}</p>`);
        
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