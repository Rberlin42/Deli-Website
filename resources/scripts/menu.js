async function getRegularMenu() {
    if (document.getElementById('regular')) {
        let menu = await fetch('/backend-controllers/menu_controller.php?menu_type=regular');
        menu = await menu.json();
        fillInMenu(menu, 'regular');
    }
}

async function getSpecialMenu() {
    if (document.getElementById("specials")) {
        let menu = await fetch('/backend-controllers/menu_controller.php?menu_type=special');
        menu = await menu.json();
        fillInMenu(menu, 'specials');
    }
}

async function getCateringMenu() {
    // Only intialize the menu if there is a div for that menu
    if (document.getElementById("catering")) {
        let menu = await fetch('/backend-controllers/menu_controller.php?menu_type=catering');
        menu = await menu.json();
        fillInMenu(menu, 'catering');
    }
}

function fillInMenu(menu, type) {
    //hide the specials menu if its empty
    if(type === 'specials' && menu.length === 0)
        document.querySelector('#specials-container').style.display = 'none';

    let current_section = '';
    let sectionItemCount = 0;
    for (let i = 0; i < menu.length; i++) {
        // Means we got a new sections and must set up the necessary sections
        if (menu[i].section != current_section) {
            sectionItemCount = 0;
            current_section = menu[i].section;

            // add to sidenav
            if(type === 'regular') {
                const listItem = document.createElement('a');
                listItem.classList.add('navlink');
                listItem.href = '#' + current_section;
                listItem.innerHTML = current_section;
                document.querySelector('#sidenav').append(listItem);
            }

            // add section container
            const section = document.createElement('div');
            section.classList.add('menu_section', 'd-flex', 'flex-wrap', 'justify-content-between');
            section.id = current_section;
            const section_title = document.createElement('h3');
            section_title.classList.add('section-title', 'w-100');
            section_title.textContent = menu[i].section;
            section.append(section_title);
            document.querySelector('#' + type).append(section);
        }

        const menu_item = document.createElement('div');
        if(type !== 'specials') {
            menu_item.classList.add('item', 'col-lg-6');
            if(sectionItemCount % 2 === 0)
                menu_item.classList.add('pr-xl-5', 'pr-lg-4');
            else
                menu_item.classList.add('pl-xl-5', 'pl-lg-4');
        }
        else {
            menu_item.classList.add('item', 'w-100', 'mx-auto');
        }

        const menu_item_name = document.createElement('h5');
        menu_item_name.classList.add('item-name');
        menu_item_name.innerHTML = `${menu[i].name}<span class='price'>${menu[i].price}</span>`;
        const item_description = document.createElement('p');
        item_description.textContent = menu[i].description;
        menu_item.appendChild(menu_item_name);
        menu_item.appendChild(item_description);
        document.querySelector('.menu_section:last-child').append(menu_item);
        sectionItemCount++;
    }
}
getSpecialMenu();
getRegularMenu();
getCateringMenu();