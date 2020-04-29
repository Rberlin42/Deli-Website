const announcements = document.querySelector('#announcement-cards').childNodes;
const index = document.querySelector('#announce-index');
index.innerHTML = '1/' + announcements.length;

// hide announcements section if there are none
if(announcements.length === 0)
    document.querySelector('#announcements').style.display = 'none';

announcements[0].classList.remove('hidden-announcement');
let current_announcement = 0;

const nextAnnouncment =  () => {
    announcements[current_announcement].classList.add('hidden-announcement');
    if (current_announcement === announcements.length - 1) {
        current_announcement = 0;
    } else {
        current_announcement++;
    }
    announcements[current_announcement].classList.remove('hidden-announcement');
    index.innerHTML = (current_announcement+1) + '/' + announcements.length;
};

setInterval(nextAnnouncment, 7000);