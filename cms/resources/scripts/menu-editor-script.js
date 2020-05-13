const apiUrl = window.location.origin + '/api/';
let nextSectionId = 0;
let updates = {'deleteSection': [], 'addSection': [], 'updateSection': [], 'deleteItem': [], 'addItem': [], 'updateItem': []};
let oldMenu = {};

$(document).ready(function() {
  // get menu
  $.get(apiUrl + 'menu', {'type': TYPE}, fillMenu, 'json');

  // make sections sortable
  new Sortable(document.querySelector('#sections-list'), {
    animation: 150,
    ghostClass: 'ghost',
    handle: '.drag-handle'
  });
});

/**
 * Insert the menu editor
 */
function fillMenu(menu) {
  nextSectionId = menu.length;
  const sectionContainer = $('#sections-list');
  const addItemBefore = $('#add-item');
  
  menu.forEach((section, i) => {
    // add each section
    sectionContainer.append(`
      <div href="#" id="section_${section['sectionId']}" data-section-id="${i}" class="list-group-item" onclick="selectSection(this, ${i})">
        <div class="d-flex w-100 justify-content-between align-items-center">
          <i class="fas fa-bars drag-handle" aria-hidden="true"></i>
          <input class="section-name form-control w-75" type="text" value="${section['sectionName']}" placeholder="Section Name">
          <i class="far fa-times-circle delete" aria-hidden="true" onclick="deleteSection(this)"></i>
        </div>
      </div>
    `);

    // create an item group for this section
    const itemContainer = $(`<div data-section-id="${i}" class="items list-group"></div>`);

    const items = {}
    section['items'].forEach(item => {
      // add each item to the container
      itemContainer.append(`
        <div id="item_${item['id']}" class="item list-group-item d-flex w-100 justify-content-between align-items-center">
          <i class="fas fa-bars drag-handle" aria-hidden="true"></i>
          <div class="container w-75">
            <div class="row justify-content-between mb-1">
              <input class="item-name form-control col-6" type="text" value="${item['name']}" placeholder="Name">
              <input class="item-price form-control col-3" type="text" value="${item['price']}" placeholder="Price">
            </div>
            <div class="row">
              <textarea class="item-description form-control w-100" placeholder="Description...">${item['description']}</textarea>
            </div>
          </div>
          <i class="far fa-times-circle delete" aria-hidden="true" onclick="deleteItem(this)"></i>
        </div>
      `);

      items[item['id']] = item;
    });

    addItemBefore.before(itemContainer);

    // create old menu
    oldMenu[section['sectionId']] = section;
    oldMenu[section['sectionId']]['items'] = items;
  });

  // make items sortable
  document.querySelectorAll('.items').forEach(item => {
    new Sortable(item, {
      animation: 150,
      ghostClass: 'ghost',
      handle: '.drag-handle'
    });
  });

  // select first section
  selectSection();
}

/** 
 * change the selected menu section
 * if e is undefined, attempt to select the first section, otherwise hide the items
 */ 
function selectSection(e, id) {
  if(!e && $('#sections-list > .list-group-item').length === 0) {
    // hide items
    $('#menu-items').hide();
  }
  else {
    if(!e) {
      // select the first
      e = $('#sections-list > .list-group-item')[0];
      id = parseInt($(e).attr('data-section-id'));
    }
    
    // do nothing if the section doesnt exist
    if($(`.items[data-section-id = ${id}]`).length === 0)
      return;

    // highlight section name
    $('#sections-list > .list-group-item').removeClass('active');
    $(e).addClass('active');

    // show correct items
    $('.items').removeClass('selected-items');
    $(`.items[data-section-id = ${id}]`).addClass('selected-items');
  }
}

/**
 * Delete the menu section and all of its contents
 */
function deleteSection(e) {
  if(!confirm('Are you sure you want to delete this section and all of its contents?'))
    return;

  const section = $(e.parentElement.parentElement);
  const itemContainer = $(`.items[data-section-id = ${section.attr('data-section-id')}]`);

  // add to updates object if it wasn't a new section
  if(section.attr('id')) {
    updates['deleteSection'].push(parseInt(section.attr('id').split('_')[1]));
    itemContainer.children().each((i, item) => {
      updates['deleteItem'].push(parseInt(item.id.split('_')[1]))
    }); 
  }

  // remove from page
  section.remove();
  itemContainer.remove();

  // select another section
  selectSection();
}

/**
 * Delete the menu item
 */
function deleteItem(e) {
  const item = $(e.parentElement);
  if(item.attr('id'))
    updates['deleteItem'].push(parseInt(item.attr('id').split('_')[1]));
  item.remove();
}

/**
 * Add a new menu section
 */
function addSection() {
  $('#menu-items').show();
  // create line item
  const section = $(`
    <div href="#" data-section-id="${nextSectionId}" class="list-group-item" onclick="selectSection(this, ${nextSectionId})">
      <div class="d-flex w-100 justify-content-between align-items-center">
        <i class="fas fa-bars drag-handle" aria-hidden="true"></i>
        <input class="section-name form-control w-75" type="text" placeholder="Section Name">
        <i class="far fa-times-circle delete" aria-hidden="true" onclick="deleteSection(this)"></i>
      </div>
    </div>
  `);

  // create items section
  const itemSection = $(`<div data-section-id="${nextSectionId}" class="items list-group"></div>`);
  
  // make it sortable
  new Sortable(itemSection[0], {
    animation: 150,
    ghostClass: 'ghost',
    handle: '.drag-handle'
  });

  // add to page, select it, add a blank item, focus section name
  $('#sections-list').append(section);
  $('#add-item').before(itemSection);
  section.click();
  addItem();
  section.find('.section-name').focus();

  nextSectionId++;
}

/**
 * Add a new menu item
 */
function addItem() {
  const item = $(`
    <div class="item list-group-item d-flex w-100 justify-content-between align-items-center">
      <i class="fas fa-bars drag-handle" aria-hidden="true"></i>
      <div class="container w-75">
        <div class="row justify-content-between mb-1">
          <input class="item-name form-control col-6" type="text" placeholder="Name">
          <input class="item-price form-control col-3" type="text" placeholder="Price">
        </div>
        <div class="row">
          <textarea class="item-description form-control w-100" placeholder="Description..."></textarea>
        </div>
      </div>
      <i class="far fa-times-circle delete" aria-hidden="true" onclick="deleteItem(this)"></i>
   </div>
  `);

  $('.selected-items').append(item);
  item.find('.item-name').focus();
}

/**
 * Save the menu
 */
function save() {
  startSpinner();

  // loop through each section
  let newID = 0;
  $('#sections-list > .list-group-item').each((i, section) => {
    if(section.id) {
      saveSectionUpdates($(section), i);
    }
    else {
      saveNewSection($(section), i, newID++);
    }
  });

  // make request
  $.ajax({
    url: apiUrl + 'menu?type=' + TYPE,
    type: 'POST',
    success: (ids) => {addNewIds(ids); showSuccess();},
    error: showError,
    complete: stopSpinner,
    data: JSON.stringify(updates),
    dataType: 'json'
  });

  updates = {'deleteSection': [], 'addSection': [], 'updateSection': [], 'deleteItem': [], 'addItem': [], 'updateItem': []};
}

/**
 * Add the contents of a new section to the updates object
 */
function saveNewSection(section, pos, newID) {
  updates['addSection'].push({
    'position': pos,
    'name': section.find('.section-name').val(),
  });

  $(`.items[data-section-id = ${section.attr('data-section-id')}] .item`).each((pos, item) => {
    updates['addItem'].push({
      'sectionId': -1,
      'newID': newID,
      'position': pos,
      'name': $(item).find('.item-name').val(),
      'description': $(item).find('.item-description').val(),
      'price': $(item).find('.item-price').val()
    });
  });
}

/**
 * Save any updates to an existing section to the updates object
 */
function saveSectionUpdates(section, pos) {
  // check for updates on the section
  const id = parseInt(section.attr('id').split('_')[1]);
  const old = oldMenu[id];
  if(old['sectionName'] !== section.find('.section-name').val() || parseInt(old['sectionPosition']) !== pos) {
    // add to update
    updates['updateSection'].push({
      'id': id,
      'name': section.find('.section-name').val(),
      'position': pos
    });
  }

  // check for updates on each item
  $(`.items[data-section-id = ${section.attr('data-section-id')}] .item`).each((itemPos, item) => {
    item = $(item);

    if(item.attr('id')) {
      // check for update
      const itemId = parseInt(item.attr('id').split('_')[1]);
      const oldItem = old['items'][itemId];

      if(oldItem['name'] !== item.find('.item-name').val() || 
        parseInt(oldItem['position']) !== itemPos || 
        oldItem['description'] !== item.find('.item-description').val() || 
        oldItem['price'] !== item.find('.item-price').val()) {

        // update
        updates['updateItem'].push({
          'id': itemId,
          'position': itemPos,
          'name': $(item).find('.item-name').val(),
          'description': $(item).find('.item-description').val(),
          'price': $(item).find('.item-price').val()
        });
      }
    }
    else {
      // new item
      updates['addItem'].push({
        'sectionId': id,
        'position': itemPos,
        'name': $(item).find('.item-name').val(),
        'description': $(item).find('.item-description').val(),
        'price': $(item).find('.item-price').val()
      });
    }
  });
}

/**
 * Add the new section and item ids to the page
 */
function addNewIds(ids) {
  // add new section ids
  $('#sections-list > .list-group-item').each((i, section) => {
    if(section.id === '') {
      const id = ids['newSections'].shift();
      section.id = 'section_' + id;
    }

    // add new item ids
    $(`.items[data-section-id = ${$(section).attr('data-section-id')}] .item`).each((i, item) => {
      if(item.id === '') {
        const itemId = ids['newItems'].shift();
        item.id = 'item_' + itemId;
      }
    })
  });
}