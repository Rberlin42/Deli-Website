function save(dest, menuType) {
    const info = getSaveContent(menuType);
    const save = document.getElementById('save');
    const success = document.getElementById('save-success');
    const fail = document.getElementById('save-fail');
    success.style.bottom = '-70px';
    fail.style.bottom = '-70px';
  
    save.innerHTML = `<div class="spinner-border" role="status">
                                                  <span class="sr-only">Loading...</span>
                                                </div>`;
  
    postData('/cms/' + dest + '.php', info).then((response) => {
      response.text().then((text) => console.log(text));
      save.innerHTML = 'Save';
      if(response.status === 200)
        success.style.bottom = '-5px';
      else
        fail.style.bottom = '-5px';
  
      setTimeout(() => {
        success.style.bottom = '-70px';
        fail.style.bottom = '-70px';
      }, 5000);
    });
  }
  
  async function postData(url = '', data = {}) {  
    // Default options are marked with *
    const response = await fetch(url, {
      method: 'POST', // *GET, POST, PUT, DELETE, etc.
      mode: 'cors', // no-cors, *cors, same-origin
      cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
      credentials: 'same-origin', // include, *same-origin, omit
      headers: {
        'Content-Type': 'application/json'
        // 'Content-Type': 'application/x-www-form-urlencoded',
      },
      redirect: 'follow', // manual, *follow, error
      referrer: 'no-referrer', // no-referrer, *client
      body: JSON.stringify(data) // body data type must match "Content-Type" header
    });
    return await response;
}