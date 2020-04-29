function ready() {
    document.querySelectorAll('.delete').forEach(item => {
        item.addEventListener('click', deleteAnnouncement);
    })
    new Sortable(document.querySelector('#announcements'), {
        animation: 150,
        ghostClass: 'ghost',
        handle: '.drag-handle'
    });
}
// in case the document is already rendered
if (document.readyState!='loading') ready();
// modern browsers
else if (document.addEventListener) document.addEventListener('DOMContentLoaded', ready);
// IE <= 8
else document.attachEvent('onreadystatechange', function(){
    if (document.readyState=='complete') ready();
});

function deleteAnnouncement(e) {
    const lineItem = e.target.parentElement;
    lineItem.parentNode.removeChild(lineItem);
}

function addAnnouncement() {
    const list = document.getElementById('announcements');
    const announcement = document.createElement('div');
    announcement.classList.add('announcement', 'list-group-item', 'd-flex', 'justify-content-between', 'align-items-center');
    
    announcement.innerHTML = `<i class="fas fa-bars drag-handle"></i>
                                <div class="d-flex flex-column w-75">
                                    <input class="title form-control w-50 mb-1" type="text" placeholder="Title"/>
                                    <textarea class="description form-control w-100" placeholder="Description..."></textarea>
                                </div>
                                <i class="far fa-times-circle delete"></i>`;
    announcement.querySelector('.delete').addEventListener('click', deleteAnnouncement);

    list.append(announcement);
    announcement.querySelector('.title').focus();
}

function getSaveContent() {
    const announcements = [];
    const list = document.querySelectorAll('.announcement');

    list.forEach((a) => {
        const announcement = {};
        announcement.title = a.querySelector('.title').value;
        announcement.description = a.querySelector('.description').value;
        announcements.push(announcement);
    });

    return {'announcements': announcements};
}