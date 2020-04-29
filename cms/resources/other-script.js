function getSaveContent() {
    info = {};
    info['about'] = document.getElementById('about').value;
    info['hours'] = document.getElementById('hours').value;
    info['catering'] = document.getElementById('catering').value;
    return info;
}