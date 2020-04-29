let nextID = 0;

function ready() {
  document.querySelectorAll('#sections-list .list-group-item').forEach(item => {
    item.addEventListener('click', selectSection);
  });
  document.querySelectorAll('.delete').forEach(item => {
    item.addEventListener('click', deleteSectionItem);
  })
  new Sortable(document.querySelector('#sections-list'), {
    animation: 150,
    ghostClass: 'ghost',
    handle: '.drag-handle'
  });
  document.querySelectorAll('.items').forEach(item => {
    new Sortable(item, {
      animation: 150,
      ghostClass: 'ghost',
      handle: '.drag-handle'
    });
  });
  nextID = document.querySelectorAll('#sections-list .list-group-item').length;
}
// in case the document is already rendered
if (document.readyState!='loading') ready();
// modern browsers
else if (document.addEventListener) document.addEventListener('DOMContentLoaded', ready);
// IE <= 8
else document.attachEvent('onreadystatechange', function(){
    if (document.readyState=='complete') ready();
});

// return a json object to send to the backend to be saved
function getSaveContent(menuType) {
  const menu = {};
  menu.type = menuType;
  menu.sections = [];

  document.querySelectorAll('.section-name').forEach(el => {
    const section = {};
    section.name = el.value;
    const id = el.id.split('_')[1];
    section.items = getItems(id);
    menu.sections.push(section);
  });

  return menu;
}

// return a list of menu items for the section id
function getItems(id) {
  const items = [];

  document.querySelectorAll('#section_' + id + ' .item').forEach(el => {
    const item = {};
    item.name = el.querySelector('.item-name').value;
    item.price = el.querySelector('.item-price').value;
    item.description = el.querySelector('.item-description').value;
    items.push(item);
  });

  return items;
}

// change the selected menu section
function selectSection(e) {
  let lineItem = e.target;
  if(lineItem.tagName !== 'DIV')
    return;
  lineItem = lineItem.closest('.list-group-item');
  document.querySelectorAll('#sections-list .list-group-item').forEach(item => {item.classList.remove('active');});
  lineItem.classList.add('active');

  const id = lineItem.querySelector('input').id.split('_')[1];
  document.querySelectorAll('.items').forEach(item => item.classList.remove('selected-items'));
  document.querySelector('#section_' + id).classList.add('selected-items');
}


// delete the section or item
function deleteSectionItem(e) {
  const lineItem = e.target.closest('.list-group-item');

  if(!lineItem.classList.contains('item')) {
    if(!confirm('Are you sure you want to delete this section and all of its contents?'))
      return;
  
    const id = lineItem.querySelector('input').id.split('_')[1];
    const section = document.querySelector('#section_' + id);
    section.parentNode.removeChild(section);
  }

  if(lineItem.classList.contains('active')) {
    let newActive = lineItem.previousElementSibling;
    lineItem.parentNode.removeChild(lineItem);
    
    if(newActive === null) 
      newActive = document.querySelector('#sections-list .list-group-item:not(#add-section)');
    if(newActive !== null)
      newActive.click();
  }
  else {
    lineItem.parentNode.removeChild(lineItem);
  }
}

function addSection() {
  // create line item
  const item = document.createElement('div');
  item.classList.add('list-group-item', 'active', 'mx-auto', 'w-100');
  item.innerHTML = `<div class='d-flex w-100 justify-content-between align-items-center'>
                      <i class='fas fa-bars drag-handle'></i>
                      <input class='section-name form-control w-75' id='section-name_` + nextID + `' type='text' placeholder='Section Name'/>
                      <i class='far fa-times-circle delete'></i>
                    </div></div>`;
  item.addEventListener('click', selectSection);
  item.querySelector('.delete').addEventListener('click', deleteSectionItem);

  // create items section
  const itemSection = document.createElement('div');
  itemSection.classList.add('items', 'selected-items', 'list-group');
  itemSection.id = 'section_' + nextID;
  itemSection.innerHTML = `<div class='item list-group-item d-flex w-100 justify-content-between align-items-center'>
                            <i class='fas fa-bars drag-handle'></i>
                            <div class='container w-75'>
                              <div class='row justify-content-between mb-1'>
                                <input class='item-name form-control col-6' type='text' placeholder='Name'/>
                                <input class='item-price form-control col-3' type='text' placeholder='Price'/>
                              </div>
                              <div class='row'>
                                <textarea class='item-description form-control w-100' placeholder='Description...'></textarea>
                              </div>
                            </div>
                            <i class='far fa-times-circle delete'></i>
                          </div>`;
  itemSection.querySelector('.delete').addEventListener('click', deleteSectionItem);
  new Sortable(itemSection, {
    animation: 150,
    ghostClass: 'ghost',
    handle: '.drag-handle'
  });

  // add to page 
  document.querySelectorAll('#sections-list .list-group-item').forEach(item => item.classList.remove('active'));                      
  document.querySelectorAll('.items').forEach(item => item.classList.remove('selected-items'));
  document.querySelector('#sections-list').append(item);
  document.querySelector('#menu-items').insertBefore(itemSection, document.getElementById('add-item'));
  item.querySelector('input').focus();
  nextID++;
}

function addItem(e) {
  const item = document.createElement('div');
  item.classList.add('item', 'list-group-item', 'd-flex', 'w-100', 'justify-content-between', 'align-items-center');
  item.innerHTML = `<i class='fas fa-bars drag-handle'></i>
                    <div class='container w-75'>
                      <div class='row justify-content-between mb-1'>
                        <input class='item-name form-control col-6' type='text' placeholder='Name'/>
                        <input class='item-price form-control col-3' type='text' placeholder='Price'/>
                      </div>
                      <div class='row'>
                        <textarea class='item-description form-control w-100' placeholder='Description...'></textarea>
                      </div>
                    </div>
                    <i class='far fa-times-circle delete'></i>
                  </div>`;
  item.querySelector('.delete').addEventListener('click', deleteSectionItem);

  document.querySelector('.selected-items').append(item);
  item.querySelector('.item-name').focus();
}